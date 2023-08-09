<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Summary\Coupon
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart\Summary;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary Coupon block.
 */
class Coupon extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'cart-order-summary-coupon-form-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return wecodeart( 'blocks' )->get( 'woocommerce/checkout-order-summary-coupon-form' )::get_instance()->styles();
	}
}
