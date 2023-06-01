<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Widget\Footer
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart\Widget;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Mini Cart Footer block.
 */
class Footer extends Dynamic {

	use Singleton;

	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'woocommerce';

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart-footer-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-mini-cart__footer {
				border-top: 1px solid var(--wp--gray-300);
				padding: var(--wp--custom--gutter, 1rem) var(--wp--custom--gutter, 1rem);
			}
			.wc-block-mini-cart__footer-subtotal {
				font-weight: 600;
				margin-bottom: 1em;
			}
			.wc-block-mini-cart__footer-subtotal .wc-block-components-totals-item__description,
			.wc-block-mini-cart__footer-cart.wp-element-button {
				display: none;
			}
			.wc-block-mini-cart__footer-checkout.wp-element-button {
				display: block;
				background-color: var(--wp--preset--color--primary);
				color: var(--wp--preset--color--white);
			}
			.wc-block-mini-cart__footer .wc-block-components-formatted-money-amount {
				color: var(--wp--preset--color--black);
			}
			.wc-block-mini-cart__footer .wc-block-components-payment-method-icons {
				margin-top: 1em;
			}
			
			.wc-block-components-totals-wrapper {
				position: relative;
				padding: 1rem 0;
			}
			.wc-block-components-totals-wrapper:empty {
				display: none;
			}
			.wc-block-components-totals-wrapper::before {
				content: "";
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				border-style: solid;
				border-width: 1px 0 0;
				border-color: var(--wp--preset--color--accent);
				display: block;
				pointer-events: none;
			}
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
			.wc-block-components-totals-footer-item {
				font-size: var(--wp--preset--font-size--large);
			}
			.wc-block-components-totals-footer-item .wc-block-components-totals-item__label {
				font-weight: 700;
			}

			@media only screen and (min-width: 480px) {
				.wc-block-mini-cart__footer-subtotal .wc-block-components-totals-item__description {
					font-size: 0.75em;
					font-weight: 400;
					display: unset;
					width: 100%;
				}
				.wc-block-mini-cart__footer-actions {
					display: grid;
					gap: 1em;
					grid-template-columns: 1fr 2fr;
				}
				.wc-block-mini-cart__footer-cart.wp-element-button {
					display: block;
					background-color: transparent;
					border-color: currentColor;
					color: var(--wp--preset--color--primary);
				}
				.wc-block-mini-cart__footer-cart.wp-element-button:hover {
					background-color: var(--wp--preset--color--primary);
					border-color: var(--wp--preset--color--primary);
					color: white;
				}
			}
		';
	}
}
