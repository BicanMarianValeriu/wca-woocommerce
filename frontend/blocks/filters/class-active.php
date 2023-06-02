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

namespace WCA\EXT\WOO\Frontend\Blocks\Filters;

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WCA\EXT\WOO\Frontend;

/**
 * Gutenberg Attribute Filter block.
 */
class Active extends Dynamic {

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
				margin-right: .5rem;
			}
			.wc-block-active-filters__list-item {
				display: block;
				overflow: hidden;
				margin-bottom: .5rem;
			}
			.wc-block-active-filters__list-item-type {
				display: block;
				margin-right: .5rem;
			}
			.wc-block-active-filters__list-item-remove {
				margin-right: 1rem;
				background-color: var(--wp--preset--color--accent);
				color: var(--wp--preset--color--danger);
				border: var(--wc--input--border);
				border-radius: var(--wc--input--border-radius);
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