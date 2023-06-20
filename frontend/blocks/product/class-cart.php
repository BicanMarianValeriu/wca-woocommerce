<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Cart
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WCA\EXT\WOO\Frontend;

/**
 * Gutenberg Product Add to Cart Form block.
 */
class Cart extends Dynamic {

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
	protected $block_name = 'add-to-cart-form';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			form.cart .woocommerce-variations *[class*="woocommerce-variation-"] {
				margin-top: 1rem;
			}
			form.cart .woocommerce-variations *[class*="woocommerce-variation-"]:empty {
				display: none;
			}
			form.cart .woocommerce-variation-price {
				line-height: 1;
			}
			form.cart a.reset_variations {
				position: absolute;
				bottom: 100%;
				right: 0;
			}
			.single-product .wp-block-post-excerpt__text {
				margin-bottom: 0;
			}
		';
	}
}
