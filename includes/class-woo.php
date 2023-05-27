<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT
 * @subpackage WCA\EXT\WOO
 */

namespace WCA\EXT;

use WeCodeArt\Singleton;
use WeCodeArt\Integration;
use WCA\EXT\WOO\Frontend\Condition;
use function WeCodeArt\Functions\get_prop;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WCA\EXT
 * @subpackage WCA\EXT\WOO
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class WOO implements Integration {

	use Singleton;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WCA\EXT\WOO\Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * The config of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      mixed    $config    The config of the plugin.
	 */
	protected $config;

	/**
	 * Get Conditionals
	 *
	 * @return void
	 */
	public static function get_conditionals() {
		wecodeart( 'conditionals' )->register( [
			'is_woocommerce_page'		=> Condition\Page::class,
			'is_woocommerce_archive'	=> Condition\Archive::class,
		] );

		return [ 'is_woocommerce_active' ];
	}

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function init() {
		$this->plugin_name = 'wca-woocommerce';
		if ( defined( 'WCA_WOO_EXT_VER' ) ) {
			$this->version = WCA_WOO_EXT_VER;
		} else {
			$this->version = wecodeart( 'version' );
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->set_config();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function register_hooks() {
		$this->loader->run();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WCA\EXT\WOO\Loader. Orchestrates the hooks of the plugin.
	 * - WCA\EXT\WOO\I18n. Defines internationalization functionality.
	 * - WCA\EXT\WOO\Admin. Defines all hooks for the admin area.
	 * - WCA\EXT\WOO\Frontend. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		$this->loader = WOO\Loader::get_instance();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IAmBican\Includes\I18N class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = WOO\I18N::get_instance();

		$this->loader->add_action( 'init', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Define the plugin config.
	 *
	 * @since    2.0.0
	 * @access   private
	 */
	private function set_config() {
		$this->config = wp_parse_args( [
			'options' => wecodeart_option( 'woocommerce' ),
		], wecodeart_config( 'woocommerce', [] ) );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$admin = new WOO\Admin( $this->get_plugin_name(), $this->get_version(), $this->get_config() );

		// Admin init/scripts
		$this->loader->add_action( 'admin_init', 							$admin, 'if_active' 	);
		$this->loader->add_action( 'admin_enqueue_scripts',					$admin, 'assets' 		);
		// Handle Updates
		$this->loader->add_filter( 'pre_set_site_transient_update_plugins',	$admin, 'update' 		);
		$this->loader->add_filter( 'upgrader_post_install',					$admin, 'install', 	20, 3 );
		// Handle Plugin Info
		$this->loader->add_filter( 'plugins_api', 							$admin, 'info', 	20, 3 );
		$this->loader->add_filter( 'plugin_action_links',					$admin, 'links', 	20, 2 );
		$this->loader->add_filter( 'plugin_row_meta',						$admin, 'meta', 	20, 2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$frontend = new WOO\Frontend( $this->get_plugin_name(), $this->get_version(), $this->get_config() );
		$patterns = WOO\Frontend\Patterns::get_instance();
		$template = WOO\Frontend\Templates::get_instance();

		// var_dump( $template->get_missing() );

		// Load Hooks
		$this->loader->add_action( 'init',										$patterns, 'register',				20, 1 );
		$this->loader->add_action( 'wp_enqueue_scripts',						$frontend, 'assets', 				20, 1 );
		$this->loader->add_action( 'after_setup_theme',							$frontend, 'after_setup_theme',		20, 1 );
		$this->loader->add_filter( 'get_block_templates',						$template, 'get_block_templates',	20, 3 );
		$this->loader->add_filter( 'woocommerce_form_field',					$frontend, 'form_field_markup',		20, 4 );
		$this->loader->add_filter( 'woocommerce_locate_template',				$frontend, 'locate_template',		20, 2 );
		$this->loader->add_filter( 'wecodeart/filter/gutenberg/styles/core',	$frontend, 'block_inline_styles',	20, 1 );
		$this->loader->add_filter( 'wecodeart/filter/gutenberg/restricted',		$frontend, 'restricted_blocks',		20, 1 );
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Iambican_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	/**
	 * Retrieve the config of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The config of the plugin.
	 */
	public function get_config() {
		return $this->config;
	}
}