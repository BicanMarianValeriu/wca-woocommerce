<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Details
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Config\Traits\Asset;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function add_action;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Details block.
 */
class Details extends Base {

	use Singleton;
	use Asset;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-details';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		$is_enabled = get_prop( wecodeart_option( 'woocommerce' ), [ 'product_rating_extra' ] );

		if( ! $is_enabled ) return;
		
		add_filter( 'woocommerce_product_tabs',				[ $this, 'woocommerce_product_tabs' ] );

		add_action( 'woocommerce_get_sections_products',	[ $this, 'settings_section' ],	20, 1 );
		add_filter( 'woocommerce_get_settings_products',	[ $this, 'settings_array' 	], 	20, 2 );

		add_filter( 'woocommerce_product_reviews_table_columns',					[ $this, 'table_review_columns' ],	20, 1 );
		add_filter( 'woocommerce_product_reviews_table_sortable_columns',			[ $this, 'table_review_sortable'],  20, 1 );
		add_action( 'woocommerce_product_reviews_table_column_likes',				[ $this, 'table_likes_content' 	],	20, 1 );
		add_filter( 'woocommerce_product_reviews_table_column_comment_content',		[ $this, 'table_review_content' ],	20, 2 );
		add_filter( 'woocommerce_product_reviews_list_table_prepare_items_args',	[ $this, 'table_likes_sorting' 	],	20, 1 );
		
		add_action( 'init',						[ $this, 'schedule_reviews_cron' ] 	);
		add_action( 'wecodeart_reviews_cron',	[ $this, 'update_comments' ] 		);
		add_action( 'edit_comment',				[ $this, 'update_comment' ], 	20 	);
		add_action( 'comment_post',				[ $this, 'update_comment' ], 	20 	);
		add_action( 'add_meta_boxes',			[ $this, 'manage_meta_box' ],	PHP_INT_MAX );
		add_filter( 'wp_update_comment_data',	[ $this, 'save_meta_box' ], 	1 	);
		add_filter( 'get_comment_link',			[ $this, 'review_permalink' ],	20, 1 );
	}

	/**
	 * Used to replace WOO's Callback
	 *
	 * @param 	array $tabs
	 *
	 * @return 	array
	 */
	public function woocommerce_product_tabs( $tabs ) {
		if( isset( $tabs['reviews'] ) ) {
			$tabs['reviews']['callback'] = function() {
				$path 		= wecodeart_if( 'is_dev_mode' ) ? 'unminified' : 'minified';
				$name 		= wecodeart_if( 'is_dev_mode' ) ? 'reviews' : 'reviews.min';
				$product	= wc_get_product();

				// Load required inputs
				wecodeart_input( 'select', [], false );
				wecodeart_input( 'group', [], false );
				wecodeart_input( 'text', [], false );
				wecodeart_input( 'textarea', [], false );

				// Add CSS
				wecodeart( 'assets' )->add_style( 'wp-block-woo-reviews', [
					'inline'	=> 'file:' . sprintf( '%s/assets/%s/css/%s.css', untrailingslashit( WCA_WOO_EXT_DIR ), $path, $name ),
					'version'	=> WCA_WOO_EXT_VER,
				] );

				// Add JS
				wecodeart( 'assets' )->add_script( 'wp-block-woo-reviews', [
					'path' 		=> sprintf( '%s/assets/%s/js/%s.js', untrailingslashit( WCA_WOO_EXT_URL ), $path, $name ),
					'deps'		=> [ 'wp-i18n', 'wp-hooks', 'wp-url', 'wp-element' ],
					'version'	=> WCA_WOO_EXT_VER,
					'locale'	=> [
						'requestUrl' 	=> WCA_WOO_EXT_URL . '/includes/ajax.php',
						'product'		=> [
							'ID'		=> $product->get_id(),
							'title' 	=> $product->get_title(),
							'total' 	=> $product->get_review_count(),
							'counts' 	=> $product->get_rating_counts(),
							'average' 	=> $product->get_average_rating(),
							'allow'		=> $product->get_reviews_allowed(),
							'verify'	=> self::get_text( 'verify' )
						],
						'actions'		=> get_option( 'woocommerce_review_actions' ) === 'yes' ? [
							'like' 		=> get_option( 'woocommerce_review_actions_like' ) === 'yes',
							'comment' 	=> get_option( 'woocommerce_review_actions_comment' ) === 'yes',
						] : [],
						'verified'		=> get_option( 'woocommerce_review_rating_verification_label' ) === 'yes',
						'avatar'		=> get_option( 'woocommerce_review_avatar' ),
						'note'			=> get_option( 'woocommerce_review_new_note' ),
						'amount'		=> get_option( 'comments_per_page' ),
						'terms' 		=> self::get_text( 'terms' ),
					],
				] );
			?>
			<div id="reviews" class="woocommerce-Reviews"></div>
			<?php };
		}

		return $tabs;
	}

	/**
     * Get Text
	 *
	 * @param	string $type
     *
     * @return 	string
     */
    public static function get_text( string $type = '' ): string {
		$text = '';

		switch ( $type ) :
			case 'terms':
				if( $pp_page = get_option( 'wp_page_for_privacy_policy' ) ) {			
					$text = sprintf(
						esc_html__( 'By publishing the review, you agree with %s of the site!', 'wca-woo-reviews' ),
						sprintf( '<a href="%s">%s</a>', get_privacy_policy_url(), get_the_title( $pp_page ) )
					);
				}
			break;
			case 'verify':
				$verify = get_option( 'woocommerce_review_rating_verification_required' ) === 'yes' ? true : false;
				$bought = wc_customer_bought_product( '', get_current_user_id(), wc_get_product()->get_id() );

				if( $verify && $bought !== true ) {
					$text = esc_html__( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' );
					$text .= '<br /><br />';
					$text .= sprintf(
						'<a href="%s" class="wp-element-button has-primary-background-color">%s</a>',
						esc_url( wp_login_url( get_permalink() . '#reviews', false ) ),
						esc_html__( 'Login', 'woocommerce' )
					);
				}
			break;
		endswitch;

		return apply_filters( 'wecodeart/woocommerce/reviews/text', $text, $type );
    }

	/**
	 * Plugin Settings
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	array	$settings_tabs
	 */
	public function settings_section( $settings_tabs ) {
		$settings_tabs['reviews'] = esc_html__( 'Reviews', 'woocommerce' );

		return $settings_tabs;
	}
	
	public function settings_array( $settings, $section ) {
		// Remove original settings
		$filtered_ids = [
			"product_rating_options",
			"woocommerce_enable_reviews",
			"woocommerce_review_rating_verification_label",
			"woocommerce_review_rating_verification_required",
			"woocommerce_enable_review_rating",
			"woocommerce_review_rating_required",
			"product_rating_options"
		];
		
		// Create a new array without the filtered options
		$settings = array_filter( $settings, function ( $setting ) use ( $filtered_ids ) {
			return ! in_array( $setting['id'], $filtered_ids );
		} );
		
		// Reset array keys to maintain sequential index
		$settings = array_values( $settings );
		
		if( $section === 'reviews' ) {
			$settings = [
				// Original settings
				[
					'title' => esc_html__( 'Reviews', 'woocommerce' ),
					'type'  => 'title',
					'desc'  => '',
					'id'    => 'product_rating_options',
				],
				[
					'title'           => esc_html__( 'Enable reviews', 'woocommerce' ),
					'desc'            => esc_html__( 'Enable product reviews', 'woocommerce' ),
					'id'              => 'woocommerce_enable_reviews',
					'default'         => 'yes',
					'type'            => 'checkbox',
					'checkboxgroup'   => 'start',
					'show_if_checked' => 'option'
				],
				[
					'desc'            => esc_html__( 'Show "verified owner" label on customer reviews', 'woocommerce' ),
					'id'              => 'woocommerce_review_rating_verification_label',
					'default'         => 'yes',
					'type'            => 'checkbox',
					'checkboxgroup'   => '',
					'show_if_checked' => 'yes',
					'autoload'        => false,
				],
				[
					'desc'            => esc_html__( 'Reviews can only be left by "verified owners"', 'woocommerce' ),
					'id'              => 'woocommerce_review_rating_verification_required',
					'default'         => 'no',
					'type'            => 'checkbox',
					'checkboxgroup'   => 'end',
					'show_if_checked' => 'yes',
					'autoload'        => false,
				],
				[
					'title'           	=> esc_html__( 'Product ratings', 'woocommerce' ),
					'desc'            	=> esc_html__( 'Enable star rating on reviews', 'woocommerce' ),
					'id'              	=> 'woocommerce_enable_review_rating',
					'default'         	=> 'yes',
					'type'            	=> 'checkbox',
					'checkboxgroup'   	=> 'start',
					'show_if_checked' 	=> 'option',
					'desc_tip'			=> esc_html__( 'Does not apply to our plugin.', 'wca-woo-reviews' ),
				],
				[
					'desc'            	=> esc_html__( 'Star ratings should be required, not optional', 'woocommerce' ),
					'id'              	=> 'woocommerce_review_rating_required',
					'default'         	=> 'yes',
					'type'            	=> 'checkbox',
					'checkboxgroup'   	=> 'end',
					'show_if_checked' 	=> 'yes',
					'autoload'        	=> false,
					'desc_tip'			=> esc_html__( 'Does not apply to our plugin.', 'wca-woo-reviews' ),
				],
				// Custom
				[
					'title' 		=> esc_html__( 'Add review note', 'wca-woo-reviews' ),
					'type' 			=> 'textarea',
					'id' 			=> 'woocommerce_review_new_note',
					'css'			=> 'min-height: 100px;',
					'desc' 			=> esc_html__( 'Custom note to be shown when user adds a review.', 'wca-woo-reviews' ),
					'default' 		=> sprintf(
						esc_html__( 'Hey %s, thank you for the review. If you have any problems with %s or if you have any questions please let us know!', 'wca-woo-reviews' ),
						'<strong>{{ userName }}</strong>',
						'<strong>{{ productTitle }}</strong>'
					),
					'desc_tip'		=> sprintf(
						esc_html__( 'You can use tags like: %s.', 'wca-woo-reviews' ),
						'<strong>{{ userName }}, {{ productTitle }}</strong>'
					),
					'show_if_checked' => 'option'
				],
				[
					'title'           => esc_html__( 'Review actions', 'wca-woo-reviews' ),
					'desc'		      => esc_html__( 'Enable review actions?', 'wca-woo-reviews' ),
					'id'              => 'woocommerce_review_actions',
					'default'         => 'yes',
					'type'            => 'checkbox',
					'checkboxgroup'   => 'start',
					'show_if_checked' => 'option',
				],
				[
					'desc'            => esc_html__( 'Allow reviews to be "liked".', 'wca-woo-reviews' ),
					'id'              => 'woocommerce_review_actions_like',
					'default'         => 'yes',
					'type'            => 'checkbox',
					'checkboxgroup'   => '',
					'show_if_checked' => 'yes',
					'autoload'        => false,
				],
				[
					'desc'            => esc_html__( 'Allow reviews to be "commented".', 'wca-woo-reviews' ),
					'id'              => 'woocommerce_review_actions_comment',
					'desc_tip'		  => esc_html__( 'Only for authentificated in users.', 'wca-woo-reviews' ),
					'default'         => 'yes',
					'type'            => 'checkbox',
					'checkboxgroup'   => 'end',
					'show_if_checked' => 'yes',
					'autoload'        => false,
				],
				[
					'title'     	=> esc_html__( 'Review avatar', 'wca-woo-reviews' ),
					'id'			=> 'woocommerce_review_avatar',
					'default'		=> '',
					'type'			=> 'select',
					'options'		=> [
						''			=> esc_html__( 'Image', 'wca-woo-reviews' ),
						'initials'	=> esc_html__( 'Initials', 'wca-woo-reviews' ),
					]
				],
				[ 
					'type'	=> 'sectionend',
					'id'	=> 'product_rating_options'
				],
			];

			return array_values( $settings );
		}
		
		return $settings;
	}

	/**
	 * Admin Columns
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	array	$settings_tabs
	 */
	public function table_review_columns( $columns ) {
		$columns['likes'] = esc_html__( 'Likes', 'wca-woo-reviews' );

		return $columns;
	}

	public function table_review_sortable( $columns ) {
		$columns['likes'] = 'likes';

		return $columns;
	}

	public function table_likes_content( $comment ) {
		$value = get_comment_meta( $comment->comment_ID, 'likes', true ) ?: 0;

		printf( '<span>%s</span>', $comment->comment_type === 'review' ? esc_html( $value ) : '-' );
	}
	
	public function table_review_content( $output, $comment ) { 
		// Get your custom rating data based on the $comment_id or any other logic you need
		$value = get_comment_meta( $comment->comment_ID, 'title', true ) ?? '';

		// Output the custom rating value
		if( $value ) {
			$output = str_replace(
				'<div class="comment-text">',
				sprintf( '<h4 class="comment-title" style="margin: 0 0 .5rem;">%s</h4><div class="comment-text">', esc_html( $value ) ), 
				$output
			);
		}

		return $output;
	}

	public function table_likes_sorting( $args ) {
		$orderby = sanitize_text_field( wp_unslash( $_REQUEST['orderby'] ?? '' ) );
		$order   = sanitize_text_field( wp_unslash( $_REQUEST['order'] ?? '' ) );

		if ( 'likes' === $orderby ) {
			$orderby          = 'meta_value_num';
			$args['meta_key'] = 'likes';

			if ( ! in_array( strtolower( $order ), [ 'asc', 'desc' ], true ) ) {
				$order = 'desc';
			}

			$args = wp_parse_args( [
				'orderby' => $orderby,
				'order'   => strtolower( $order ),
			], $args );
		}

		return $args;
	}

	/**
	 * Update Comments cron
	 *
	 * @return	void
	 */
	public function schedule_reviews_cron() {
		if ( ! wp_next_scheduled( 'wecodeart_reviews_cron' ) ) {
			wp_schedule_event( time(), 'hourly', 'wecodeart_reviews_cron' );
		}
	}

	/**
	 * Update Comments
	 *
	 * @return	void
	 */
	public function update_comments() {
		$args = [
			'meta_query' => [
				[
					'key'     => 'verified',
					'compare' => 'NOT EXISTS',
				]
			]
		];
	
		$comments = get_comments( $args );

		array_map( [ $this, 'update_comment' ], $comments );
	}

	/**
	 * Update Comment
	 *
	 * @return	void
	 */
	public function update_comment( $comment_id ) {
		$comment = ! is_object( $comment_id ) ? get_comment( $comment_id ) : $comment_id;

		// Check if the comment type is 'review'
		if ( $comment->comment_type !== 'review' ) {
			return;
		}

		// Update verified status if not added (aka via our AJAX)
		if( ! get_comment_meta( $comment_id, 'verified', true ) ) {
			update_comment_meta( $comment_id, 'verified', wc_review_is_from_verified_owner( $comment_id ) );
		}
		
		// Update likes to 0 for old reviews
		if( ! get_comment_meta( $comment_id, 'likes', true ) ) {
			update_comment_meta( $comment_id, 'likes', 0 );
		}
	}

	/**
	 * Add WC Meta boxes.
	 *
	 * @return	void
	 */
	public function manage_meta_box() {
		$screen    = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

		// Default Metabox
		remove_meta_box( 'woocommerce-rating', 'comment', 'normal' );

		// Review meta.
		if (
			'comment' === $screen_id && isset( $_GET['c'] ) &&
			metadata_exists( 'comment', wc_clean( wp_unslash( $_GET['c'] ) ), 'rating' )
		) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            add_meta_box(
                'wecodeart-review-meta',
                esc_html__( 'Review', 'woocommerce' ),
                [ $this, 'output_meta_box' ],
                'comment',
                'normal',
                'high'
            );
		}
    }
    
	/**
	 * Output the metabox.
	 *
	 * @param	object $comment Comment being shown.
	 *
	 * @return	void
	 */
	public function output_meta_box( $comment ) {
		// We are using default nonce from WOO.
		// wp_nonce_field( 'woocommerce_save_data', 'woocommerce_meta_nonce' );

		$current_title = get_comment_meta( $comment->comment_ID, 'title', true );
		$current_likes = get_comment_meta( $comment->comment_ID, 'likes', true );
		?>
        <fieldset id="namediv">
            <legend class="screen-reader-text"><?php esc_html_e( 'Review meta', 'wca-woo-reviews' ); ?></legend>
            <table class="form-table editcomment" role="presentation">
                <tbody>
                    <tr>
                        <td class="first"><label for="title"><?php esc_html_e( 'Title', 'wca-woo-reviews' ); ?></label></td>
                        <td><input type="text" name="title" value="<?php echo esc_attr( $current_title ); ?>" id="title" /></td>
                    </tr>
                    <tr>
                        <td class="first"><label for="rating"><?php esc_html_e( 'Rating', 'woocommerce' ); ?></label></td>
                        <td><?php \WC_Meta_Box_Product_Reviews::output( $comment ); ?></td>
                    </tr>
                    <tr>
                        <td class="first"><label for="likes"><?php esc_html_e( 'Likes', 'wca-woo-reviews' ); ?></label></td>
                        <td><input type="number" name="likes" min="0" value="<?php echo esc_attr( $current_likes ); ?>" id="likes" style="width:auto;" /></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
		<?php
	}

	/**
	 * Save meta box data
	 *
	 * @param	mixed $data Data to save.
	 *
	 * @return	mixed
	 */
	public function save_meta_box( $data ) {
		// Not allowed, return regular value without updating meta.
		if (
			! isset( $_POST['woocommerce_meta_nonce'], $_POST['title'] ) ||
            ! isset( $_POST['woocommerce_meta_nonce'], $_POST['likes'] ) ||
            ! wp_verify_nonce( wp_unslash( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' )
        ) { 
			return $data;
        }

        $comment_id = $data['comment_ID'];

        update_comment_meta( $comment_id, 'title', sanitize_text_field( wp_unslash( $_POST['title'] ) ) );
        
        if ( $_POST['likes'] <= 0 ) {
			return $data;
		}

		update_comment_meta( $comment_id, 'likes', intval( wp_unslash( $_POST['likes'] ) ) );

		// Return regular value after updating.
		return $data;
	}

	/**
	 * Review Permalink
	 *
	 * @param 	string 	$permalink
	 *
	 * @return 	string	$permalink
	 */
	public function review_permalink( $permalink ) {
		// Cleanup page.
		$permalink = preg_replace( '/\/comment-page-(\d+)\//', '/', $permalink );

		// Rename type.
		$permalink = preg_replace( '/#comment-(\d+)/', '#review-$1', $permalink );
	
		return $permalink;
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			ul.wc-tabs {
				display: flex;
				padding: 0;
				margin: 0 0 -1px;
			}
			ul.wc-tabs li {
				display: block;
				background-color: transparent;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0;
				border-bottom-color: transparent;
				padding: 0;
				margin: 0;
			}
			ul.wc-tabs li:is(:hover,.active)::before {
				border-top-color: var(--wp--preset--color--primary);
			}
			ul.wc-tabs li:is(:hover,.active) a {
				color: var(--wp--preset--color--primary);
			}
			ul.wc-tabs li::before {
				content: "";
				display: block;
				height: 0;
				margin-top: -1px;
				width: 100%;
				border-top: 4px solid var(--wp--preset--color--accent);
			}
			ul.wc-tabs li a {
				position: relative;
				display: block;
				font-size: 0.6rem;
				font-weight: 500;
				text-transform: uppercase;
				text-decoration: none;
				color: var(--wp--gray-900);
				padding: 0.6rem 0.8rem;
			}
			ul.wc-tabs li + li {
				border-left: 0;
			}
			ul.wc-tabs ~ .wc-tab {
				border: 1px solid var(--wp--preset--color--accent);
				padding: 10px 10px 20px;
			}
			ul.wc-tabs ~ .wc-tab h2 {
				margin-top: 0;
				font-weight: 500;
			}

			.woocommerce-product-attributes {
				width: auto;
				min-width: 270px;
				text-align: left;
			}
			.woocommerce-product-attributes p {
				margin: 0;
			}

			.woocommerce-reviews .comment-form-rating label {
				display: block;
			}
			.woocommerce-reviews .review {
				--wc--avatar-size: 60px;
			}
			.woocommerce-reviews .review + .review {
				margin-top: 1rem;
			}
			.woocommerce-reviews .review .meta {
				margin: 0;
			}
			.woocommerce-reviews .review .comment_container::after {
				display: block;
				clear: both;
				content: "";
			}
			.woocommerce-reviews .review .comment-text {
				position: relative;
				float: right;
				width: calc(100% - var(--wc--avatar-size));
				padding-left: 10px;
			}
			.woocommerce-reviews .review .comment-text p:only-child {
				margin: 0;
			}
			.woocommerce-reviews .review .avatar {
				max-width: var(--wc--avatar-size);
				float: left;
				border: 4px solid var(--wp--preset--color--accent);
				border-radius: 100%;
			}
			.woocommerce-reviews .review :where(.star-rating,.wc-block-components-product-rating__container) {
				float: right;
			}
			.woocommerce-pagination ul {
				display: inline-flex;
				list-style: none;
				gap: 1rem;
				padding-left: 0;
			}

			p.stars a:before,
			p.stars a:hover ~ a:before,
			p.stars.selected a.active ~ a:before {
				background-image: var(--wc--star);
			}
			p.stars:hover a:before,
			p.stars.selected a.active:before,
			p.stars.selected a:not(.active):before {
				background-image: var(--wc--star-active);
			}
			p.stars span {
				display: block;
				line-height: 1;
			}
			p.stars a {
				position: relative;
				display: inline-block;
				width: 1em;
				height: 1em;
				font-size: 1.5rem;
				text-indent: -999em;
				text-decoration: none;
			}
			p.stars a:before {
				content: "";
				position: absolute;
				display: block;
				width: 100%;
				height: 100%;
				background-size: contain;
				background-position: center;
				background-repeat: no-repeat;
			}

			@media (max-width: 575.98px) {
				.woocommerce-reviews .review {
					padding-top: 1rem;
				}
				.woocommerce-reviews .review .star-rating {
					position: absolute;
					right: 0;
					bottom: 100%;
					font-size: 1rem;
				}
			}

			@media (min-width: 576px) {
				ul.wc-tabs li a {
					font-size: 0.8rem;
					padding: 0.7rem 1.5rem;
				}
				ul.wc-tabs .wc-tab {
					padding: 25px;
				}
			}
		';
	}
}
