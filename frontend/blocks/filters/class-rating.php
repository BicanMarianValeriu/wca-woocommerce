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
 * Gutenberg Rating Filter block.
 */
class Rating extends Dynamic {

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
