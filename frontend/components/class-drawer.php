<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Drawer
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Drawer Styles
 */
class Drawer extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-drawer {
				--wp--drawer--width: 100%;
				position: fixed;
				background: var(--wp--preset--color--white);
				display: block;
				height: 100%;
				left: 100%;
				right: 0;
				top: 0;
				transform: translateX(calc(var(--wp--drawer--width) * -1));
				width: var(--wp--drawer--width);
			}
			.wc-block-components-drawer__close-wrapper {
				position: absolute;
				top: var(--wp--custom--gutter, 1rem);
				right: var(--wp--custom--gutter, 1rem);
			}
			.wc-block-components-drawer__close.wp-element-button {
				display: block;
				padding: 0;
				background: none;
				border: none;
				box-shadow: none;
				font-size: 1.5rem;
				color: inherit;
				z-index: 9999;
				cursor: pointer;
			}
			.wc-block-components-drawer__close svg {
				display: block;
				width: 1em;
				height: 1em;
			}
			.wc-block-components-drawer__close span {
				display: none;
			}
			.wc-block-components-drawer__screen-overlay {
				--wp--animation--duration: .3s;
				position: fixed;
				bottom: 0;
				left: 0;
				right: 0;
				top: 0;
				background-color: rgba(95, 95, 95, 0.35);
				transition: opacity var(--wp--animation--duration);
				opacity: 1;
				z-index: 9999;
				pointer-events: none;
			}
			.is-root-container .wc-block-components-drawer__screen-overlay {
				display: none;
			}
			.wc-block-components-drawer__content {
    			position: relative;
				height: 100vh;
			    height: 100dvh;
			}
			.wc-block-components-drawer__screen-overlay--with-slide-in {
				animation-duration: var(--wp--animation--duration);
				animation-name: animation__fadeIn;
			}
			.wc-block-components-drawer__screen-overlay--with-slide-in .wc-block-components-drawer {
				animation-duration: var(--wp--animation--duration);
				animation-name: animation__slideOut;
			}
			.wc-block-components-drawer__screen-overlay--with-slide-out .wc-block-components-drawer {
				transition: transform var(--wp--animation--duration) ease-in-out;
			}
			.wc-block-components-drawer__screen-overlay--is-hidden {
				pointer-events: none;
				opacity: 0;
			}
			.wc-block-components-drawer__screen-overlay--is-hidden .wc-block-components-drawer {
				transform: translateX(0);
			}
			@media only screen and (min-width: 480px) {
				.wc-block-components-drawer {
					--wp--drawer--width: 480px;
				}
			}   
        ';
	}
}
