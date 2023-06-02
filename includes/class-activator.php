<?php
/**
 * Fired during plugin activation
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Activator
 */

namespace WCA\EXT\WOO;


use WeCodeArt\Admin\Notifications;
use WeCodeArt\Admin\Notifications\Notification;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    IAmBican
 * @subpackage WCA\EXT\WOO\Activator
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function run() {
		$errors = self::if_compatible();

		if ( count( $errors ) ) {
			deactivate_plugins( WCA_WOO_EXT_BASE );
			wp_die( current( $errors ) );
		}

		if( ! wecodeart_option( 'woocommerce' ) ) {
			wecodeart_option( [
				'woocommerce' => [
					'remove_style'			=> true,
					'replace_select2_style' => true,
					'product_price_extra'	=> true,
					'product_rating_extra'	=> true,
					'customer_account_extra'=> false,
					'product_gallery_cols'	=> 5
				]
			] );
		}
	}

	/**
	 * Check if compatible
	 *
	 * @since    1.0.0
	 */
	public static function if_compatible() {
		$checks = [
			'theme' 	=> function_exists( 'wecodeart' ),
			'plugin' 	=> wecodeart_if( 'is_woocommerce_active' ),
		];

		$errors = [
			'theme' 	=> __( 'This extension requires WeCodeArt Framework (or a skin) installed and active.', 'wca-woocommerce' ),
			'plugin' 	=> __( 'This extension requires WooCommerce plugin installed and active.', 'wca-woocommerce' ),
		];

		$checks = array_filter( $checks, function( $value ) {
			return (boolean) $value === false;
		} );

		return array_intersect_key( $errors, $checks );	
	}
}
