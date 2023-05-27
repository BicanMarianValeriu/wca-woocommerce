<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Sorting
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_filter;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Sorting block.
 */
class Sorting extends Dynamic {

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
	protected $block_name = 'catalog-sorting';

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
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

		// Clean empty style
		if( empty( $processor->get_attribute( 'style' ) ) ) {
			$processor->remove_attribute( 'style' );
		}
	
		// Clean empty class
		if( $class = $processor->get_attribute( 'class' ) ) {
			$processor->set_attribute( 'class', rtrim( $class ) );
		}

		// Add form-select class
		$processor->next_tag( [ 'tag_name' => 'select' ] );
		$processor->add_class( 'form-select form-select-sm' );

		// Load a fake select for styles
		$fake_select = wecodeart_input( 'select', [], false );
	
		return $processor->get_updated_html();
	}
}
