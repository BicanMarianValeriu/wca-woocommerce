<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Featured
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Featured;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Featured Category block.
 */
class Category extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'featured-category';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		$featured = wecodeart( 'blocks' )->get( 'woocommerce/featured-product' )::get_instance();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-featured', [
			'load'		=> function( $blocks ) use( $featured ) {
				if( wp_style_is( 'wc-blocks-style-featured' ) || wp_style_is( $featured->get_asset_handle() ) ) {
					return false;
				}

				if( in_array( $this->get_block_type(), $blocks ) ) {
					return true;
				}
			},
			'inline'	=> $featured->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block.wp-block:is(.wp-block-woocommerce-featured-category) {
				background: none!important;
			}
		';
	}
}