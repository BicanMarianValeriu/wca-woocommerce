<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Address
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Buttons Styles
 */
class Buttons extends Base {
	
	static $deps = [ 'animations' ];

    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/checkout-actions-block',
            'woocommerce/proceed-to-checkout-block',
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
			.wc-block-components-button.wp-element-button {
				position: relative;
				background-color: var(--wp--preset--color--primary);
    			cursor: pointer;
				height: initial;
			}
			.wp-element-button.wc-block-components-button--loading {
				padding-left: 3em;
			}
			.wp-element-button.wc-block-components-button--loading:before {
				content: "";
				position: absolute;
				left: 0;
				top: 0;
				bottom: 0;
				margin: 0;
				display: block;
				width: 3em;
				height: auto;
				background-color: currentColor;
				-webkit-mask-repeat: no-repeat;
				-webkit-mask-position: center;
				-webkit-mask-size: 1.125em;
				-webkit-mask-image: var(--wc--icon--arrow);
				mask-image: var(--wc--icon--arrow);
				animation: animation__rotate 1s linear infinite;
			}
            .wc-block-components-button.wp-element-button .wc-block-components-button__text {
				display: inline-block;
			}
        ';
	}
}
