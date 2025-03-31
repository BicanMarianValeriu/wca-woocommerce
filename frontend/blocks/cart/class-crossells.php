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
	 * Block args.
	 *
	 * @return 	array
	 */
	public function block_type_args(): array {
		return [
			'style'	=> [ 
				$this->get_asset_handle(), // self
				'wc-blocks-style-product-collection', 
				'wc-blocks-style-product-button',
				'wc-blocks-style-product-rating',
				'wc-blocks-style-product-price',
				'wc-blocks-style-product-image',
			]
		];
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			/* Admin */
			.wp-block-woocommerce-cart-cross-sells-products-block > * > div {
				display: grid;
				grid-gap: 1rem;
				grid-template-columns: repeat(3, 1fr);
			}
			/* Frontend */
			.woocommerce-cart .wp-block-woocommerce-cart-cross-sells-block > div {
				display: grid;
				grid-gap: 1rem;
				grid-template-columns: 1fr;
			}
			.woocommerce-cart .is-medium .wp-block-woocommerce-cart-cross-sells-block > div {
				grid-template-columns: repeat(2, 1fr);
			}
			.woocommerce-cart .is-large .wp-block-woocommerce-cart-cross-sells-block > div {
				grid-template-columns: repeat(3, 1fr);
			}
			/* Shared */
			.wp-block-woocommerce-cart-cross-sells-block img {
				aspect-ratio: 1;
			}
			.wp-block-woocommerce-cart-cross-sells-block .cross-sells-product > div {
				display: flex;
				gap: .5rem;
				flex-direction: column;
				justify-content: inherit;
			}
			.wp-block-woocommerce-cart-cross-sells-block .cross-sells-product > div > * {
				margin: 0;
			}
		';
	}
}
