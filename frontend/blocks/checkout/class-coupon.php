<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Checkout\Summary\Coupon
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout\Summary;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Summary Coupon block.
 */
class Coupon extends Dynamic {

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
	protected $block_name = 'checkout-order-summary-coupon-form-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-components-totals-coupon__form {
				display: flex;
			}
			.wc-block-components-totals-coupon__input {
				flex: 1 1 100%;
				margin: 0;
			}
			.wc-block-components-totals-coupon__button.wp-element-button {
				margin-left: 1rem;
				background-color: var(--wp--preset--color--primary);
			}
			.wc-block-components-totals-coupon__button.wp-element-button:disabled {
				opacity: 0.5;
			}
		';
	}
}
