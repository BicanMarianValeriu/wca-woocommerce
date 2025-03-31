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

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Checkout block.
 */
class Actions extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'checkout-actions-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '
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
				width: 100%;
			}
			.wc-block-components-checkout-return-to-cart-button {
				display: flex;
				align-items: center;
				gap: .5rem;
			}
			.wc-block-components-checkout-place-order-button {
				display: grid;
				place-items: center;
				grid-template-columns: auto 1fr;
				grid-gap: 1em;
			}
			.wc-block-components-checkout-place-order-button::before {
				content: "";
				display: block;
				width: 1.5em;
				height: 1.5em;
				margin-top: -5px;
				background-color: currentColor;
				-webkit-mask-repeat: no-repeat;
				-webkit-mask-size: contain;
				-webkit-mask-image: var(--wc--icon--checkout);
				mask-image: var(--wc--icon--checkout);
			}
			.is-mobile .wc-block-checkout__actions .wc-block-components-checkout-return-to-cart-button {
				display: none;
			}
			.is-mobile .wc-block-checkout__actions .wc-block-components-checkout-place-order-button {
				width: 100%;
			}
		';

		return $inline;
	}
}
