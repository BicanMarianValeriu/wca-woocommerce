<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary block.
 */
class Cart extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'cart';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		
		$inline .= Frontend::get_loading_css(
			'.wp-block-woocommerce-cart.is-loading :where(
				.wp-block-woocommerce-cart-line-items-block,
				.wp-block-woocommerce-cart-cross-sells-block,
				.wp-block-woocommerce-cart-express-payment-block,
				.wp-block-woocommerce-cart-accepted-payment-methods-block,
				.wp-block-woocommerce-cart-order-summary-block div[class*="wp-block-woocommerce-cart-order-summary-"]
			)'
		);

		$inline .= '
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-filled-cart-block {
				display: flex;
				flex-wrap: wrap;
				gap: calc(2 * var(--wp--custom--gutter));
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-items-block {
				flex: 1 1 auto;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block {
				flex: 0 0 100%;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-line-items-block {
				min-height: 205px;
			}
			.wp-block-woocommerce-cart.is-loading :where(
				.wp-block-woocommerce-cart-express-payment-block,
				.wp-block-woocommerce-cart-accepted-payment-methods-block
			) {
				min-height: 2.5rem;
			}
			.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-empty-cart-block {
				display: none;
			}
			@media (min-width: 991px) {
				.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block {
					flex: 0 0 30%;
				}
				.wp-block-woocommerce-cart.is-loading .wp-block-woocommerce-cart-totals-block > div:last-child {
					margin-left: auto;
					max-width: 50%;
				}
			}
		';

		return $inline;
	}
}
