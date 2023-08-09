<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Notices
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Store Notices block.
 */
class Notices extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'store-notices';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-notices', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wc-blocks-style-notices' ) || wp_style_is( 'wc-blocks-style-store-notices' ) ) {
					return false;
				}

				if( count( array_intersect( $blocks, [
					'woocommerce/cart-order-summary-shipping-block',
					'woocommerce/checkout-shipping-methods-block',
					'woocommerce/checkout-payment-block'
				] ) ) ) {
					return true;
				}

				if( is_account_page() ) {
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
			:where(.wc-block-components-notices,.woocommerce-notices-wrapper):not(:empty),
			.wc-block-store-notices .components-notice {
				margin: 0 0 var(--wp--style--block-gap);
			}
			.woocommerce-notices-wrapper:empty {
				display: none;
			}
			.wc-block-store-notices + * {
				margin-top: 0!important;
			}
		';
	}
}
