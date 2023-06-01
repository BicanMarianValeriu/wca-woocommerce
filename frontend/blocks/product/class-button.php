<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Button
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WCA\EXT\WOO\Frontend;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Add to Cart Button block.
 */
class Button extends Dynamic {

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
	protected $block_name = 'product-button';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-add-to-cart', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wp-block-add-to-cart' ) || wp_style_is( 'wp-block-product-button' ) ) {
					return false;
				}
				
				// Add to cart form should inherit the styles
				if( in_array( 'woocommerce/add-to-cart-form', $blocks, true ) ) {
					return true;
				}

				// Products blocks should inherit the styles
				if( Frontend::has_products_block( $blocks ) ) {
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
		$left_spacing = wecodeart_json( [ 'styles', 'elements', 'button', 'spacing', 'padding', 'left' ], '1.25rem' );

		return "
			:is(
				.wp-element-button.add_to_cart_button,
				.wp-element-button.single_add_to_cart_button,
				.wc-block-components-product-button__button,
				.wc-block-components-product-add-to-cart-button
			) {
				position: relative;
				padding-left: calc(4em + {$left_spacing});
				overflow: hidden;
				border: 0;
			}
			:is(
				.wp-element-button.add_to_cart_button,
				.wp-element-button.single_add_to_cart_button,
				.wc-block-components-product-button__button,
				.wc-block-components-product-add-to-cart-button
			).added::after {
				content: '✔';
				right: 1.125em;
			}
			:is(
				.wp-element-button.add_to_cart_button,
				.wp-element-button.single_add_to_cart_button,
				.wc-block-components-product-button__button,
				.wc-block-components-product-add-to-cart-button
			).loading::after {
				content: '';
				position: absolute;
				display: block;
				right: 1em;
				top: 50%;
				transform: translateY(-50%);
				width: 1em;
				height: 1em;
				border-radius: 50%;
				background: transparent;
				border: 2px solid white;
			}
			:is(
				.wp-element-button.add_to_cart_button,
				.wp-element-button.single_add_to_cart_button,
				.wc-block-components-product-button__button,
				.wc-block-components-product-add-to-cart-button
			):before {
				content: '';
				position: absolute;
				left: 0;
				top: 0;
				bottom: 0;
				display: block;
				width: 4em;
				background-color: var(--wp--preset--color--danger);
				background-image: var(--wc--cart);
				background-repeat: no-repeat;
				background-position: 40% center;
				background-size: 2em;
				border-radius: inherit;
				border-top-right-radius: 0;
			}
			:is(
				.wp-element-button.add_to_cart_button,
				.wp-element-button.single_add_to_cart_button,
				.wc-block-components-product-button__button,
				.wc-block-components-product-add-to-cart-button
			):after {
				content: '';
				position: absolute;
				top: 50%;
				right: 5px;
				transform: translateY(-50%);
				z-index: 20;
			}
			:is(
				.wc-block-components-product-button,
				.wc-block-components-product-add-to-cart,
				.wc-block-grid__product-add-to-cart
			) {
				margin-top: auto;
				border-radius: inherit;
			}
			:is(
				ul.wp-block-query__products li.wp-block-post,
				.wc-block-components-product-button,
				.wc-block-components-product-add-to-cart,
				.wc-block-grid__product-add-to-cart
			) .wp-element-button {
				display: block;
				width: 100%;
				border: none;
				margin: 0 !important;
				border-radius: inherit;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
				background-color: var(--wp--preset--color--primary);
				color: var(--wp--preset--color--white);
			}
		";
	}
}
