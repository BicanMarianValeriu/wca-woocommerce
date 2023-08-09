<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Checkout
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Checkout block.
 */
class Checkout extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'checkout';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		$inline .= Frontend::get_loading_css(
			'.wc-block-checkout.is-loading :where(
				.wp-block-woocommerce-checkout-fields-block div[class*="wp-block-woocommerce-checkout-"],
				.wp-block-woocommerce-checkout-order-summary-block div[class*="wp-block-woocommerce-checkout-order-summary-"]
			)'
		);
		$inline .= '
			.wc-block-checkout.is-loading {
				display: flex;
				flex-wrap: wrap;
				gap: calc(2 * var(--wp--custom--gutter));
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-fields-block {
				flex: 1 1 auto;
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-totals-block {
				flex: 0 0 100%;
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-fields-block div[class*="wp-block-woocommerce-checkout-"] {
				min-height: 2.5rem;
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-shipping-address-block {
				min-height: 305px!important;
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-order-note-block {
				min-height: 100px!important;
			}
			.wc-block-checkout.is-loading :where(
				.wp-block-woocommerce-checkout-order-summary-coupon-form-block,
				.wp-block-woocommerce-checkout-order-summary-subtotal-block,
				.wp-block-woocommerce-checkout-order-summary-taxes-block
			) {
				min-height: 3.5rem;
			}
			.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-order-summary-block {
				position: sticky;
				top: var(--wp--header-height, 80px);
				align-self: flex-start;
			}
			@media (min-width: 991px) {
				.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-totals-block {
					flex: 0 0 30%;
				}
				.wc-block-checkout.is-loading .wp-block-woocommerce-checkout-actions-block {
					margin-left: auto;
					max-width: 300px;
				}
			}
		';

		$inline .= '
			.wc-block-checkout__form {
				counter-reset: checkout-step;
			}
			
			.wc-block-components-checkout-step {
				border: 0;
				margin: 0 0 1.5rem;
			}
			.wc-block-components-checkout-step--with-step-number {
				padding: 0 0 0 2rem;
			}
			.wc-block-components-checkout-step--with-step-number .wc-block-components-checkout-step__title {
				position: relative;
			}
			.wc-block-components-checkout-step--with-step-number .wc-block-components-checkout-step__title::before {
				content: " " counter(checkout-step) "."/"";
				position: absolute;
				top: 0;
				left: -1.5rem;
				margin: 0;
				padding: 0;
				text-align: center;
				transform: translateX(-50%);
				counter-increment: checkout-step;
			}
			.wc-block-components-checkout-step--with-step-number .wc-block-components-checkout-step__container {
				position: relative;
			}
			.wc-block-components-checkout-step--with-step-number .wc-block-components-checkout-step__container::before {
				content: "";
				position: absolute;
				top: 0;
				left: -1.5rem;
				height: 100%;
				border-left: 1px solid var(--wp--preset--color--accent);
			}
			.is-medium .wc-block-components-checkout-step__heading,
			.is-large .wc-block-components-checkout-step__heading {
				display: flex;
				justify-content: space-between;
				align-items: center;
			}
			.wc-block-components-checkout-step__heading-content {
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-components-checkout-step__heading-content a {
				color: inherit;
				font-weight: 500;
				margin-left: 0.5em;
			}
			.wc-block-components-checkout-step__title.wc-block-components-checkout-step__title {
				font-size: var(--wp--preset--font-size--large);
				font-weight: 500;
				margin: 0;
			}
			.wc-block-components-checkout-step__description {
				font-size: var(--wp--preset--font-size--small);
				opacity: .7;
			}

			.wc-block-checkout__actions {
				padding-top: 1rem;
				margin-top: 1rem;
				border-top: 1px solid var(--wp--preset--color--accent);
			}
			.is-root-container .wc-block-checkout__actions,
			.wc-block-checkout__actions_row {
				display: flex;
				justify-content: space-between;
				align-items: center;
			}
			.is-mobile .wc-block-checkout__actions .wc-block-components-checkout-return-to-cart-button {
				display: none;
			}
			.is-mobile .wc-block-checkout__actions .wc-block-components-checkout-place-order-button {
				width: 100%;
			}
			.wc-block-components-checkout-place-order-button.wp-element-button {
				background-color: var(--wp--preset--color--primary);
			}
		';

		return $inline;
	}
}
