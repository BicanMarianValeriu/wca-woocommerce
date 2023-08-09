<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Reviews
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Reviews block.
 */
class Reviews extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'all-reviews';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-reviews', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wc-blocks-style-reviews' ) || wp_style_is( 'wc-blocks-style-all-reviews' ) ) {
					return false;
				}

				if( count( array_intersect( $blocks, [ 'woocommerce/reviews-by-product', 'woocommerce/reviews-by-category' ] ) ) ) {
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
		$inline = '
			.wc-block-review-list {
				--wc--avatar--size: 60px;
				--wc--avatar--radius: .25rem;
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.wc-block-review-list-item__item + .wc-block-review-list-item__item {
				margin-top: 1rem;
			}
			.wc-block-review-list-item__info {
				display: flex;
				flex-wrap: nowrap;
			}
			.wc-block-review-list-item__image {
				position: relative;
			}
			.wc-block-review-list-item__image img {
				width: var(--wc--avatar--size);
				height: var(--wc--avatar--size);
				object-fit: cover;
				border-radius: var(--wc--avatar--radius);
			}
			.wc-block-review-list-item__verified {
				position: absolute;
				top: -0.5em;
				right: -0.5em;
				width: 1rem;
				height: 1rem;
				background-image: var(--wc--verified);
				background-size: contain;
				background-position: center;
				background-repeat: no-repeat;
				overflow: hidden;
				text-indent: -9999px;
			}
			.wc-block-review-list-item__meta {
				flex: 1 1 0%;
			}
			.wc-block-review-list-item__rating .wc-block-components-review-list-item__rating__stars {
				float: right;
				font-size: 1rem;
				margin: 0;
			}
			.wc-block-review-list-item__product {
				font-size: 1.25rem;
				font-weight: bold;
				line-height: 1;
			}
			.wc-block-review-list-item__product a {
				text-decoration: none!important;
			}
			.wc-block-review-list-item__author,
			.wc-block-review-list-item__published-date {
				display: inline-block;
				margin-top: 0.5rem;
			}
			.wc-block-review-list-item__author + .wc-block-review-list-item__published-date::before {
				content: "\2014";
				display: inline-block;
				margin: 0 8px;
			}
			.wc-block-review-list-item__published-date {
				font-size: small;
				font-style: italic;
			}
			.wc-block-review-list-item__text {
				margin-top: 0.5rem;
			}
			.wc-block-review-list-item__text p:last-child {
				margin-bottom: 0;
			}
		';

		$inline .= Frontend::get_loading_css( trim( '
			.wc-block-review-list .is-loading :where(
				.wc-block-review-list-item__text,
				.wc-block-review-list-item__image,
				.wc-block-review-list-item__product,
				.wc-block-review-list-item__author,
				.wc-block-review-list-item__published-date
			)' ), 'margin:0;'
		);
			
		$inline .= '
			.wc-block-review-list .is-loading .wc-block-review-list-item__image {
				width: var(--wc--avatar--size);
				height: var(--wc--avatar--size);
			}
			.wc-block-review-list .is-loading .wc-block-review-list-item__product {
				width: 50%;
			}
			.wc-block-review-list .is-loading .wc-block-review-list-item__author,
			.wc-block-review-list .is-loading .wc-block-review-list-item__published-date {
				display: inline-block;
				width: auto;
				min-width: 80px;
				min-height: 1em;
				margin-top: 0.5rem;
			}
			.wc-block-review-list .is-loading .wc-block-review-list-item__author {
				margin-right: 1rem;
			}
			.wc-block-review-list .is-loading .wc-block-review-list-item__published-date {
				font-size: 1rem;
			}
			.wc-block-review-list .is-loading .wc-block-review-list-item__text {
				margin-top: 1rem;
				min-height: 2em;
			}
			.wc-block-review-list .wc-block-components-review-list-item__item--has-image .wc-block-review-list-item__meta {
				padding-left: 1rem;
			}
			.wc-block-review-list + .wp-block-button {
				margin-top: 1rem;
			}
			
			@media (min-width: 576px) {
				.wc-block-review-list {
					--wc--avatar--size: 80px;
				}
			}
		';

		return $inline;
	}
}