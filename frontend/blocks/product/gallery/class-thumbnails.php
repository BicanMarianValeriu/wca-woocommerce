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

namespace WCA\EXT\WOO\Frontend\Blocks\Product\Gallery;

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
class Thumbnails extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-gallery-thumbnails';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render_block'	], 20, 2 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '', $block = [] ): string {

		$thumb_size = get_prop( $block, [ 'attrs', 'thumbnailSize' ], '20%' ); 

		return str_replace( 
			' data-thumbnail-size', 
			sprintf( ' style="--thumb-basis:%s;" data-thumbnail-size', str_replace( '%', '', $thumb_size ) ), 
			$content 
		);
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			/* ---- Product Gallery Thumbnails ---- */
			.wc-block-product-gallery-thumbnails {
				--thumb-basis: 25;
				position: relative;
				aspect-ratio: 1 / calc(100 / var(--thumb-basis));
  				flex-basis: calc(var(--thumb-basis) * 1%);
			}
			.is-vertical .wc-block-product-gallery-thumbnails {
				aspect-ratio: calc(100 / var(--thumb-basis)) / 1;
				height: calc(var(--thumb-basis) * 1%);
			}
			.is-vertical .wc-block-product-gallery-thumbnails__scrollable {
				flex-direction: row;
			}
			.is-vertical .wc-block-product-gallery-thumbnails__thumbnail {
				flex: 0 0 auto;
				height: 100%;
				width: auto;
			}
			.wc-block-product-gallery-thumbnails__scrollable {
				display: flex;
				flex-direction: column;
				gap: 2%;
				height: 100%;
				pointer-events: auto;
				scrollbar-width: none;
				overflow: auto;
			}
			.wc-block-product-gallery-thumbnails__thumbnail { 
				display: flex; 
			}
			.wc-block-product-gallery-thumbnails__thumbnail__image {
				cursor: pointer;
				max-width: 100%;
				max-height: 100%;
				object-fit: cover;
				width: fit-content;
				outline-offset: -2px;
			}
			.wc-block-product-gallery-thumbnails__thumbnail__image--is-active {
				cursor: default;
				filter: brightness(.8);
				pointer-events: none;
			}
			/* ---- Overflow Gradients ---- */
			.wc-block-product-gallery-thumbnails--overflow-top {
				mask-image: linear-gradient(180deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%);
			}
			.wc-block-product-gallery-thumbnails--overflow-bottom {
				mask-image: linear-gradient(0deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%);
			}
			.wc-block-product-gallery-thumbnails--overflow-left {
				mask-image: linear-gradient(90deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%);
			}
			.wc-block-product-gallery-thumbnails--overflow-right {
				mask-image: linear-gradient(270deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%);
			}
			/* Combo classes for dual overflow states... */
			.wc-block-product-gallery-thumbnails--overflow-top.wc-block-product-gallery-thumbnails--overflow-bottom {
				mask-image: linear-gradient(180deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%,#000 86%,rgba(0,0,0,.3) 94%,transparent);
			}
			.wc-block-product-gallery-thumbnails--overflow-left.wc-block-product-gallery-thumbnails--overflow-right {
				mask-image: linear-gradient(90deg,transparent 0,rgba(0,0,0,.3) 6%,#000 14%,#000 86%,rgba(0,0,0,.3) 94%,transparent);
			}
		';
	}
}
