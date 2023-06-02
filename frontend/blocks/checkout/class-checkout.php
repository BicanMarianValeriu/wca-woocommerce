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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Checkout block.
 */
class Checkout extends Dynamic {

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
	protected $block_name = 'checkout';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
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
	}
}
