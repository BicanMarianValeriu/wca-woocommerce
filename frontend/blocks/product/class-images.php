<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Gallery
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function apply_filters;
use function str_replace;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Gallery block.
 */
class Images extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-image-gallery';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render_block'	], 20 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '' ): string {
		return str_replace( ' data-columns', sprintf( ' style="--columns:%s;" data-columns', 5 ), $content );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-product-image-gallery {
				position: relative;
			}
			.wp-block-woocommerce-product-image-gallery.position-sticky {
				top: 90px;
			}
			.woocommerce-product-gallery {
				--columns: 3;
				position: relative;
				display: grid;
				gap: 1rem;
				opacity: 0;
				transition: opacity .5s ease-in-out;
			}
			html:not(.js) .woocommerce-product-gallery::after {
				content: "";
				display: block;
				height: 0;
				padding-bottom: 20%;
			}
			.woocommerce-product-gallery__trigger {
				position: absolute;
				top: 0.5rem;
				right: 0.8rem;
				z-index: 1;
				background: rgba(255, 255, 255, 0.3);
				border-radius: 30px;
				height: 20px;
				width: 20px;
				text-indent: -9999px;
				color: black;
				border: 2px solid var(--wp--gray-800);
			}
			.woocommerce-product-gallery__trigger:hover {
				border-color: var(--wp--preset--color--primary);
			}
			.woocommerce-product-gallery__trigger:hover::before {
				background: var(--wp--preset--color--primary);
				color: white;
			}
			.woocommerce-product-gallery__trigger::before {
				content: "";
				position: absolute;
				transition: inherit;
				height: 2px;
				width: 6px;
				background: var(--wp--gray-800);
				top: 90%;
				left: 90%;
				transform: rotate(45deg);
				border-radius: 100%;
				padding: 2px;
			}
			.woocommerce-product-gallery .flex-viewport {
				max-height: 500px;
			}
			.woocommerce-product-gallery__image--placeholder,
			.woocommerce-product-gallery__image:only-child,
			.woocommerce-product-gallery .flex-viewport {
				border: 3px solid white;
				border-radius: 0.25rem;
				outline: 1px solid var(--wp--preset--color--accent);
			}
			.woocommerce-product-gallery__image--placeholder img,
			.woocommerce-product-gallery__image:only-child img,
			.woocommerce-product-gallery .flex-viewport img {
				width: 100%;
			    aspect-ratio: 1;
    			object-fit: cover;
			}
			.woocommerce-product-gallery__image--placeholder a,
			.woocommerce-product-gallery__image:only-child a,
			.woocommerce-product-gallery .flex-viewport a {
				display: block;
			}
			html:not(.js) .woocommerce-product-gallery ol {
				display: none;
			}
			html:not(.js) .woocommerce-product-gallery__image:first-child img[src^="data:image"],
			html:not(.js) .woocommerce-product-gallery__image:not(:first-child) img,
			.woocommerce-product-gallery__image a + img {
				position: absolute;
				top: 0;
			}
			.woocommerce-product-gallery ol {
				list-style: none;
				padding: 0;
				display: grid;
				grid-gap: 10px;
				grid-template-columns: repeat(var(--columns, 5), 1fr);
				margin: 0;
			}
			.woocommerce-product-gallery ol li img {
				display: block;
				aspect-ratio: 1/1;
				object-fit: cover;
				width: 100%;
				opacity: 0.5;
				padding: 3px;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0.25rem;
				cursor: pointer;
			}
			.woocommerce-product-gallery ol li img:is(.flex-active,:hover) {
				opacity: 1;
				border-color: var(--wp--preset--color--primary);
			}

			.wc-block-editor-product-gallery {
				display: flex;
				flex-direction: column;
				gap: 10px;
			}

			.wc-block-editor-product-gallery__other-images {
				display: grid;
				grid-template-columns: repeat(var(--columns, 5), 1fr);
				gap: 10px;
			}
		';
	}
}
