<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary block.
 */
class Cart extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'cart';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		$inline .= Frontend::get_loading_css(
			'.wp-block-woocommerce-cart.is-loading :where(
				.wp-block-woocommerce-cart-line-items-block,
				.wp-block-woocommerce-cart-cross-sells-block,
				.wp-block-woocommerce-cart-express-payment-block,
				.wp-block-woocommerce-cart-accepted-payment-methods-block,
				.wp-block-woocommerce-cart-order-summary-block div[class*="wp-block-woocommerce-cart-order-summary-"]
			)'
		);
		$inline .= '
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-filled-cart-block {
				display: flex;
				flex-wrap: wrap;
				gap: calc(2 * var(--wp--custom--gutter));
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-items-block {
				flex: 1 1 auto;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block {
				flex: 0 0 100%;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-line-items-block {
				min-height: 205px;
			}
			.wp-block-woocommerce-cart.is-loading :where(
				.wp-block-woocommerce-cart-express-payment-block,
				.wp-block-woocommerce-cart-accepted-payment-methods-block
			) {
				min-height: 2.5rem;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-empty-cart-block {
				display: none;
			}
			@media (min-width: 991px) {
				.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block {
					flex: 0 0 30%;
				}
				.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block > div:last-child {
					margin-left: auto;
					max-width: 50%;
				}
			}
		';
		
		$inline .= '
			.wc-block-cart__totals-title.wc-block-cart__totals-title {
				display: block;
				padding: 1rem 0;
				font-size: var(--wp--preset--font-size--normal);
				font-weight: 700;
				text-align: right;
			}
			.wc-block-cart__submit {
				margin-top: var(--wp--preset--spacing--md);
			}
			.wc-block-cart__submit-container {
				text-align: right;
			}
			.wc-block-cart__submit-button.wp-element-button {
				background-color: var(--wp--preset--color--primary);
				color: var(--wp--preset--color--white);
			}
			.wc-block-cart__submit-button.wp-element-button:hover {
				color: var(--wp--preset--color--white);
			}

			.wc-block-cart-items {
				width: 100%;
			}
			.wc-block-cart-items > :not(caption) > * > * {
				border-bottom: 1px solid var(--wp--preset--color--accent);
			}
			.wc-block-cart-items__header-image,
			.wc-block-cart-items__header-product,
			.wc-block-cart-items__header-total {
				padding: 1rem 0;
				text-align: left;
			}
			.wc-block-cart-items__header-product {
				padding: 1rem;
			}
			.wc-block-cart-items__header-total {
				text-align: right;
			}
			.wc-block-cart-items__row {
				position: relative;
				vertical-align: top;
			}
			
			.wc-block-cart-item__image {
				padding: 0.5rem 0;
				width: 65px;
			}
			@media (min-width: 576px) {
				.wc-block-cart-item__image {
					width: 100px;
				}
			}
			.wc-block-cart-item__image img {
				margin-top: 5px;
			}
			.wc-block-cart-item__product {
				padding: 0.5rem 1rem;
			}
			.is-disabled .wc-block-cart-item__product::before {
				content: "";
				position: absolute;
				z-index: 50;
				display: block;
				top: 50%;
				left: 50%;
				height: 1.5em;
				width: 1.5em;
				transform: translate3d(-50%, -50%, 0);
				background: url("' . untrailingslashit( WCA_WOO_EXT_URL ) . '/assets/images/loader-black.svg") center center;
				background-size: cover;
				font-size: 3rem;
				line-height: 1;
				text-align: center;
			}
			.wc-block-cart-item__product .wc-block-components-product-name {
				display: block;
				font-weight: 700;
				line-height: 1.2;
			}
			.wc-block-cart-item__product .wc-block-components-product-badge {
				margin-right: 0.5rem;
			}
			.wc-block-cart-item__product .wc-block-components-product-details {
				font-size: .65rem;
				margin: 0 0 0.5rem;
				padding: 0;
				list-style: none;
			}
			.wc-block-cart-item__total {
				padding: 0.5rem 0;
				text-align: right;
			}
			:is(
				.wc-block-cart-item__product .wc-block-components-product-metadata__description,
				.wc-block-cart-item__total .wc-block-components-sale-badge,
				.wc-block-cart-item__prices,
				.wc-block-cart__submit-container--sticky
			) {
				display: none;
			}
			.wc-block-cart-item__quantity {
				font-size: var(--wp--preset--font-size--small);
				margin-top: 0.5rem;
			}
			.wc-block-cart-item__quantity .wc-block-components-quantity-selector {
				margin-bottom: 0.5rem;
			}
			.wc-block-cart-item__remove-link {
				display: block;
				background: none;
				color: inherit;
				border: none;
				box-shadow: none;
				outline: none;
				padding: 0;
				opacity: .5;
				font-size: var(--wp--preset--font-size--small);
				cursor: pointer;
			}
			.wc-block-cart-item__remove-link:hover {
				opacity: 1;
			}
		';

		return $inline;
	}
}
