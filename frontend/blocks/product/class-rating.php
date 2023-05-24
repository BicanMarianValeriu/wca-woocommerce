<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Rating
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_action;
use function add_filter;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Rating block.
 */
class Rating extends Dynamic {

	use Singleton;

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
	protected $block_name = 'product-rating';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'render_block_' . $this->get_block_type(), [ $this, 'render_block' ], 20, 2 );
	}

    /**
	 * Filter Render
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '', array $block = [] ): string {
		$is_single_product = get_prop( $block, [ 'attrs', 'isDescendentOfSingleProductTemplate' ] ) === true;

		$regex = '/<div\b[^>]+wc-block-components-product-rating__stars[\s|"][^>]*>/U';
		if ( $is_single_product && 1 === preg_match( $regex, $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			$offset	= $matches[0][1];
			$offset	= strrpos( $content, '</div>', $offset );
    		$content = substr( $content, 0, $offset ) . $this->markup() . substr( $content, $offset );
		}

		return $content;
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-rating', [
			'load'		=> function( $post_id, $template ) {
				if( wp_style_is( 'wp-block-rating' ) || wp_style_is( 'wp-block-product-rating' ) ) {
					return false;
				}

				if( has_block( 'woocommerce/reviews-by-category', $template ) || has_block( 'woocommerce/reviews-by-category', $post_id ) ) {
					return true;
				}
				
				if( has_block( 'woocommerce/reviews-by-product', $template ) || has_block( 'woocommerce/reviews-by-product', $post_id ) ) {
					return true;
				}
				
				if( has_block( 'woocommerce/all-reviews', $template ) || has_block( 'woocommerce/all-reviews', $post_id ) ) {
					return true;
				}
				
				if( has_block( 'woocommerce/cart-cross-sells-products-block', $post_id ) ) {
					return true;
				}

				if( wecodeart_if( 'is_woocommerce_archive' ) ) {
					return true;
				}
			},
			'inline'	=> wecodeart( 'blocks' )->get( $this->get_block_type() )::get_instance()->styles()
		] );
	}

	/**
	 * Markup
	 *
	 * @return 	string
	 */
	public function markup(): string {
		$html = '';

		global $product;

		if( ! is_object( $product ) ) {
			return $html;
		}

		$rating_count = $product->get_rating_count();

		if ( $rating_count === 0 || ! is_singular( 'product' ) ) {
			return $html;
		}

		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();

		ob_start();
		?> 
		<a href="#reviews" class="wc-block-components-product-rating__info" rel="nofollow">(<?php
			printf(
				_n( '%s customer review', '%s customer reviews', $review_count, 'wecodeart' ),
				'<span class="count">' . esc_html( $review_count ) . '</span>'
			);
		?>)</a>
		<p class="wc-block-components-product-rating__stats"><?php
		
			printf(
				__( '%s of the customers recommend the product', 'wecodeart' ),
				'<strong>' .  ( ( $average / 5 ) * 100 ) . '%</strong>'
			);
			
		?></p>
		<?php

		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$selectors = join( ',', [
			'.star-rating',
			'.wc-block-components-product-rating__stars',
			'.wc-block-components-review-list-item__rating__stars'
		] );

		return "
			:is({$selectors}) {
				position: relative;
				display: inline-block;
				vertical-align: middle;
				max-width: 5em;
				font-size: 1.25rem;
			}
			:is({$selectors}) > span {
				display: flex;
				max-width: 100%;
				height: 1em;
				overflow: hidden;
			}
			:is({$selectors}) > span::before,
			:is({$selectors}) > span::after {
				content: '';
				display: block;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				width: 100%;
				min-width: 100%;
				background-repeat: repeat-x;
				background-position: 0 center;
				background-size: 1em;
			}
			:is({$selectors}) > span:before {
				position: relative;
				background-image: var(--wc--star-active);
				z-index: 10;
			}
			:is({$selectors}) > span:after {
				position: absolute;
				background-image: var(--wc--star);
				z-index: 5;
			}
			.wc-block-components-product-rating__info {
				color: var(--wp--preset--color--black);
				margin-left: 1em;
				vertical-align: middle;
			}
			.wc-block-components-product-rating__stats {
				margin: 0;
				font-size: var(--wp--preset--font-size--small);
				color: var(--wp--preset--color--cyan-bluish-gray);
			}
		";
	}
}
