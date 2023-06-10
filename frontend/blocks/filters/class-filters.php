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

use function add_filter;
use function WeCodeArt\Functions\get_prop;

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
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		$is_enabled = get_prop( wecodeart_option( 'woocommerce' ), [ 'filter_details' ], true );

		if( ! $is_enabled ) return;
		
		// add_filter( 'render_block_' . $this->get_block_type(), [ $this, 'filter_render' ], 20 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function filter_render( string $content = '', array $block = [] ): string {
		$content	= new \WP_HTML_Tag_Processor( $content );
		$content->next_tag();

		return $processor->get_updated_html();
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-filter-wrapper :where(h1, h2, h3, h4, h5, h6) {
				padding-bottom: 1rem;
				margin: 0 0 1rem;
				border-bottom: 1px solid var(--wp--preset--color--accent);
			}
			.wc-block-components-price-slider__actions,
			.wp-block-woocommerce-filter-wrapper *[class*="filter__actions"] {
				margin-top: var(--wp--style--block-gap);
			}
			.wc-block-components-price-slider__actions:empty,
			.wp-block-woocommerce-filter-wrapper *[class*="filter__actions"]:empty {
				display: none;
			}
			.wp-block-woocommerce-filter-wrapper :where(
				.wc-block-components-filter-reset-button,
				.wc-block-active-filters__clear-all
			) {
				font-size: .65rem;
				font-weight: 500;
				text-transform: uppercase;
				background-color: var(--wp--preset--color--accent);
				border: var(--wc--input--border);
				border-radius: var(--wc--input--border-radius);
				color: var(--wp--gray-600);
				appearance: none;
				cursor: pointer;
			}
			.wp-block-woocommerce-filter-wrapper :where(
				.wc-block-components-filter-reset-button,
				.wc-block-active-filters__clear-all
			):is(:hover,:focus) {
				border-color: var(--wp--preset--color--danger);
				color: var(--wp--preset--color--danger);
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