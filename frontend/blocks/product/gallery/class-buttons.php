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
	 * Block args.
	 *
	 * @param	array $current	Existing register args
	 *
	 * @return 	array
	 */
	public function block_type_args( array $current ): array {
		return [];
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return ' 
			.wc-block-next-previous-buttons {
				display: flex;
				align-items: center;
				justify-content: space-between;
				width: 100%; 
				height: 100%;
				pointer-events: none;
			}
			.wc-block-next-previous-buttons__button {
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
			.wc-block-next-previous-buttons__icon {
				display: block;
				margin: auto;
				padding: 0;
			}
			.wc-block-next-previous-buttons__button[aria-disabled="true"] {
				cursor: not-allowed;
			}
			.wc-block-next-previous-buttons__button[aria-disabled="true"] .wc-block-next-previous-buttons__icon {
				opacity: 0.3;
			}
		';
	}
}
