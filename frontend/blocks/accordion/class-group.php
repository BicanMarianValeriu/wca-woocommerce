<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Accordion
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Accordion;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Accordion Group block.
 */
class Group extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'accordion-group';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function block_type_args(): array {
		return [
			'render_callback'  	=> [ $this, 'render' ],
			'style'				=> [ $this->get_asset_handle(), 'wp-block-details' ]
		];
	}

	/**
	 * Filter FAQ
	 * 
	 * @param 	string 	$attributes
	 * @param 	array 	$content
	 * 
	 * @return 	string
	 */
	public function render( array $attributes = [], string $content = '' ): string {
		wecodeart( 'debug' )->log( $attributes );

		// $condition = ( get_prop( $attributes, [ 'listStyle' ] ) === '' && get_prop( $attributes, [ 'titleWrapper' ] ) === 'div' );
		
		// if( $condition ) { // Apply only for default styleing with div titles (so we respect block settings).
		// 	$dom		= wecodeart( 'dom' )::create( $content );
		// 	$sections	= wecodeart( 'dom' )::get_elements_by_class( $dom, 'rank-math-faq-item', 'div' );
		// 	$summaries	= wecodeart( 'dom' )::get_elements_by_class( $dom, 'rank-math-question', 'div' );

		// 	if( count( $sections ) ) {
		// 		array_walk( $sections, static fn( $section ) => wecodeart( 'dom' )::change_tag( $section, 'details' ) );
		// 		array_walk( $summaries, static fn( $summary ) => wecodeart( 'dom' )::change_tag( $summary, 'summary' ) );
		// 	}

		// 	$content = wecodeart( 'dom' )::processor( $dom->saveHtml() );
		// 	$content->next_tag();
		// 	$content->add_class( 'wp-block-details' );
		// }

		return (string) $content;
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
