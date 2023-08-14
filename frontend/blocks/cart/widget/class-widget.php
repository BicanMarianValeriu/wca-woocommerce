<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Widget
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Mini Cart block.
 */
class Widget extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-cart-dep', [
			'load'		=> function( $blocks ) {			
				if( wp_style_is( 'wc-blocks-style-cart' ) || wp_style_is( 'wc-blocks-style-cart-dep' ) ) {
					return false;
				}

				// Global
				return true;
			},
			'inline'	=> wecodeart( 'blocks' )->get( 'woocommerce/cart' )::get_instance()->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-mini-cart {
				display: inline-flex;
				flex-direction: column;
				justify-content: center;
			}
			.wc-block-mini-cart[aria-hidden=true] {
				display: none;
			}
			.wc-block-mini-cart__button {
				display: flex;
				align-items: center;
				background-color: transparent;
				border: none;
				color: inherit;
				font-size: inherit;
				font-family: inherit;
				padding: 0.5em 0;
				cursor: pointer;
			}
			.wc-block-mini-cart__button:hover:not([disabled]) {
				opacity: 0.6;
			}
			.modal-open .wc-block-mini-cart__button {
				pointer-events: none;
			}
			.wc-block-mini-cart__amount {
				display: none;
			}
			.wc-block-mini-cart__quantity-badge {
				display: flex;
				align-items: center;
			}
			.wc-block-mini-cart__badge {
				display: flex;
				align-items: center;
				justify-content: center;
				background: var(--wp--preset--color--danger);
				border: 1px solid var(--wp--preset--color--danger);
				border-radius: 0.2em;
				color: var(--wp--preset--color--white);
				font-size: var(--wp--preset--font-size--small);
				height: 1.2em;
				min-width: 1em;
				margin-left: -0.65em;
				padding: 0.2em;
				transform: translateY(-50%);
				white-space: nowrap;
				z-index: 1;
			}
			.wc-block-mini-cart__badge:empty {
				display: none;
			}
			.wc-block-mini-cart__icon {
				display: block;
				height: 1.25em;
				width: 1.25em;
				transform: scale(1.35);
			}
			html[dir=rtl] .wc-block-mini-cart__icon {
				transform: scaleX(-1);
			}
			.wc-block-mini-cart__tax-label {
				margin-right: 1em;
			}
			.wc-block-mini-cart__drawer {
				font-size: 1rem;
			}
	
			@media screen and (min-width: 768px) {
				.wc-block-mini-cart__amount {
					display: initial;
					margin-right: 0.75em;
				}
			}
		';
	}
}
