<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Categories
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Product Categories block.
 */
class Categories extends Dynamic {

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
	protected $block_name = 'product-categories';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-product-categories-list {
				margin: 0;
				padding-left: 0;
				list-style: none;
			}
			.wc-block-product-categories-list--has-images .wc-block-product-categories-list-item {
				margin-bottom: 1rem;
			}
			.wc-block-product-categories-list--has-images .wc-block-product-categories-list-item::after {
				display: block;
				clear: both;
				content: "";
			}
			.wc-block-product-categories-list--has-images .wc-block-product-categories-list-item a {
				text-decoration: none;
				text-transform: uppercase;
				font-weight: 700;
				font-size: 1.25rem;
			}
			.wc-block-product-categories-list img {
				position: relative;
				top: -0.1em;
				display: block;
				float: left;
				width: 30px;
				margin-right: 1rem;
			}
		';
	}
}
