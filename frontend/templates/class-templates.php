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
		'page-cart',
		'page-checkout',
		'order-confirmation',
		'single-product',
		'archive-product',
		'product-search-results',
		'taxonomy-product_attribute',
		'taxonomy-product_cat',
		'taxonomy-product_tag',
	];

	/**
	 * Add the Block template in the template query results needed by FSE
	 * Triggered by get_block_templates action
	 *
	 * @param 	array  	$query_result The list of templates to render in the query.
	 * @param 	array  	$query The current query parameters.
	 * @param 	string 	$template_type The post_type for the template. Normally wp_template or wp_template_part.
	 *
	 * @return 	WP_Block_Template[] Array of the matched Block Templates to render.
	 */
	public function get_block_templates( $query_result, $query, $template_type ) {
		// We don't want to run this if we are looking for template-parts. Like the header.
		if ( 'wp_template' !== $template_type ) {
			return $query_result;
		}

		$post_id = isset( $_REQUEST['postId'] ) ? wc_clean( wp_unslash( $_REQUEST['postId'] ) ) : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$slugs   = $query['slug__in'] ?? [];

		// Filter the slugs to only include those in ALL_TEMPLATES
		$matching_templates = array_intersect( self::ALL_TEMPLATES, $slugs );

		// Loop through all matching templates
		foreach ( $matching_templates as $template_slug ) {
			$query_result[] = $this->get_template( $template_type, $template_slug );
		}
		
		// Handle fallback case if no slugs are matched but template is needed
		if ( empty( $matching_templates ) ) {
			foreach ( self::ALL_TEMPLATES as $fallback_template ) {
				if ( ( ! $post_id && ! count( $slugs ) ) || ! count( $slugs ) && $this->is_woo_template( $post_id, $fallback_template ) ) {
					$query_result[] = $this->get_template( $template_type, $fallback_template ); 
				}
			}
		}
		
		return $query_result;
	}

	/**
	 * Get the block template if requested.
	 * Triggered by get_block_file_template action
	 *
	 * @param 	WP_Block_Template|null $template The current Block Template loaded, if any.
	 * @param 	string                 $id The template id normally in the format theme-slug//template-slug.
	 * @param 	string                 $template_type The post_type for the template. Normally wp_template or wp_template_part.
	 *
	 * @return 	WP_Block_Template|null The taxonomy-product_brand template.
	 */
	public function get_block_template( $template, $id, $template_type ) {
		$template_name_parts = explode( '//', $id );

		if ( count( $template_name_parts ) < 2 ) {
			return $template;
		}

		list( $template_id, $template_slug ) = $template_name_parts;

		// If we are not dealing with a WooCommerce template let's return early and let it continue through the process.
		if ( BlockTemplateUtils::PLUGIN_SLUG !== $template_id ) {
			return $template;
		}

		// If we don't have a template let Gutenberg do its thing.
		if ( ! in_array( $template_slug, self::ALL_TEMPLATES, true ) ) {
			return $template;
		}

		$template_built = $this->get_template( $template_type, $template_slug );
		
		if ( null !== $template_built ) {
			$template_built->path = $this->get_template_path( $template_slug );
			return $template_built;
		}

		// Hand back over to Gutenberg if we can't find a template.
		return $template;
	}

	/**
     * WooCommerce Locate Template
     *
     * @since	1.0.0
     * @version	1.0.0
     *
     * @return	array
     */
    public function locate_template( $template, $template_name ) {
		// Check if the template is loaded from the plugin
		$is_loaded_from_plugin = ( strpos( wp_normalize_path( $template ), 'woocommerce/templates' ) !== false );
		
		if( $is_loaded_from_plugin ) {
			$template_file = untrailingslashit( WCA_WOO_EXT_DIR ) . '/woocommerce/' . $template_name;
	
			// Check if the template file exists in the custom directory
			if ( file_exists( $template_file ) ) {
				$template = $template_file;
			}
		}

		return $template;
    }

	/**
	 * Load Comments template.
	 *
	 * @since	1.0.0
     * @version	1.0.0
	 *
	 * @param 	string 	$template template to load.
	 *
	 * @return 	string
	 */
	public function comments_template( $template ) {
		// Check if the template is loaded from the plugin
		$is_loaded_from_plugin = ( strpos( wp_normalize_path( $template ), 'woocommerce/templates' ) !== false );

		if ( get_post_type() === 'product' && $is_loaded_from_plugin ) {
			$template = WCA_WOO_EXT_DIR . 'woocommerce/single-product-reviews.php';
		}

		return $template;
	}

	/**
	 * Get the 	Template from DB in case a user customized it in FSE
	 *
	 * @return 	WP_Post|null The taxonomy-product_brand
	 */
	private function get_template_db( $template_name ) {
		$posts = get_posts( [
			'name'           => $template_name,
			'post_type'      => 'wp_template',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		] );

		if ( count( $posts ) ) {
			return $posts[0];
		}

		return null;
	}

	/**
	 * Get the block template. First it attempts to load the last version from DB
	 * Otherwise it loads the file based template.
	 *
	 * @param 	string $template_type The post_type for the template. Normally wp_template or wp_template_part.
	 *
	 * @return 	WP_Block_Template The template.
	 */
	private function get_template( $template_type, $template_name ) {
		$template_db = $this->get_template_db( $template_name );

		if ( $template_db ) {
			return BlockTemplateUtils::build_template_result_from_post( $template_db );
		}
		
		$template_path = self::get_template_path( $template_name, $template_type );

		$template_file = BlockTemplateUtils::create_new_block_template_object( $template_path, $template_type, $template_name, false );

		$result = BlockTemplateUtils::build_template_result_from_file( $template_file, $template_type );

		return $result;
	}

	/**
	 * Function to check if a template name is woocommerce
	 *
	 * @param  	string 	$id The string to check if contains the template name.
	 *
	 * @return 	bool 	True if the template is woocommerce
	 */
	private function is_woo_template( $id, $template ): bool {
		return strpos( $id, 'woocommerce//' . $template ) !== false;
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
}
