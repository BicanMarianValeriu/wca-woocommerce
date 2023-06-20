<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Notices
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Notices Styles
 */
class Notices extends Base {
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
			.wc-block-components-notice-banner {
				display: flex;
				align-items: center;
				gap: var(--wp--custom--gutter);
				padding: var(--wp--custom--gutter);
				border-left: 5px solid rgba(0, 0, 0, 0.15);
				background-color: var(--wp--preset--color--accent);
			}
			.wc-block-components-notice-banner__content {
				flex-basis: 100%;
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-components-notice-banner .wp-element-button {
				float: right;
				padding: 5px 10px;
			}
			.wc-block-components-notice-banner > svg {
				background-color: currentColor;
				border-radius: 50%;
				flex-grow: 0;
				flex-shrink: 0;
				padding: 2px;
				fill: white;
			}
			.wc-block-components-notice-banner.is-info {
				color: var(--wp--preset--color--dark);
			}
			.wc-block-components-notice-banner.is-success {
				color: var(--wp--preset--color--success);
				border-color: var(--wp--preset--color--success);
			}
			.wc-block-components-notice-banner.is-success .wp-element-button {
				background-color: var(--wp--preset--color--success);
			}
			.wc-block-components-notice-banner.is-error {
				color: var(--wp--preset--color--danger);
				border-color: var(--wp--preset--color--danger);
			}
			.wc-block-components-notice-banner.is-error .wp-element-button {
				background-color: var(--wp--preset--color--danger);
			}
			.wc-block-components-notice-banner.is-warning {
				color: var(--wp--preset--color--warning);
				border-color: var(--wp--preset--color--warning);
			}
			.wc-block-components-notice-banner.is-warning .wp-element-button {
				background-color: var(--wp--preset--color--warning);
			}

			.wc-block-components-notice-snackbar-list {
				position: fixed;
				left: var(--wp--custom--gutter);
				bottom: var(--wp--custom--gutter);
				z-index: 5;
			}   
        ';
	}
}
