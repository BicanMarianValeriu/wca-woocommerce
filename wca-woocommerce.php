<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.wecodeart.com/
 * @since             1.0.0
 * @package           WCA\EXT\WooCommerce
 *
 * @wordpress-plugin
 * Plugin Name:       WCA: WooCommerce
 * Plugin URI:        https://github.com/BicanMarianValeriu/wca-woocommerce
 * Description:       WCA WooCommerce extension for WeCodeArt Framework theme.
 * Version:           1.0.0
 * Author:            Bican Marian Valeriu
 * Author URI:        https://www.wecodeart.com/about/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wca-woocommerce
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 */
namespace WCA\EXT\WOO;

// If this file is called directly, abort.
defined( 'WPINC' ) || die;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCA_WOO_EXT',		 __FILE__ );
define( 'WCA_WOO_EXT_VER', 	get_file_data( WCA_WOO_EXT, [ 'Version' ] )[0] ); // phpcs:ignore
define( 'WCA_WOO_EXT_DIR', 	plugin_dir_path( WCA_WOO_EXT ) );
define( 'WCA_WOO_EXT_URL', 	plugin_dir_url( WCA_WOO_EXT ) );
define( 'WCA_WOO_EXT_BASE',	plugin_basename( WCA_WOO_EXT ) );

require_once( __DIR__ . '/includes/class-autoloader.php' );

new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/admin' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/includes' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/condition' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks/cart' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks/cart/widget' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks/account' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks/product' );
new Autoloader( 'WCA\EXT\WOO', __DIR__ . '/frontend/blocks/checkout' );

/**
 * The code that runs during plugin activation.
 */
function activate() {
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate() {
	Deactivator::deactivate();
}

register_activation_hook( WCA_WOO_EXT, __NAMESPACE__ . '\\activate' );
register_deactivation_hook( WCA_WOO_EXT, __NAMESPACE__ . '\\deactivate' );

/**
 * Hook the extension after WeCodeArt is Loaded
 */
add_action( 'wecodeart/theme/loaded', function() {
	wecodeart( 'integrations' )->register( 'plugin/woocommerce', __NAMESPACE__ );
	wecodeart( 'conditionals' )->register( [
		'is_woocommerce_page'		=> Frontend\Condition\Page::class,
		'is_woocommerce_archive'	=> Frontend\Condition\Archive::class,
	] );
} );

