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

namespace WCA\EXT\WOO\Frontend\Blocks\Checkout;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary Coupon block.
 */
class Address extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'checkout-billing-address-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-components-address-form {
				display: flex;
				justify-content: space-between;
				flex-wrap: wrap;
			}
			.wc-block-components-address-form > * {
				flex: 1 1 100%;
			}
			:is(.is-small,.is-mobile) .wc-block-components-address-form__first_name {
				margin-top: 0;
			}
			:is(.is-medium,.is-large) :is(
				.wc-block-components-address-form__first_name,
				.wc-block-components-address-form__last_name
			) {
				margin-top: 0;
			}
			:where(.is-medium,.is-large) :is(
				.wc-block-components-address-form__first_name,
				.wc-block-components-address-form__last_name,
				.wc-block-components-address-form__city,
				.wc-block-components-address-form__postcode,
				.wc-block-components-address-form .wc-block-components-state-input,
				.wc-block-components-address-form .wc-block-components-country-input
			) {
				flex: 0 0 calc(50% - 0.75rem);
			}
		';
	}
}
