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

	/**
     * Template slugs we want to override
     */
    const TEMPLATES = [
        'page-cart' => [
            'title'       => 'Cart',
            'description' => 'Displays the shopping cart.',
        ],
        'page-checkout' => [
            'title'       => 'Checkout',
            'description' => 'Displays the checkout form.',
        ],
        'order-confirmation' => [
            'title'       => 'Order Confirmation',
            'description' => 'Displays order confirmation after purchase.',
        ],
        'single-product' => [
            'title'       => 'Single Product',
            'description' => 'Displays a single product.',
        ],
        'archive-product' => [
            'title'       => 'Product Catalog',
            'description' => 'Displays your products.',
        ],
        'product-search-results' => [
            'title'       => 'Product Search Results',
            'description' => 'Displays search results for your store.',
        ],
        'taxonomy-product_cat' => [
            'title'       => 'Product Category',
            'description' => 'Displays products by category.',
        ],
        'taxonomy-product_tag' => [
            'title'       => 'Product Tag',
            'description' => 'Displays products by tag.',
        ],
    ];

	/**
     * Register our custom templates, replacing WooCommerce's
     */
    public function register_templates() {
        // Check if function exists (WordPress 6.7+)
        if ( ! function_exists( 'register_block_template' ) ) {
            return;
        }

        $registry = \WP_Block_Templates_Registry::get_instance();

        foreach ( self::TEMPLATES as $slug => $data ) {
            $template_id   = 'woocommerce//' . $slug;
            $template_path = $this->get_template_path( $slug );

            // Skip if our template file doesn't exist
            if ( ! file_exists( $template_path ) ) {
                continue;
            }

            // Unregister WooCommerce's template if it exists
            if ( $registry->is_registered( $template_id ) ) {
                unregister_block_template( $template_id );
            }

            // Register our template with the SAME woocommerce// prefix
            // This ensures WooCommerce's styles and scripts still apply
            register_block_template(
                $template_id,
                [
                    'title'       => __( $data['title'], 'wca-woocommerce' ),
                    'description' => __( $data['description'], 'wca-woocommerce' ),
                    'content'     => file_get_contents( $template_path ),
                ]
            );
        }
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
