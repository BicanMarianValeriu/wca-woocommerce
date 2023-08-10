<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Widget\Items
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart\Widget;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Mini Cart Contents block.
 */
class Contents extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart-contents';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-mini-cart-contents {
				height: 100vh;
			}
			.wp-block-woocommerce-empty-mini-cart-contents-block,
			.wp-block-woocommerce-filled-mini-cart-contents-block {
				display: flex;
				flex-direction: column;
				height: 100%;
			}
			.wp-block-woocommerce-empty-mini-cart-contents-block {
				justify-content: center;
			}
			.wp-block-woocommerce-filled-mini-cart-contents-block {
				justify-content: space-between;
			}
		';
	}
}
