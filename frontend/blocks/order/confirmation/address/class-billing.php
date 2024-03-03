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
class Billing extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-billing-address';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function block_type_args(): array {
		return [
			'style'	=> [ $this->get_asset_handle(), 'wc-blocks-style-order-confirmation-shipping-address' ]
		];
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			:where(.wc-block-order-confirmation-billing-address,.wc-block-order-confirmation-shipping-address) {
				box-sizing: border-box;
			}
		';
	}
}
