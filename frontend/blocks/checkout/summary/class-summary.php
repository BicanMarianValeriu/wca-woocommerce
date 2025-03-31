<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Checkout\Summary
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary block.
 */
class Summary extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'checkout-order-summary-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '
			.wc-block-components-checkout-order-summary__title {
				display: flex;
				justify-content: space-between;
			}
			.wc-block-components-checkout-order-summary__title .wc-block-formatted-money-amount {
				margin-left: auto;
    			margin-right: 1rem;
			}
			.wc-block-components-checkout-order-summary__title-text {
				margin: 0;
				font-size: var(--wp--preset--font-size--medium);
			}
			.wc-block-components-checkout-order-summary__content {
				display: none;
				margin-top: var(--wp--custom--gutter, 1rem);
			}
			.wc-block-components-checkout-order-summary__content > .wc-block-components-totals-wrapper:last-child {
				padding-bottom: 0;
			}
			.is-large .wc-block-components-checkout-order-summary__content,
			.wc-block-components-checkout-order-summary__content.is-open {
				display: block;
			}
			.wp-block-woocommerce-checkout-order-summary-block .checkout-order-summary-block-fill {
				margin-top: var(--wp--custom--gutter, 1rem);
			}
		';

		return $inline;
	}
}
