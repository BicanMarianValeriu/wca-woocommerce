<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Chips
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Chips Styles
 */
class Chips extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
		if( wecodeart_if( 'is_woocommerce_archive' ) ) {
            return [];
        }
		
        return [
			'woocommerce/attribute-filter',
            'woocommerce/active-filters',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) {
				display: inline-flex;
				justify-content: space-between;
				margin-right: 0.5rem;
				padding: 0;
				background-color: var(--wp--preset--color--accent);
				color: var(--wp--gray-600);
				font-size: 0.65rem;
				line-height: 1.7;
				border: var(--wc--input--border);
			}
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > span {
				padding: 0.35em 1em;
			}
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > button {
				position: relative;
				background: transparent;
				font-size: inherit;
				padding: 0;
				margin: 0;
				border: 0;
				border-radius: inherit;
				box-shadow: 0 0 0 1px white;
				-webkit-appearance: none;
						appearance: none;
				cursor: pointer;
			}
			.theme-is-dark .wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > button {
				box-shadow: 0 0 0 1px var(--wp--preset--color--accent);
				color: var(--wp--gray-600);
			}
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > button::before {
				content: "";
				display: block;
				height: 0;
				width: 2.35em;
				padding-bottom: 100%;
			}
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > button:is(:hover,:focus) {
				background-color: var(--wp--preset--color--danger);
				outline-color: var(--wp--preset--color--danger);
				color: white;
			}
			.wp-block-woocommerce-filter-wrapper :where(.wc-block-components-chip,.components-form-token-field__token) > button svg {
				position: absolute;
				top: 50%;
				left: 50%;
				margin: 0;
				width: 2em;
				height: 2em;
				transform: translate3d(-50%, -50%, 0);
			}
            .wp-block-woocommerce-filter-wrapper .wc-block-components-chip--radius-large {
                border-radius: 50px;
            }        
        ';
	}
}
