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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Cart Cross Sells block.
 */
class Crossells extends Dynamic {

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
	protected $block_name = 'cart-cross-sells-products-block';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();
		
		// wecodeart( 'assets' )->add_style( 'wp-block-products', [
		// 	'load'		=> function( $post_id, $template ) {
		// 		if( wp_style_is( 'wp-block-products' ) || wp_style_is( 'wp-block-all-products' ) ) {
		// 			return false;
		// 		}

		// 		if( has_block( $this->get_block_type(), $template ) || has_block( $this->get_block_type(), $post_id ) ) {
		// 			return true;
		// 		}
		// 	},
		// 	'inline'	=> wecodeart( 'blocks' )->get( 'woocommerce/all-products' )::get_instance()->styles()
		// ] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
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
		';
	}
}
