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
class Buttons extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-gallery-large-image-next-previous';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			/* ---- Product Gallery Buttons ---- */
			.wc-block-product-gallery-large-image-next-previous {
				display: flex;
				align-items: center;
				justify-content: space-between;
				width: 100%; 
				height: 100%;
				pointer-events: none;
			}
			.wc-block-product-gallery-large-image-next-previous__button {
				background: #fff;
				border: none;
				cursor: pointer;
				font-size: 12px;
				height: 40px;
				width: 40px;
				padding: 0;
				outline-offset: -2px;
				pointer-events: all;
				z-index: 3;
			}
			.wc-block-product-gallery-large-image-next-previous__button[aria-disabled="true"] {
				cursor: not-allowed;
			}
			.wc-block-product-gallery-large-image-next-previous__button[aria-disabled="true"] .wc-block-product-gallery-large-image-next-previous__icon {
				opacity: 0.3;
			}
		';
	}
}
