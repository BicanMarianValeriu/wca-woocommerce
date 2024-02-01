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
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function preg_match;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Rating block.
 */
class Rating extends Base {

	use Singleton;

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
		$is_enabled = get_prop( wecodeart_option( 'woocommerce' ), [ 'product_rating_extra' ] );

		if( ! $is_enabled ) return;
		
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
		
		$regex = '/<div\b[^>]+wc-block-components-product-rating__container[\s|"][^>]*>/U';
		if ( $is_single_product && 1 === preg_match( $regex, $content, $matches, PREG_OFFSET_CAPTURE ) ) {
			$offset	= $matches[0][1];
			$offset	= strrpos( $content, '</div>', $offset );
    		$content = substr( $content, 0, $offset ) . $this->markup() . substr( $content, $offset );
		}

		// Fix double text align class ouput
		$content = preg_replace( '/(has-text-align-(left|center|right)) \1|has-text-align- has-text-align- /', '$1', $content );

		return $content;
	}

	/**
	 * Markup
	 *
	 * @return 	string
	 */
	public function markup(): string {
		$html = '';

		if( ! is_singular( 'product' ) ) {
			return $html;
		}

		$product 	= wc_get_product( get_queried_object_id() );
		$count		= $product->get_rating_count();

		if ( $count === 0 ) {
			return $html;
		}

		$average	= $product->get_average_rating();

		ob_start();
		?>
		<p class="wc-block-components-product-rating__stats"><?php
		
			printf(
				__( '%s of the customers recommend the product', 'wca-woocommerce' ),
				'<strong>' .  ( ( $average / 5 ) * 100 ) . '%</strong>'
			);
			
		?></p>
		<?php

		$html .= ob_get_clean();

		return $html;
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-rating', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wc-blocks-style-rating' ) || wp_style_is( $this->get_asset_handle() ) ) {
					return false;
				}

				// If any of this blocks styles are detected
				if( count( array_intersect( $blocks, [
					'woocommerce/all-reviews',
					'woocommerce/reviews-by-product',
					'woocommerce/reviews-by-category',
					'woocommerce/rating-filter',
				] ) ) ) {
					return true;
				}
				
				// Products
				if( Frontend\Blocks::has_products( $blocks ) ) {
					return true;
				}
			},
			'inline'	=> wecodeart( 'blocks' )->get( $this->get_block_type() )::get_instance()->styles()
		] );
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
				display: inline-flex;
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
				z-index: 2;
			}
			:is({$selectors}) > span:after {
				position: absolute;
				background-image: var(--wc--star);
				z-index: 1;
			}
			.wc-block-components-product-rating__reviews_count {
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
