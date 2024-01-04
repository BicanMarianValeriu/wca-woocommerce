<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Viewed
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function add_action;
use function WeCodeArt\Functions\get_prop;

use \LiteSpeed\Tag;
use \LiteSpeed\ESI;
use \LiteSpeed\Conf;
use \LiteSpeed\Base as LSBase;

/**
 * Gutenberg Viewed Products block.
 */
class Viewed extends Base {

	use Singleton;

	const COOKIE 	= 'wca_recently_viewed';
	const ESI_TAG	= 'wca_recently_viewed';

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'viewed-products';

	/**
	 * Block data.
	 *
	 * @var array
	 */
	protected $parsed_block = null;

	/**
	 * Block init.
	 *
	 * @return 	array
	 */
	public function init() {
		add_action( 'template_redirect',		[ $this, 'track_viewed' ], 20, 1 );
		add_filter( 'pre_render_block',			[ $this, 'update_query'	], 20, 2 );
		add_filter( 'render_block_core/query',	[ $this, 'render_block'	], 20, 2 );
	}

	/**
	 * If there are no related products, return an empty string.
	 *
	 * @param 	string $content The block content.
	 * @param 	array  $block The block.
	 *
	 * @return 	string The block content.
	 */
	public function render_block( string $content = '', array $block = [] ): string {
		if ( ! self::is_viewed_products_block( $block ) ) {
			return $content;
		}

		if ( ! is_user_logged_in() || ! $this->get_products_ids() ) {
			return '';
		}

		return $content;
	}

	/**
	 * Update the query for the product query block.
	 *
	 * @param	string|null $pre_render   The pre-rendered content. Default null.
	 * @param 	array       $parsed_block The block being rendered.
	 */
	public function update_query( $pre_render, $parsed_block ) {
		if ( 'core/query' !== $parsed_block['blockName'] ) {
			return;
		}

		$this->parsed_block = $parsed_block;

		if ( self::is_viewed_products_block( $parsed_block ) ) {
			// Set this so that our product filters can detect if it's a PHP template.
			add_filter( 'query_loop_block_query_vars', [ $this, 'build_query' ], 20, 1 );
		}
	}

	/**
	 * Return a custom query based on attributes, filters and global WP_Query.
	 *
	 * @param 	WP_Query	$query The WordPress Query.
	 *
	 * @return 	array
	 */
	public function build_query( $query ) {
		$block = $this->parsed_block;

		if ( ! self::is_viewed_products_block( $block ) ) {
			return $query;
		}

		$products = $this->get_products_ids();

		if ( ! $products ) {
			return [];
		}

		$products = array_slice( $products, 0, get_prop( $block, [ 'attrs', 'query', 'perPage' ], 4 ) );

		return [
			'post_type'   	=> 'product',
			'post_status' 	=> 'publish',
			'post__in'    	=> $products,
			'orderby'		=> 'post__in',
		];
	}

	/**
	 * Determines whether the block is a recent products block.
	 *
	 * @param 	array 	$block The block.
	 *
	 * @return 	bool 	Whether the block is a recent products block.
	 */
	public static function is_viewed_products_block( array $block = [] ): bool {
		if ( get_prop( $block, [ 'attrs', 'namespace' ], '' ) === 'woocommerce/product-query/viewed-products' ) {
			return true;
		}

		return false;
	}

	/**
	 * Get recent products ids.
	 *
	 * @return	array	Products ids.
	 */
	private function get_products_ids(): array {
		$products = get_prop( $_COOKIE, [ self::COOKIE ], '' );

		if( empty( $products ) ) {
			return [];
		}

		$products = wp_parse_id_list( (array) explode( '|', wp_unslash( $products ) ) );
		$products = array_diff( $products, [ get_the_ID() ] );
		
		return $products;
	}

	/**
	 * Track viewed products ids.
	 *
	 * @return	void
	 */
	public function track_viewed() {
		if ( ! is_singular( 'product' ) ) {
			return;
		}
	
		$viewed_ids = $this->get_products_ids();

		// Remove the current product ID if it exists in the viewed IDs array.
		$viewed_ids = array_diff( $viewed_ids, [ get_the_ID() ] );

		// Prepend the current product ID to the viewed IDs array.
		array_unshift( $viewed_ids, get_the_ID() );

		// Limit the viewed IDs array to a maximum of 10 items.
		$viewed_ids = array_slice( $viewed_ids, 0, 10 );

		// Store the viewed IDs in a session cookie.
		wc_setcookie( self::COOKIE, implode( '|', $viewed_ids ) );
	}
}