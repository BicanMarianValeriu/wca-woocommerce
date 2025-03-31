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
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Add to Cart Button block.
 */
class Button extends Base {

	use Singleton;

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
		
		// Scripts
		wecodeart( 'assets' )->add_script( 'wc-blocks-add-to-cart-form', [
			'load'		=> function( $blocks ) {
				if( in_array( 'woocommerce/add-to-cart-form', $blocks, true ) ) {
					return true;
				}
			},
			'inline'	=> <<<JS
				(function() {
					const { Events, Selector } = wecodeart;
					
					const handleButtonClick = (input, action) => {
						const value = parseInt(input.value, 10) || 0;
						const min = parseInt(input.getAttribute('min'), 10) || 0;
						const max = parseInt(input.getAttribute('max'), 10) || 99999;
						
						input.value = (action === '-' && value > min) ? value - 1 : (action === '+' && value < max) ? value + 1 : value;
						Events.trigger(input, 'change');
					};
					
					const allFields = Selector.find('.wc-block-components-quantity-selector:not([hasQtyInit])');
					
					allFields.forEach((item) => {
						item.hasQtyInit = true;
						const input = Selector.findOne('.wc-block-components-quantity-selector__input', item);
						const buttons = Selector.find('.wc-block-components-quantity-selector__button', item);
						buttons.forEach((el) => Events.on(el, 'click', () => handleButtonClick(input, el.value)));
					});
				})();
			JS,
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
			.wc-block-components-product-button {
				margin: auto 0 0;
			}
			:is(.wc-block-product,.cross-sells-product) .wc-block-components-product-button__button {
				display: block;
				width: 100%;
				margin: .5rem 0 0 !important;
				border-radius: var(--wp--radius);
				border: 0;
				border-top: 1px solid var(--wp--preset--color--accent);
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
			.wc-block-product:is(:hover,:focus) .wc-block-components-product-button__button {
				background-color: var(--wp--preset--color--accent);
			}
			.wc-block-components-product-button .wc-block-components-product-button__button {
				position: relative;
				padding-left: calc(4em + {$left_spacing})!important;
				overflow: hidden;
				background-color: transparent;
				border-color: var(--wp--preset--color--accent);
				color: var(--wp--preset--color--dark);
			}
			.wc-block-components-product-button .wc-block-components-product-button__button.loading::after {
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
			.wc-block-components-product-button .wc-block-components-product-button__button:before {
				content: '';
				position: absolute;
				left: 0;
				top: 0;
				bottom: 0;
				display: block;
				width: 4em;
				background-color: var(--wp--preset--color--primary);
				background-image: var(--wc--icon--cart-add);
				background-repeat: no-repeat;
				background-position: center;
				background-size: 2em;
				border-radius: inherit;
				border-top-right-radius: 0;
			}
			.wc-block-components-product-button .wc-block-components-product-button__button:after {
				content: '';
				position: absolute;
				top: 50%;
				right: 5px;
				transform: translateY(-50%);
				z-index: 20;
			}
		";
	}
}
