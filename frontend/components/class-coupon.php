<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Coupon
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Coupon Styles
 */
class Coupon extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
			'woocommerce/checkout-order-summary-coupon-form-block',
            'woocommerce/cart-order-summary-coupon-form-block',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-totals-coupon__form {
				display: flex;
			}
			.wc-block-components-totals-coupon__input {
				flex: 1 1 100%;
				margin: 0;
			}
			.wc-block-components-totals-coupon__button.wp-element-button {
				margin-left: 1rem;
				background-color: var(--wp--preset--color--primary);
			}
			.wc-block-components-totals-coupon__button.wp-element-button:disabled {
				opacity: 0.5;
			}      
        ';
	}
}
