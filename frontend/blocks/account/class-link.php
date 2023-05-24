<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Account\Link
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Account;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Gutenberg Account Link block.
 */
class Link extends Dynamic {

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
	protected $block_name = 'customer-account';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-customer-account {
				display: inline-block;
			}
			.wp-block-woocommerce-customer-account a {
				display: flex;
				align-items: center;
				text-decoration: none;
				color: currentColor;
			}
			.wp-block-woocommerce-customer-account .icon {
				display: block;
				width: 1.25em;
				height: 1.25em;
			}
			.wp-block-woocommerce-customer-account .icon + .label {
				margin-left: .5em;
			}
			.wp-block-woocommerce-customer-account .label:empty {
				display: none;
			}
		';
	}
}
