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
use WCA\EXT\WOO\Frontend\Blocks\Base;
use WCA\EXT\WOO\Frontend;

/**
 * Gutenberg Attribute Filter block.
 */
class Attribute extends Base {

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