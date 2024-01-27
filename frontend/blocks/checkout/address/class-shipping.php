<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Checkout\Address
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout\Address;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary Coupon block.
 */
class Shipping extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'checkout-shipping-address-block';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		$billing = wecodeart( 'blocks' )->get( 'woocommerce/checkout-billing-address-block' )::get_instance();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-billing-address', [
			'load'		=> function( $blocks ) use( $billing ) {
				if( wp_style_is( 'wc-blocks-style-billing-address' ) || wp_style_is( $billing->get_asset_handle() ) ) {
					return false;
				}

				if( in_array( $this->get_block_type(), $blocks ) ) {
					return true;
				}
			},
			'inline'	=> $billing->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-checkout-shipping-address-block {
				box-sizing: border-box;
			}
		';
	}
}
