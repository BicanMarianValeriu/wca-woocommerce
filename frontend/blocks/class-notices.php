<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Notices
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Store Notices block.
 */
class Notices extends Dynamic {

	use Singleton;

	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'woocommerce';

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'store-notices';

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-notices', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wp-block-notices' ) || wp_style_is( 'wp-block-store-notices' ) ) {
					return false;
				}

				if( count( array_intersect( $blocks, [
					'woocommerce/cart-order-summary-shipping-block',
					'woocommerce/checkout-shipping-methods-block',
					'woocommerce/checkout-payment-block'
				] ) ) ) {
					return true;
				}

				if( is_account_page() ) {
					return true;
				}
			},
			'inline'	=> wecodeart( 'blocks' )->get( $this->get_block_type() )::get_instance()->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-store-notices .woocommerce-notices-wrapper,
			.wc-block-components-notices:not(:empty) {
				margin-bottom: var(--wp--style--block-gap);
			}
			.wc-block-store-notices .woocommerce-notices-wrapper:empty {
				display: none;
			}
			.wc-block-store-notices + * {
				margin-top: 0!important;
			}

			.wc-block-components-notice-banner {
				display: flex;
				align-items: center;
				gap: var(--wp--custom--gutter);
				padding: var(--wp--custom--gutter);
				border-left: 5px solid rgba(0, 0, 0, 0.15);
				background-color: var(--wp--preset--color--accent);
			}
			.wc-block-components-notice-banner__content {
				flex-basis: 100%;
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-components-notice-banner .wp-element-button {
				float: right;
				padding: 5px 10px;
			}
			.wc-block-components-notice-banner > svg {
				fill: white;
				background-color: currentColor;
				border-radius: 50%;
				flex-grow: 0;
				flex-shrink: 0;
				padding: 2px;
			}
			.wc-block-components-notice-banner.is-info {
				color: var(--wp--preset--color--dark);
			}
			.wc-block-components-notice-banner.is-success {
				color: var(--wp--preset--color--success);
			}
			.wc-block-components-notice-banner.is-success .wp-element-button {
				background-color: var(--wp--preset--color--success);
			}
			.wc-block-components-notice-banner.is-error {
				color: var(--wp--preset--color--danger);
			}
			.wc-block-components-notice-banner.is-error .wp-element-button {
				background-color: var(--wp--preset--color--danger);
			}
			.wc-block-components-notice-banner.is-warning {
				color: var(--wp--preset--color--warning);
			}
			.wc-block-components-notice-banner.is-warning .wp-element-button {
				background-color: var(--wp--preset--color--warning);
			}

			.components-snackbar-list {
				position: fixed;
				left: 0;
				right: 0;
				bottom: 0;
				z-index: 5;
			}
			.components-snackbar-list__notice-container {
				background-color: var(--wp--gray-900);
				color: var(--wp--preset--color--white);
				padding: var(--wp--custom--gutter);
			}
		';
	}
}
