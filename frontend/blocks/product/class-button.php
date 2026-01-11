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
			.wc-block-components-product-button a[hidden] {
				display: none;
			}
			:is(.wc-block-product,.cross-sells-product) .wc-block-components-product-button__button {
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
				display: flex;
				align-items: center;
				justify-content: center;
				padding-left: calc(4em + {$left_spacing})!important;
				overflow: hidden;
				background-color: transparent;
				border-color: var(--wp--preset--color--accent);
				color: var(--wp--preset--color--dark);
			}
			.wc-block-components-product-button .wc-block-components-product-button__button--placeholder > * {
				visibility: hidden;
			}
			.wc-block-components-product-button .wc-block-components-product-button__button--placeholder:after {
				animation: animation__loading 1.5s ease-in-out infinite;
				background-image: linear-gradient(90deg, var(--wp--preset--color--accent), hsla(0, 0%, 96%, 0.302), var(--wp--preset--color--accent));
				background-repeat: no-repeat;
				content: ' ';
				display: block;
				height: 100%;
				position: absolute;
				left: 0;
				right: 0;
				top: 0;
				transform: translateX(-100%);
			}
			.wc-block-components-product-button .wc-block-components-product-button__button span.wc-block-slide-out {
				animation: slideOut 0.1s linear 1 normal forwards;
			}
			.wc-block-components-product-button .wc-block-components-product-button__button span.wc-block-slide-in {
				animation: slideIn 0.1s linear 1 normal;
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
			@media screen and (prefers-reduced-motion: reduce) {
			  	.wc-block-components-product-button .wc-block-components-product-button__button--placeholder {
					animation: none;
				}
			} 	
		";
	}
}
