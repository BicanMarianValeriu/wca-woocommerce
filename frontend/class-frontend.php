<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend
 */

namespace WCA\EXT\WOO;

use WeCodeArt\Config\Traits\Asset;
use function WeCodeArt\Functions\get_prop;

/**
 * The frontend-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the frontend-specific stylesheet and JavaScript.
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Frontend {

	use Asset;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The config of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		mixed    $config    The config of this plugin.
	 */
	private $config;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name	The name of this plugin.
	 * @param	string    $version		The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $config ) {
		$this->plugin_name	= $plugin_name;
		$this->version 		= $version;
		$this->config 		= $config;
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since	unknown
	 */
	public function after_setup_theme() {
		$support = get_prop( $this->config, [ 'support' ], [] );

		// Theme Support
		foreach( $support as $feature => $value ) {
			if( $value === 'remove' ) {
                remove_theme_support( $feature );
                continue;
            }
			add_theme_support( $feature, $value );
		}

		// Editor Styles
		$filesystem = wecodeart( 'files' );
		$filesystem->set_folder( 'cache' );
		add_editor_style( $filesystem->get_file_url( Frontend\Components::CACHE_FILE, true ) );
		global $pagenow;
		if( $pagenow === 'site-editor.php' ) {
			add_editor_style( $filesystem->get_file_url( Frontend\Blocks::CACHE_FILE, true ) );
		}
		$filesystem->set_folder( '' );
	}

	/**
	 * Assets
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	void
	 */
	public function assets() {
		$options 	= get_prop( $this->config, [ 'options' ], [] );
		$plugin 	= untrailingslashit( WCA_WOO_EXT_URL );
		$folder		= wecodeart_if( 'is_dev_mode' ) ? 'unminified' : 'minified';

		// By default we have our own simplified styles
		wp_deregister_style( 'wc-blocks-style' );
		wp_deregister_style( 'wc-blocks-packages-style' );
		wp_deregister_style( 'wc-blocks-editor-style' );

		// Legacy styles
		if( get_prop( $options, 'remove_style' ) ) {
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		}

		// Select2 styles
		if( get_prop( $options, 'replace_select2_style' ) ) {
			$select2	= wecodeart_if( 'is_dev_mode' ) ? 'select2' : 'select2.min';

			wecodeart( 'assets' )->add_style( 'select2', [
				'path' 		=> sprintf( '%s/assets/%s/css/%s.css', $plugin, $folder, $select2 ),
				'load'  	=> false,
				'version' 	=> $this->version,
			] );
		}
	}

	/**
	 * Cache blocks
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	void
	 */
	public function cache() {
        // Blocks Cache
		Frontend\Blocks::get_instance()->cache();
        
		// Components Cache
		Frontend\Components::get_instance()->cache();
	}

	/**
     * Form Field Markup
     *
     * @since	1.0.0
     * @version	1.0.0
     *
     * @return	array
     */
    public function form_field_markup( $field, $key, $args, $value ) {
        $invalid = [ 'state', 'country', 'select', 'radio' ];

        if( ! in_array( get_prop( $args, 'type' ), $invalid ) ) {

            $attributes = wp_array_slice_assoc( $args, [ 'id', 'input_class', 'placeholder', 'maxlength', 'autocomplete', 'autofocus', 'required' ] );
            $attributes = wp_parse_args( [
                'name' => $key,
                'value'=> $value
            ], $attributes );
            $custom_attributes = get_prop( $args, [ 'custom_attributes' ], [] );
            $attributes = wp_parse_args( $custom_attributes, $attributes );

            if( $classnames = get_prop( $attributes, [ 'input_class' ] ) ) {
                array_unshift( $classnames, 'form-control' );
                $attributes['class'] = join( ' ', $classnames );
                unset( $attributes['input_class'] );
            }

            $container     = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( get_prop( $args, 'priority', '' ) ) . '">%3$s</p>';
            
            $field_html =  wecodeart_input( get_prop( $args, 'type' ), [
                'label' => get_prop( $args, 'label' ),
                'attrs' => $attributes
            ], false );

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $container, $container_class, $container_id, $field_html );
        }

        // Default
        return $field;
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
     * Returns loading CSS
     *
     * @since	1.0.0
     * @version	1.0.0
     *
     * @return	string
     */
	public static function get_loading_css( string $selector = '', $extra = '' ): string {
		return "
			{$selector} {
				position: relative;
				display: block;
				width: 100%;
				min-height: 1.5em;
				max-width: 100%;
				margin-top: 1rem;
				line-height: 1;
				background-color: var(--wp--preset--color--accent);
				color: transparent;
				border: 0;
				border-radius: var(--wp--border-radius, .25rem);
				box-shadow: none;
				outline: 0;
				overflow: hidden;
				pointer-events: none;
				z-index: 1;
				{$extra}
			}
			{$selector}::after {
				content: '';
				position: absolute;
				display: block;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-image: linear-gradient(90deg,transparent,rgba(0,0,0,.035),transparent);
				background-repeat: no-repeat;
				animation: animation__loading 1.5s ease-in-out infinite;
				transform: translateX(-100%);
			}
		";
	}
}
