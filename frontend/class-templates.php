<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Templates
 */

namespace WCA\EXT\WOO\Frontend;

use WP_Query;
use WeCodeArt\Singleton;
use Automattic\WooCommerce\Blocks\Utils\BlockTemplateUtils;
use function WeCodeArt\Functions\get_prop;

/**
 * Templates
 */
class Templates {

	use Singleton;

	const ALL_TEMPLATES = [
		'cart',
		'checkout',
		'archive-product',
		'single-product',
		'product-search-results',
		'taxonomy-product_attribute',
		'taxonomy-product_cat',
		'taxonomy-product_tag',
	];

	/**
	 * Add the block template objects to be used.
	 *
	 * @param array  $result			Array of template objects.
	 * @param array  $query 			Optional. Arguments to retrieve templates.
	 * @param string $template_type 	wp_template or wp_template_part.
	 * @return array
	 */
	public function get_block_templates( $result, $query, $template_type ): array {
		/**
		 * Update title and description for WC templates that aren't listed in theme.json.
		 */
		$result = array_map( function( $template ) {
			if (
				! in_array( $template->slug, self::ALL_TEMPLATES, true ) &&
				BlockTemplateUtils::template_has_title( $template )
			) {
				return $template;
			}
			
			if ( $template->title === $template->slug ) {
				$template->title = BlockTemplateUtils::get_block_template_title( $template->slug );
			}
			if ( ! $template->description ) {
				$template->description = BlockTemplateUtils::get_block_template_description( $template->slug );
			}

			return $template;
		}, $result );

		return $result;
	}

	/**
	 * Get missing block templates.
	 *
	 * @param 	array  	$slugs An array of slugs to retrieve templates for.
	 * @param 	string 	$template_type wp_template or wp_template_part.
	 *
	 * @return 	array 	WP_Block_Template[] An array of block template objects.
	 */
	public function get_missing( array $slugs = Templates::ALL_TEMPLATES, string $template_type = 'wp_template' ): array {
		$templates_from_db	= $this->get_from_db( $slugs, $template_type );
		$templates_from_fs 	= $this->get_from_fs( $slugs, $templates_from_db, $template_type );

		return BlockTemplateUtils::filter_block_templates_by_feature_flag( $templates_from_fs );
	}

	/**
	 * Gets the templates saved in the database.
	 *
	 * @param 	array  	$slugs An array of slugs to retrieve templates for.
	 * @param 	string 	$template_type wp_template or wp_template_part.
	 *
	 * @return 	int[]|\WP_Post[] An array of found templates.
	 */
	public function get_from_db( array $slugs = Templates::ALL_TEMPLATES, string $template_type = 'wp_template' ): array {
		$check_query_args = [
			'post_type'      => $template_type,
			'posts_per_page' => -1,
			'no_found_rows'  => true,
			'post_name__in'  => $slugs,
			'tax_query'      => [
				[
					'taxonomy' => 'wp_theme',
					'field'    => 'name',
					'terms'    => [ get_stylesheet() ],
				]
			],
		];

		$check_query = new WP_Query( $check_query_args );

		return array_map( function( $post ) use( $template_type ) {
			return self::create_new_object( 'database', $template_type, $post->post_name );
		}, $check_query->posts );
	}

	/**
	 * Gets the templates from the filesystem, skipping those for which a template already exists
	 * in the theme directory.
	 *
	 * @param 	string[] 	$slugs 			An array of slugs to filter templates by. Templates whose slug does not match will not be returned.
	 * @param 	array		$db_templates 	Templates that have already been found, these are customised templates that are loaded from the database.
	 * @param 	string		$template_type 	wp_template or wp_template_part.
	 *
	 * @return 	array 		Templates from the plugin directory.
	 */
	public function get_from_fs( array $slugs = Templates::ALL_TEMPLATES, array $db_templates = [], $template_type = 'wp_template' ): array {
		$directory      = self::get_directory( $template_type );
		$template_files = BlockTemplateUtils::get_template_paths( $directory );
		$templates      = [];

		foreach ( $template_files as $template_file ) {
			$template_slug = BlockTemplateUtils::generate_template_slug_from_path( $template_file );

			// This template does not have a slug we're looking for. Skip it.
			if ( count( $slugs ) > 0 && ! in_array( $template_slug, $slugs, true ) ) {
				continue;
			}

			// If the theme already has a template, or the template is already in the list
			// (i.e. it came from the database) then we should not overwrite it with the one from the filesystem.
			if (
				BlockTemplateUtils::theme_has_template( $template_slug ) ||
				count( array_filter( $db_templates, function ( $template ) use ( $template_slug ) {
					$template_obj = (object) $template; //phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition.Found
					return $template_obj->slug === $template_slug;
				} ) ) > 0
			) {
				continue;
			}

			// At this point the template only exists in the plugin.
			$templates[] = self::create_new_object( $template_file, $template_type, $template_slug );
		}

		return $templates;
	}

	/**
	 * Returns the path of a template.
	 *
	 * @param 	string 	$template_slug	Block template slug e.g. single-product.
	 *
	 * @return 	string
	 */
	public static function get_template_path( string $template_slug, $template_type = 'wp_template' ): string {
		return wp_normalize_path( self::get_directory( $template_type ) . $template_slug . '.html' );
	}

	/**
	 * Gets the directory where templates of a specific template type can be found.
	 *
	 * @return 	string
	 */
	public static function get_directory( string $template_type = 'wp_template' ): string {
		if ( 'wp_template_part' === $template_type ) {
			return untrailingslashit( WCA_WOO_EXT_DIR ) . '/parts/';
		}
		
		return untrailingslashit( WCA_WOO_EXT_DIR ) . '/templates/';
	}

	/**
	 * Returns the template object.
	 *
	 * @param 	string 	$template_file
	 * @param 	string	$template_type 	wp_template or wp_template_part.
	 * @param 	string 	$template_slug 	Block template slug e.g. single-product.
	 *
	 * @return 	object
	 */
	public static function create_new_object( $template_file, $template_type, $template_slug ): object {
		$theme_name = wp_get_theme()->get( 'TextDomain' );
	
		return (object) [
			'slug'        => $template_slug,
			'id'          => $theme_name . '//' . $template_slug ,
			'path'        => $template_file,
			'type'        => $template_type,
			'theme'       => $theme_name,
			'source'      => $template_file === 'database' ? 'custom' : 'plugin',
			'title'       => BlockTemplateUtils::get_block_template_title( $template_slug ),
			'description' => BlockTemplateUtils::get_block_template_description( $template_slug ),
		];
	  }
}
