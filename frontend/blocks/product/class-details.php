<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Details
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Product Details block.
 */
class Details extends Dynamic {

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
	protected $block_name = 'product-details';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.woocommerce-tabs ul.tabs {
				padding: 0;
				margin: 0 0 -1px;
				display: flex;
			}
			.woocommerce-tabs ul.tabs li {
				display: block;
				background-color: transparent;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 0;
				border-bottom-color: transparent;
				padding: 0;
				margin: 0;
			}
			.woocommerce-tabs ul.tabs li:is(:hover,.active)::before {
				border-top-color: var(--wp--preset--color--primary);
			}
			.woocommerce-tabs ul.tabs li:is(:hover,.active) a {
				color: var(--wp--preset--color--primary);
			}
			.woocommerce-tabs ul.tabs li::before {
				content: "";
				display: block;
				height: 0;
				margin-top: -1px;
				width: 100%;
				border-top: 4px solid var(--wp--preset--color--accent);
			}
			.woocommerce-tabs ul.tabs li a {
				position: relative;
				display: block;
				font-size: 0.6rem;
				font-weight: 600;
				text-transform: uppercase;
				text-decoration: none;
				color: var(--wp--gray-900);
				padding: 0.6rem 0.8rem;
			}
			.woocommerce-tabs ul.tabs li + li {
				border-left: 0;
			}
			.woocommerce-tabs .wc-tab {
				border: 1px solid var(--wp--preset--color--accent);
				padding: 20px 10px 10px;
			}
			.woocommerce-tabs .wc-tab h2 {
				font-weight: 700;
			}

			.woocommerce-product-attributes {
				width: auto;
				min-width: 270px;
				text-align: left;
			}
			.woocommerce-product-attributes p {
				margin: 0;
			}

			.woocommerce-reviews .comment-form-rating label {
				display: block;
			}
			.woocommerce-reviews .review {
				--wc--avatar-size: 60px;
			}
			.woocommerce-reviews .review + .review {
				margin-top: 1rem;
			}
			.woocommerce-reviews .review .meta {
				margin-bottom: 0;
			}
			.woocommerce-reviews .review .comment_container::after {
				display: block;
				clear: both;
				content: "";
			}
			.woocommerce-reviews .review .comment-text {
				position: relative;
				float: right;
				width: calc(100% - var(--wc--avatar-size));
				padding-left: 10px;
				font-size: var(--wp--preset--font-size--small);
			}
			.woocommerce-reviews .review .comment-text p:only-child {
				margin: 0;
			}
			.woocommerce-reviews .review .avatar {
				max-width: var(--wc--avatar-size);
				float: left;
				border: 4px solid var(--wp--preset--color--accent);
				border-radius: 100%;
			}
			.woocommerce-reviews .review .star-rating {
				float: right;
			}

			p.stars a:before,
			p.stars a:hover ~ a:before,
			p.stars.selected a.active ~ a:before {
				background-image: var(--wc--star);
			}
			p.stars:hover a:before,
			p.stars.selected a.active:before,
			p.stars.selected a:not(.active):before {
				background-image: var(--wc--star-active);
			}
			p.stars span {
				display: block;
				line-height: 1;
			}
			p.stars a {
				position: relative;
				display: inline-block;
				width: 1em;
				height: 1em;
				font-size: 1.5rem;
				text-indent: -999em;
				text-decoration: none;
			}
			p.stars a:before {
				content: "";
				position: absolute;
				display: block;
				width: 100%;
				height: 100%;
				background-size: contain;
				background-position: center;
				background-repeat: no-repeat;
			}

			@media (max-width: 575.98px) {
				.woocommerce-reviews .review {
					padding-top: 1rem;
				}
				.woocommerce-reviews .review .comment-text {
					font-size: var(--wp--preset--font-size--normal);
				}
				.woocommerce-reviews .review .star-rating {
					position: absolute;
					right: 0;
					bottom: 100%;
					font-size: 1rem;
				}
			}

			@media (min-width: 576px) {
				.woocommerce-tabs ul.tabs li a {
					font-size: 0.8rem;
					padding: 0.7rem 1.5rem;
				}
				.woocommerce-tabs .wc-tab {
					padding: 25px;
				}
			}
		';
	}
}
