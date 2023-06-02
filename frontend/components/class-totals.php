<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Totals
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Totals Styles
 */
class Totals extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
		// Global - mini cart
		return [];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-totals-item {
				display: flex;
				flex-wrap: wrap;
				width: 100%;
			}
			.wc-block-components-totals-item__label {
				flex-grow: 1;
			}
			.wc-block-components-totals-item__value {
				font-weight: 700;
			}
			.wc-block-components-totals-item__description {
				flex: 0 0 100%;
			}   
        ';
	}
}
