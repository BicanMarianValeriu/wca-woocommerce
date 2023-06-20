<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Checkout\Shipping
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Shipping Method block.
 */
class Shipping extends Dynamic {

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
	protected $block_name = 'checkout-shipping-method-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-checkout__shipping-method-container {
				display: flex;
				gap: var(--wp--custom--gutter);
				justify-content: space-between;
				width: 100%;
			}
			.wc-block-checkout__shipping-method-option {
				display: flex;
				align-items: center;
				justify-content: center;
				flex-basis: 0;
				flex-direction: column;
				flex-grow: 1;
				background-color: transparent;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0;
				box-shadow: none;
				gap: 5px;
				min-height: 80px;
				padding: var(--wp--custom--gutter);
				color: inherit;
				font-family: inherit;
				font-size: inherit;
				font-style: inherit;
				font-weight: inherit;
				letter-spacing: inherit;
				line-height: inherit;
				text-decoration: inherit;
				text-transform: inherit;
				cursor: pointer;
			}
			.wc-block-checkout__shipping-method-option--selected {
				background-color: var(--wp--preset--color--accent);
				border-color: var(--wp--preset--color--primary);
			}
			.wc-block-checkout__shipping-method-option-price {
				font-size: small;
				opacity: .75;
			}
		';
	}
}
