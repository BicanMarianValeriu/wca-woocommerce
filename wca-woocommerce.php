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
 * Version:           1.2.8
 * Author:            Bican Marian Valeriu
 * Author URI:        https://www.wecodeart.com/about/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wca-woocommerce
 * Domain Path:       /languages
 * Requires at least:       6.5
 * Requires PHP:            7.4
 * WC requires at least:    8.0
 * WC tested up to:         8.9
 * Requires Plugins: woocommerce
 */
namespace WCA\EXT\WOO;

// If this file is called directly, abort.
defined( 'WPINC' ) || die;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WCA_WOO_EXT',	    __FILE__ );
define( 'WCA_WOO_EXT_VER', 	get_file_data( WCA_WOO_EXT, [ 'Version' ] )[0] ); // phpcs:ignore
define( 'WCA_WOO_EXT_DIR', 	plugin_dir_path( WCA_WOO_EXT ) );
define( 'WCA_WOO_EXT_URL', 	plugin_dir_url( WCA_WOO_EXT ) );
define( 'WCA_WOO_EXT_BASE',	plugin_basename( WCA_WOO_EXT ) );

require_once( WCA_WOO_EXT_DIR . '/includes/class-autoloader.php' );

new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/admin' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/includes' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/conditions' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/components' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/cart' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/cart/widget' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/filters' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/account' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/product' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/checkout' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/checkout/address' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/featured' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/order' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/order/confirmation' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/order/confirmation/address' );
new Autoloader( 'WCA\EXT\WOO', WCA_WOO_EXT_DIR . '/frontend/blocks/order/confirmation/wrappers' );

// Activation/Deactivation Hooks
register_activation_hook( WCA_WOO_EXT, [ Activator::class, 'run' ] );
register_deactivation_hook( WCA_WOO_EXT, [ Deactivator::class, 'run' ] );

/**
 * Hook the extension after WeCodeArt is Loaded
 */
add_action( 'wecodeart/theme/loaded', fn() => wecodeart( 'integrations' )->register( 'plugin/woocommerce', __NAMESPACE__ ) );
