<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Gallery
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function apply_filters;
use function str_replace;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Gallery block.
 */
class Gallery extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-gallery';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render_block'	], 20 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '' ): string {
		wp_deregister_style( 'woocommerce-product-gallery-style' ); 		// Not needed
		wp_deregister_style( 'woocommerce-product-gallery-zoom-style' ); 	// Not needed

		return $content;
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-product-gallery.position-sticky {
				top: 90px;
			}
			.wc-block-product-gallery-large-image {
				position: relative;
				aspect-ratio: 1/1;
				width: 100%;
				overflow: hidden;
				display: grid;
				padding: 3px;
				flex-grow: 1;
			}
			.wc-block-product-gallery-large-image__container {
				align-items: center;
				display: flex ;
				margin: 0;
				overflow: hidden;
				padding: 0;
			}
			.wc-block-product-gallery-large-image__wrapper {
				align-items: center;
				aspect-ratio: 1 / 1;
				display: flex;
				flex-shrink: 0;
				justify-content: center;
				max-width: 100%;
				overflow: hidden;
				width: 100%;
			}
			.wc-block-components-product-image,
			.wc-block-components-product-image a {
				height: 100%;
				margin: 0;
				display: block;
			}
			.wc-block-components-product-image img,
			.wc-block-woocommerce-product-gallery-large-image__image--legacy {
				height: 100%;
				width: 100%; 
				display: block;
				margin: 0 auto;
				aspect-ratio: 1/1;
			}
			.wc-block-woocommerce-product-gallery-large-image__image {
				position: relative;
				transition: all .1s linear;
				z-index: 1;
				display: block;
			}
			.wc-block-woocommerce-product-gallery-large-image__image--full-screen-on-click {
				cursor: pointer;
			}
			.wc-block-woocommerce-product-gallery-large-image__image--hoverZoom {
				cursor: zoom-in;
			}

			/* ---- Inner Blocks Overlay ---- */
			.wc-block-product-gallery-large-image__inner-blocks {
				position: absolute;
				top: 5px; 
				left: 5px;
				width: calc(100% - 10px);
				height: calc(100% - 10px);
				display: flex;
				flex-direction: column;
			}
			.wc-block-product-gallery-large-image__inner-blocks > * { 
				margin: 0;
			} 
		';
	}
}
