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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Summary block.
 */
class Summary extends Dynamic {

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
	protected $block_name = 'checkout-order-summary-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-components-totals-wrapper {
				position: relative;
				padding: 1rem 0;
			}
			.wc-block-components-totals-wrapper:empty {
				display: none;
			}
			.woocommerce-page .wc-block-components-totals-wrapper:last-child {
				padding-bottom: 0;
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
			.wc-block-components-totals-footer-item {
				font-size: var(--wp--preset--font-size--large);
			}
			.wc-block-components-totals-footer-item .wc-block-components-totals-item__label {
				font-weight: 700;
			}
		';
	}
}
