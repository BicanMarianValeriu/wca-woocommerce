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
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Mini Cart Footer block.
 */
class Footer extends Base {

	use Singleton;

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
		return <<<CSS
			.wc-block-mini-cart__footer {
				border-top: 1px solid var(--wp--gray-300);
				padding: var(--wp--custom--gutter, 1rem) var(--wp--custom--gutter, 1rem);
			}
			.wc-block-mini-cart__footer-subtotal {
				font-weight: 600;
				margin-bottom: 1em;
			}
			.wc-block-mini-cart__footer-subtotal .wc-block-components-totals-item__description,
			.wc-block-mini-cart__footer-cart.wc-block-components-button.wp-element-button .wc-block-components-button__text {
				display: none;
			}
			.wc-block-mini-cart__footer-actions, 
			.wc-block-mini-cart__footer-actions .block-editor-block-list__layout {
				display: grid;
				grid-template-columns: auto 1fr;
				grid-gap: 1rem;
			}
			.wc-block-mini-cart__footer-actions .wp-element-button {
				display: grid;
				place-items: center;
				grid-template-columns: auto 1fr;
			}
			.wc-block-mini-cart__footer-actions .wp-element-button::before {
				content: '';
				display: block;
				width: 1.5em;
				height: 1.5em;
				background-color: var(--wp--preset--color--primary);
				-webkit-mask-repeat: no-repeat;
				-webkit-mask-size: contain;
			}
			.wc-block-mini-cart__footer-cart.wc-block-components-button.wp-element-button {
				background-color: transparent;
				border-color: currentColor;
				color: var(--wp--preset--color--primary);
			}
			.wc-block-mini-cart__footer-cart.wc-block-components-button.wp-element-button:hover {
				background-color: var(--wp--preset--color--primary);
				border-color: var(--wp--preset--color--primary);
				color: white;
			}
			.wc-block-mini-cart__footer-cart.wc-block-components-button.wp-element-button::before {
				-webkit-mask-image: var(--wc--icon--cart);
				mask-image: var(--wc--icon--cart);
			}
			.wc-block-mini-cart__footer-cart.wc-block-components-button.wp-element-button:hover::before {
				background-color: currentColor;
			}
			.wc-block-mini-cart__footer-checkout.wc-block-components-button.wp-element-button::before {
				background-color: currentColor;
				-webkit-mask-image: var(--wc--icon--checkout);
				mask-image: var(--wc--icon--checkout);
			}
			.wc-block-mini-cart__footer .wc-block-components-payment-method-icons {
				margin-top: 1em;
			}

			@media only screen and (min-width: 480px) {
				.wc-block-mini-cart__footer-subtotal .wc-block-components-totals-item__description {
					font-size: 0.75em;
					font-weight: 400;
					display: unset;
					width: 100%;
				}
			}
		CSS;
	}
}
