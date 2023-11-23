<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Address
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Address;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Order Confirmation Address block.
 */
class Shipping extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-shipping-address';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-address', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wc-blocks-style-address' ) || wp_style_is( $this->get_asset_handle() ) ) {
					return false;
				}

				if( in_array( 'woocommerce/order-confirmation-billing-address', $blocks, true ) ) {
					return true;
				}
			},
			'inline'	=> wecodeart( 'blocks' )->get( $this->get_block_type() )::get_instance()->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			:where(.wc-block-order-confirmation-billing-address,.wc-block-order-confirmation-shipping-address) {
				--wc--icon: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' fill=\'currentColor\' viewBox=\'0 0 16 16\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z\'/%3E%3C/svg%3E");
				border: 1px solid hsla(0,0%,7%,.115);
				border-radius: 5px;
				padding: var(--wp--custom--gutter);
			}
			:where(.wc-block-order-confirmation-billing-address,.wc-block-order-confirmation-shipping-address) address {
				display: block;
				width: 100%;
				margin: 0 0 var(--wp--custom--gutter);
			}
			:where(.wc-block-order-confirmation-billing-address,.wc-block-order-confirmation-shipping-address) p:last-child {
				margin-bottom: 0;
			}
			:where(.wc-block-order-confirmation-billing-address,.wc-block-order-confirmation-shipping-address) .woocommerce-customer-details--phone::before {
				content: "";
				display: inline-flex;
				vertical-align: middle;
				width: 1em;
				height: 1em;
				margin-right: .5em;
				background-color: currentColor;
				-webkit-mask-position: center;
				-webkit-mask-size: contain;
				-webkit-mask-image: var(--wc--icon);
					mask-image: var(--wc--icon);
			}
		';
	}
}
