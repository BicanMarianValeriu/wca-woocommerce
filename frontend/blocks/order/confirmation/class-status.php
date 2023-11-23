<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Status
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Order Confirmation Status block.
 */
class Status extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-status';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {

		$inline 	= '
			.wc-block-order-confirmation-status {
				--wc--icon: url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' fill=\'currentColor\' viewBox=\'0 0 16 16\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z\'/%3E%3C/svg%3E");
				text-align: center;
			}
			.wc-block-order-confirmation-status::before {
				content: "";
				display: inline-flex;
				width: 2.5em;
				height: 2.5em;
				background-color: var(--wp--preset--color--success);
				-webkit-mask-position: center;
				-webkit-mask-size: contain;
				-webkit-mask-image: var(--wc--icon);
					mask-image: var(--wc--icon);
			}
			.wc-block-order-confirmation-status p:only-child {
				margin: 0;
			}
			.wc-block-order-confirmation-status-description {
				text-align: center;
			}
		';

		return $inline;
	}
}
