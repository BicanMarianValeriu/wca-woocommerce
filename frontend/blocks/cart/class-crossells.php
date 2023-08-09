<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Crossells
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Cart Cross Sells block.
 */
class Crossells extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'cart-cross-sells-products-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			/* Admin */
			.wp-block-woocommerce-cart-cross-sells-products-block .cross-sells-product {
				display: inline-flex;
				margin-right: calc(5% - 2px);
				padding: 0;
			}
			.wp-block-woocommerce-cart-cross-sells-products-block .cross-sells-product:nth-child(3n+3) {
				margin-right: 0;
			}
			/* Frontend */
			.woocommerce-cart .wp-block-woocommerce-cart-cross-sells-block > div {
				display: grid;
				grid-gap: 1rem;
				grid-template-columns: 1fr;
			}
			.woocommerce-cart .cross-sells-product > div {
				display: inherit;
				gap: inherit;
				flex-direction: inherit;
				justify-content: inherit;
			}
			.woocommerce-cart .is-medium .wp-block-woocommerce-cart-cross-sells-block > div {
				grid-template-columns: repeat(2, 1fr);
			}
			.woocommerce-cart .is-large .wp-block-woocommerce-cart-cross-sells-block > div {
				grid-template-columns: repeat(3, 1fr);
			}
		';
	}
}
