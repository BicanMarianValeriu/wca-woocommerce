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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_action;
use function add_filter;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Mini Cart block.
 */
class Widget extends Dynamic {

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
	protected $block_name = 'mini-cart';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		if ( apply_filters( 'litespeed_esi_status', false ) ) {
			add_action( 'litespeed_esi_load-woo-mini-cart', 		__CLASS__ . '::load_mini_cart' );
			add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render_block'		], 20 );
		}
	}

	/**
	 * Filter Render
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '' ): string {
		return apply_filters( 'litespeed_esi_url', 'woo-mini-cart', 'WOO_ESI_BLOCK', [
			'content' 	=> $content,
		] );
	}

	/**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public static function load_mini_cart( $params ) {
		do_action( 'litespeed_control_set_private', 'woo mini cart' );
		do_action( 'litespeed_vary_no' );

		echo get_prop( $params, [ 'content' ], '' ) . ' Hello world: ' . rand( 1, 10 );
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-cart', [
			'load'		=> function() {				
				if( wp_style_is( 'wp-block-cart' ) ) {
					return false;
				}
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
				display: inline-block;
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
				font-weight: 600;
				height: 1.2em;
				min-width: 1em;
				margin-left: -0.65em;
				padding: 0.2em;
				transform: translateY(-50%);
				white-space: nowrap;
				z-index: 1;
			}
			.wc-block-mini-cart__icon {
				display: block;
				height: 1.25em;
				width: 1.25em;
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
			.wc-block-mini-cart__drawer .components-modal__content {
				position: relative;
				padding: 0;
			}
			.wc-block-mini-cart__drawer .components-modal__header {
				position: absolute;
				top: var(--wp--custom--gutter, 1rem);
				right: var(--wp--custom--gutter, 1rem);
			}
			.wc-block-mini-cart__drawer .components-modal__header button {
				display: block;
				padding: 0;
				background: none;
				border: none;
				box-shadow: none;
				font-size: 1.5rem;
				color: inherit;
				z-index: 9999;
			}
			.wc-block-mini-cart__drawer .components-modal__header svg {
				display: block;
				width: 1em;
				height: 1em;
			}
			.wc-block-mini-cart__drawer .components-modal__header span {
				display: none;
			}
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
	
			@media screen and (min-width: 768px) {
				.wc-block-mini-cart__amount {
					display: initial;
					margin-right: 0.75em;
				}
			}
		';
	}
}
