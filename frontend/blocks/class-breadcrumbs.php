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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_action;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Breadcrumbs block.
 */
class Breadcrumbs extends Dynamic {

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
	protected $block_name = 'breadcrumbs';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'woocommerce_breadcrumb_defaults', 			[ $this, 'filter_defaults' 	], 20, 1 );
		add_filter( 'render_block_' . $this->get_block_type(), 	[ $this, 'filter_render' 	], 20, 1 );
	}

	/**
	 * Dynamically renders the block.
	 *
	 * @param 	array 	$block 		The parsed block.
	 * @param 	string 	$content 	The block markup.
	 *
	 * @return 	string 	The block markup.
	 */
	public function filter_render( string $content = '', array $attributes = [] ): string {
		$processor = new \WP_HTML_Tag_Processor( $content );
		$processor->next_tag();

		if( empty( $processor->get_attribute( 'style' ) ) ) {
			$processor->remove_attribute( 'style' );
		}

		$content = $processor->get_updated_html();
	
		return $content;
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
		return '';
	}
}
