<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Summary\Shipping
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart\Summary;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary Shipping block.
 */
class Shipping extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'cart-order-summary-shipping-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-components-totals-shipping__fieldset {
				border: 1px solid var(--wp--preset--color--accent);
    			margin: 1rem 0 0;
				padding: 1rem;
			}
			.wc-block-components-shipping-calculator {
				margin-top: var(--wp--style--block-gap);
			}
			.wc-block-components-shipping-calculator-address__button.wp-element-button {
				display: block;
				margin: 0;
				width: 100%;
			}
		';
	}
}
