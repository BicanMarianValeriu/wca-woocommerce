<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\More
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * More Styles
 */
class More extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/reviews-by-category',
            'woocommerce/reviews-by-product',
			'woocommerce/all-reviews',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-load-more .wp-element-button.wp-block-button__link {
				font-size: var(--wp--preset--font-size--small);
				background-color: var(--wp--preset--color--primary);
			}
        ';
	}
}
