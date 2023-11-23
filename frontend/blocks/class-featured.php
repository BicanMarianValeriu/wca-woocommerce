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

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Featured Product block.
 */
class Featured extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'featured-product';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-featured-category', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wc-blocks-style-featured-category' ) || wp_style_is( $this->get_asset_handle() ) ) {
					return false;
				}

				if( in_array( 'woocommerce/featured-category', $blocks ) ) {
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
			div[class*=wc-block-featured-] {
				position: relative;
				overflow: hidden;
			}
			div[class*=wc-block-featured-].alignnone {
				margin: 0;
			}
			div[class*=wc-block-featured-].has-left-content div[class*=__wrapper] {
				align-items: flex-start;
				text-align: left;
			}
			div[class*=wc-block-featured-].has-right-content div[class*=__wrapper] {
				align-items: flex-end;
				text-align: right;
			}
			div[class*=wc-block-featured-].has-text-color * {
				color: inherit;
			}
			div[class*=wc-block-featured-] div[class*=__wrapper] {
				display: flex;
				flex-direction: column;
				justify-content: center;
				text-align: center;
				min-height: 500px;
				border-radius: inherit;
				padding: var(--wp--custom--gutter, 1rem);
			}
			div[class*=wc-block-featured-] div[class*=__wrapper] > :not(.background-dim__overlay, *[class*=__background-image]) {
				position: relative;
				z-index: 2;
			}
			div[class*=wc-block-featured-] *[class*=__price] {
				margin-bottom: 1rem;
			}
			div[class*=wc-block-featured-] .background-dim__overlay,
			div[class*=wc-block-featured-] *[class*=__background-image] {
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				border-radius: inherit;
			}
			div[class*=wc-block-featured-] .background-dim__overlay {
				opacity: var(--wp--bg--opacity, 0.5);
				pointer-events: none;
				z-index: 1;
			}
			div[class*=wc-block-featured-] *[class*=__background-image] {
				display: block;
				width: 100%;
				height: 100%;
				object-fit: none;
			}
			div[class*=wc-block-featured-] .has-parallax {
				background-attachment: fixed;
			}
		';
	}
}