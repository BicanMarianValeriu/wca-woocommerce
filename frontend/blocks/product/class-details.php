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
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use function add_filter;
use function add_action;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Details block.
 */
class Details extends Dynamic {

	use Singleton;
	use Asset;

	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'woocommerce';

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
		
		add_filter( 'woocommerce_product_tabs',	[ $this, 'woocommerce_product_tabs' ] );

		add_action( 'edit_comment',				[ $this, 'update_comment' ], 20 );
		add_action( 'add_meta_boxes',			[ $this, 'add_meta_boxes' ], 20 );
		add_filter( 'wp_update_comment_data',	[ $this, 'save_meta_boxes' ], 1 );
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

				// Load utilities
				wecodeart( 'styles' )->Utilities->load( [
					// Radius
					'rounded', 'rounded-circle', 'rounded-pill',
					// Columns
					'col-lg-3', 'col-lg', 'col-12', 'col-md', 'col-md-12', 'col-sm', 'col-sm-6', 'col-auto',
					// Displays
					'd-none', 'd-flex', 'd-block', 'd-table', 'd-table-row', 'd-table-col', 'd-table-cell', 'd-inline-block', 'd-lg-inline-block',
					// Flex
					'flex-column', 'flex-wrap', 'flex-grow-1', 'flex-row-reverse',
					// Aligns
					'align-middle', 'align-items-center', 'align-self-center', 'justify-content-center', 'justify-content-sm-start',
					// Order
					'order-lg-first', 'order-lg-last',
					// Margins
					'mt-1', 'mt-3', 'mb-0', 'mb-1', 'mb-2', 'mb-3', 'me-1', 'me-2', 'me-sm-3', 'me-lg-3', 'my-0', 'my-1', 'my-3', 'mx-1', 'g-3',
					// Paddings
					'p-3', 'py-0', 'py-1', 'py-3', 'px-1',
					// Typography
					'has-text-align-center', 'has-text-align-sm-left', 'has-text-align-md-right', 'fw-300', 'fw-400', 'fw-700', 'display-4',
					// Border
					'border-bottom',
				] );

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
							'verify'	=> $this->get_verify_text()
						],
						'query' => [
							'number' => (int) get_option( 'comments_per_page' )
						],
						'verified'	=> get_option( 'woocommerce_review_rating_verification_label' ) === 'yes',
						'note'		=> $this->get_notice_text(),
						'terms' 	=> $this->get_terms_text(),
					],
				] );
			?>
			<div id="reviews" class="woocommerce-Reviews"></div>
			<?php };
		}

		return $tabs;
	}

	/**
     * Form note
     *
     * @return string
     */
    public function get_notice_text() {
        return apply_filters( 'wecodeart/woocommerce/reviews/notice', sprintf(
			esc_html__( 'Hey %s, thank you for the review. If you have any problems with %s or if you have any questions please let us know!', 'wca-woocommerce' ),
			'<strong>{{ userName }}</strong>',
			'<strong>{{ productTitle }}</strong>'
		) );
	}
	
	/**
     * Terms Text
     *
     * @return string
     */
    public function get_terms_text() {
        if( $pp_page = get_option( 'wp_page_for_privacy_policy' ) ) {			
			return sprintf(
				esc_html__( 'By publishing the review, you agree with %s of the site!', 'wca-woocommerce' ),
				sprintf( '<a href="%s">%s</a>', get_privacy_policy_url(), get_the_title( $pp_page ) )
			);
		}

		return false;
    }

	/**
     * Privacy Policy
     *
     * @return string
     */
	public function get_verify_text() {
		$verify = get_option( 'woocommerce_review_rating_verification_required' ) === 'yes' ? true : false;
		$bought = wc_customer_bought_product( '', get_current_user_id(), wc_get_product()->get_id() );

		if( $verify && $bought !== true ) {
			return esc_html__( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' );
		}

		return false;
	}

	/**
	 * Update Comment
	 *
	 * @access public
	 */
	public function update_comment( $comment_id ) {
		$comment = get_comment( $comment_id );

		// Check if the comment type is 'review'
		if ( $comment->comment_type !== 'review' ) {
			return;
		}

		update_comment_meta( $comment_id, 'verified', wc_review_is_from_verified_owner( $comment_id ) );
	}

	/**
	 * Add WC Meta boxes.
	 */
	public function add_meta_boxes() {
		$screen    = get_current_screen();
        $screen_id = $screen ? $screen->id : '';
        
		// Review meta.
		if ( 'comment' === $screen_id && isset( $_GET['c'] ) && metadata_exists( 'comment', wc_clean( wp_unslash( $_GET['c'] ) ), 'likes' ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            add_meta_box(
                'wca-review-likes',
                __( 'Review Meta', 'wca-woo-likes' ),
                [ $this, 'output_meta_boxes' ],
                'comment',
                'normal',
                'high'
            );
		}
    }
    
	/**
	 * Output the metabox.
	 *
	 * @param object $comment Comment being shown.
	 */
	public function output_meta_boxes( $comment ) {
		wp_nonce_field( 'wca_save_data', 'wca_meta_nonce' );

		$current_title = get_comment_meta( $comment->comment_ID, 'title', true );
		$current_likes = get_comment_meta( $comment->comment_ID, 'likes', true );
		?>
        <fieldset id="namediv">
            <legend class="screen-reader-text"><?php esc_html_e( 'Review meta', 'wca-woocommerce' ); ?></legend>
            <table class="form-table editcomment" role="presentation">
                <tbody>
                    <tr>
                        <td class="first"><label for="title"><?php esc_html_e( 'Title', 'wca-woocommerce' ); ?></label></td>
                        <td><input type="text" name="title" value="<?php echo esc_attr( $current_title ); ?>" id="title" /></td>
                    </tr>
                    <tr>
                        <td class="first"><label for="likes"><?php esc_html_e( 'Likes', 'wca-woocommerce' ); ?></label></td>
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
	 * @param mixed $data Data to save.
	 * @return mixed
	 */
	public function save_meta_boxes( $data ) {
		// Not allowed, return regular value without updating meta.
		if (
            ! isset( $_POST['wca_meta_nonce'], $_POST['rating'] ) ||
            ! isset( $_POST['wca_meta_nonce'], $_POST['title'] ) ||
            ! wp_verify_nonce( wp_unslash( $_POST['wca_meta_nonce'] ), 'wca_save_data' )
        ) { 
			return $data;
        }

        $comment_id = $data['comment_ID'];

        update_comment_meta( $comment_id, 'title', sanitize_text_field( wp_unslash( $_POST['title'] ) ) );
        
        if ( $_POST['likes'] < 0 ) {
			return $data;
		}

		update_comment_meta( $comment_id, 'likes', intval( wp_unslash( $_POST['likes'] ) ) );

		// Return regular value after updating.
		return $data;
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
