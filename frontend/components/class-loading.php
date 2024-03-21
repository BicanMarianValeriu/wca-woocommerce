<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Loading
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Loading Styles
 */
class Loading extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/checkout',
			'woocommerce/cart',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wp-element-button.wc-block-components-button {
				position: relative;
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
			.wc-block-components-loading-mask {
				position: relative;
				pointer-events: none;
				opacity: .5;
			}
			.wc-block-components-loading-mask::before {
				content: "";
				position: absolute;
				z-index: 50;
				display: block;
				top: 50%;
				left: 50%;
				height: 1.5em;
				width: 1.5em;
				transform: translate3d(-50%,-50%,0);
				background: url("' . untrailingslashit( WCA_WOO_EXT_URL ) . '/assets/images/loader-black.svg") center center;
				background-size: cover;
				font-size: 3rem;
				line-height: 1;
				text-align: center;
			}
        ';
	}
}
