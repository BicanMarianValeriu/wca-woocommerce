<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Filters
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Filters block.
 */
class Filters extends Dynamic {

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
	protected $block_name = 'filter-wrapper';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-blocks-filter-wrapper :where(h1, h2, h3, h4, h5, h6) {
				padding-bottom: 1rem;
				margin-bottom: 1rem;
				border-bottom: 1px solid var(--wp--preset--color--accent);
			}
			.wc-blocks-filter-wrapper *[class*="filter__actions"] {
				margin-top: var(--wp--style--block-gap);
			}
			.wc-blocks-filter-wrapper *[class*="filter__actions"]:empty {
				display: none;
			}
			.wc-block-components-filter-reset-button,
			.wc-block-active-filters__clear-all {
				font-size: .65rem;
				font-weight: 500;
				text-transform: uppercase;
				background-color: var(--wp--preset--color--accent);
				border: var(--wc--input--border);
				border-radius: var(--wc--input--radius);
				color: var(--wp--gray-600);
				appearance: none;
				cursor: pointer;
			}
			:where(.wc-block-components-filter-reset-button,.wc-block-active-filters__clear-all):is(:hover,:focus) {
				border-color: var(--wp--preset--color--primary);
				color: var(--wp--preset--color--primary);
			}
			.wc-block-product-categories-list-item-count,
			.wc-filter-element-label-list-count {
				float: right;
				margin-left: 0.5rem;
			}
			.wc-block-product-categories-list-item-count::before,
			.wc-filter-element-label-list-count::before {
				content: "(";
			}
			.wc-block-product-categories-list-item-count::after,
			.wc-filter-element-label-list-count::after {
				content: ")";
			}
		';
	}
}

namespace WCA\EXT\WOO\Frontend\Blocks\Filters;

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WCA\EXT\WOO\Frontend;

/**
 * Gutenberg Price Filter block.
 */
class PriceFilter extends Dynamic {

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
	protected $block_name = 'price-filter';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		$inline .= Frontend::get_loading_css( '.wc-block-price-filter__range-input-wrapper.is-loading', 'min-height: .5em;' );
		$inline .= Frontend::get_loading_css( '.wc-block-price-filter__controls .input-loading', 'flex: 1 0 0%;min-height: 2em;' );
		
		return $inline;
	}
}

/**
 * Gutenberg Rating Filter block.
 */
class RatingFilter extends Dynamic {

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
	protected $block_name = 'rating-filter';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '
			.wc-block-rating-filter .wc-block-components-product-rating {
				display: flex;
				align-items: center;
			}
			.wc-block-rating-filter .wc-block-components-product-rating__stars {
				margin: 0;
			}
			.wc-block-rating-filter .wc-block-components-product-rating-count {
				margin-left: 0.5rem;
			}
		';

		$inline .= Frontend::get_loading_css( '.wc-block-rating-filter .is-loading li', 'min-height: 1.25em;' );

		return $inline;
	}
}

/**
 * Gutenberg Stock Filter block.
 */
class StockFilter extends Dynamic {

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
	protected $block_name = 'stock-filter';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return Frontend::get_loading_css( '.wc-block-stock-filter.is-loading' );
	}
}

/**
 * Gutenberg Attribute Filter block.
 */
class AttributeFilter extends Dynamic {

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
	protected $block_name = 'attribute-filter';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		
		$inline .= '
			.wc-block-attribute-filter.style-dropdown .is-loading {
				min-height: 50px;
			}
		';

		$inline .= Frontend::get_loading_css( '.wc-block-attribute-filter .is-loading' );

		return $inline;
	}
}

/**
 * Gutenberg Attribute Filter block.
 */
class ActiveFilters extends Dynamic {

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
	protected $block_name = 'active-filters';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '';
		
		$inline .= '
			.wp-block-woocommerce-active-filters {
				padding: 1rem;
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: .375rem;
			}
			.wp-block-woocommerce-active-filters:empty {
				display: none;
			}
			.wc-block-active-filters {
				margin: 0;
			}
		';

		$inline .= Frontend::get_loading_css(
			'.wc-block-active-filters--loading :where(.show-loading-state-list,.show-loading-state-chips)'
		);
		
		$inline .= '
			.wc-block-active-filters--loading .show-loading-state-chips {
				display: inline-block;
				margin-right: 1rem;
			}
			.wc-block-active-filters--loading .show-loading-state-chips:first-of-type {
				margin-top: 0;
			}
			.wc-block-active-filters--loading .show-loading-state-chips:not(:first-of-type) {
				max-width: 150px;
			}
			.wc-block-active-filters__list--chips {
				display: flex;
				flex-wrap: wrap;
			}
			.wc-block-active-filters__list--chips .wc-block-active-filters__list-item-type {
				display: none;
			}
			.wc-block-active-filters__list,
			.wc-block-active-filters__list ul {
				list-style: none;
				padding-left: 0;
				margin: 0;
			}
			.wc-block-active-filters__list ul li {
				display: inline-block;
			}
			.wc-block-active-filters__list-item {
				display: block;
				overflow: hidden;
				margin-bottom: 0.5rem;
			}
			.wc-block-active-filters__list-item-type {
				display: block;
				margin-right: 0.5rem;
			}
			.wc-block-active-filters__list-item-remove {
				margin-right: 1rem;
				background-color: var(--wp--preset--color--accent);
				color: var(--wp--preset--color--danger);
				border: var(--wp--input--border);
				border-radius: var(--wp--input--border-radius);
				appearance: none;
				cursor: pointer;
			}
			.wc-block-active-filters__list-item-remove:is(:hover,:focus) {
				background-color: var(--wp--preset--color--danger);
				color: white;
			}
			.wc-block-active-filters__clear-all {
				float: right;
				margin-top: -30px;
			}
		';

		return $inline;
	}
}