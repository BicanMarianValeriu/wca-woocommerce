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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_filter;

/**
 * Gutenberg Product Gallery block.
 */
class Gallery extends Dynamic {

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
	protected $block_name = 'product-image-gallery';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'woocommerce_product_thumbnails_columns', 	[ $this, 'thumbnails_columns' 	] );
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render_block'			], 20 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '' ): string {
		return str_replace(
			' data-columns',
			sprintf( ' style="--columns:%s;" data-columns', apply_filters( 'woocommerce_product_thumbnails_columns', 3 ) ),
			$content
		);
	}

    /**
	 * Gallery Columns
	 *
	 * @since	1.0
	 * @version	1.0
	 *
	 * @return 	array
	 */
	public function thumbnails_columns( $columns ) {
		$columns = 5;

		return $columns;
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-product-image-gallery.position-sticky {
				top: 90px;
			}
			.woocommerce-product-gallery {
				--columns: 3;
				position: relative;
			}
			.woocommerce-product-gallery__wrapper {
				max-width: initial;
				height: 100%;
				margin: 0;
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
				max-width: 100%;
			}
			.woocommerce-product-gallery__image--placeholder a,
			.woocommerce-product-gallery__image:only-child a,
			.woocommerce-product-gallery .flex-viewport a {
				display: block;
			}
			.woocommerce-product-gallery .flex-viewport {
				max-height: 500px;
			}
			.woocommerce-product-gallery .flex-control-thumbs {
				list-style: none;
				padding: 0;
				display: grid;
				grid-gap: 10px;
				grid-template-columns: repeat(3, 1fr);
				margin-top: 1rem;
				margin-bottom: 0;
			}
			.woocommerce-product-gallery .flex-control-thumbs li img {
				width: 100%;
				opacity: 0.5;
				padding: 3px;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0.25rem;
				cursor: pointer;
			}
			.woocommerce-product-gallery .flex-control-thumbs li img:is(.flex-active,:hover) {
				opacity: 1;
				border-color: var(--wp--preset--color--primary);
			}

			@media (min-width: 576px) {
				.woocommerce-product-gallery .flex-control-thumbs {
					grid-template-columns: repeat(var(--columns), 1fr);
				}
			}
		';
	}
}
