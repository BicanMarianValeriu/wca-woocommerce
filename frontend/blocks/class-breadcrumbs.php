<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Breadcrumbs
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Breadcrumbs block.
 */
class Breadcrumbs extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'breadcrumbs';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'woocommerce_breadcrumb_defaults', [ $this, 'filter_defaults' 	], 20, 1 );
	}

	/**
	 * Breadcrumbs
	 *
	 * @param	array 	$args
	 *
	 * @return 	array
	 */
	public function filter_defaults( $args ): array {
		$args['delimiter'] = ' » '; // To do: Use Yoast/RankMath settings.

		return $args;
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.woocommerce.wc-block-breadcrumbs {
				font-size: inherit;
			}
		';
	}
}
