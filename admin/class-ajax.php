<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Admin
 */

namespace WCA\EXT\WOO\Admin;

use WeCodeArt\Admin\Request\Async;
use WCA\EXT\WOO\Frontend\Templates;
use Automattic\WooCommerce\Blocks\Utils\BlockTemplateUtils;
use function WeCodeArt\Functions\get_prop;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Admin
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Ajax extends Async {

    /**
     * Prefix
     *
     * @var     string
     * @access  protected
     */
    protected $prefix = 'wca';

    /**
     * Action
     *
     * @var     string
     * @access  protected
     */
    protected $action = 'manage_woo_data';

    /**
     * Handle
     * 
     * @return  mixed
     */
    protected function handle() {
        $type   = sanitize_text_field( get_prop( $_POST, 'type', '' ) );
        $slugs  = array_map( 'sanitize_text_field', json_decode( stripslashes( get_prop( $_POST, 'slugs', '[]' ) ), true ) );

		if ( empty( $slugs ) ) {
            wp_send_json_success( [
                'message'   => esc_html__( 'Templates array is empty.', 'wca-woocommerce' ),
            ] );
        }

        switch( $type ) :
            case 'copy':
                $data = self::copy_templates( $slugs );
            break;
            default: 
                $data = [
                    'message'   => esc_html__( 'Please define an action type.', 'wca-woocommerce' ),
                ];
            break;
        endswitch;

        wp_send_json_success( $data );
    }

    /**
     * Copy templates
     *
     * @param   array   $slugs    Array of slugs
     * 
     * @return  array
     */
    public static function copy_templates( array $slugs = [] ): array {
        global $wp_filesystem;

        // Initialize the WP Filesystem
        if ( ! function_exists( 'WP_Filesystem' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        WP_Filesystem();
        
        $message    = '';
        $success    = [];
        $failed     = [];

        // Get the files in the source folder
        $files = BlockTemplateUtils::get_template_paths( Templates::get_directory() );

        $directory = get_stylesheet_directory() . '/templates';

        // Create /templates directory if is missing
        if ( ! file_exists( $directory ) ) {
            wp_mkdir_p( $directory );
        }

        // Copy each file to the destination folder
        foreach ( $files as $file ) {
            // Get the slug without file extension
            $slug = BlockTemplateUtils::generate_template_slug_from_path( $file );

            // Check if the slug is in the $slugs array
            if ( ! in_array( $slug, $slugs ) ) {
                continue;
            }
            
            $copy_to = trailingslashit( $directory ) . $slug . '.html';

            // Copy the file
            if ( $wp_filesystem->copy( $file, $copy_to, true, \FS_CHMOD_FILE ) ) {
                $success[] = $slug;
            } else {
                $failed[] = $slug;
            }
        }

        if( count( $success ) === count( $slugs ) ) {
            $message = esc_html__( 'All templates installed successfully. You can customize them in Site Editor.', 'wca-woocommerce' );
        }
        
        if( count( $failed ) === count( $slugs ) ) {
            $message = esc_html__( 'All templates have failed to install.', 'wca-woocommerce' );
        }

        return [
            'message'   => $message,
            'success'   => $success,
            'failed'    => $failed,
        ];
    }
}