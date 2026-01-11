<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Downloads
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Order Confirmation Create Account block.
 */
class Account extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-create-account';

	/**
	 * Block args.
	 *
	 * @param	array $current	Existing register args
	 *
	 * @return 	array
	 */
	public function block_type_args( array $current ): array {
		$supports 	= get_prop( $current, [ 'supports' ], [] );

		return [
			'supports'			=> wp_parse_args( [
				'spacing'	=> [
					'margin'  	=> true,
					'padding' 	=> true,
					'blockGap' 	=> [ 'horizontal', 'vertical' ],
					'__experimentalDefaultControls' => [
						'margin' 	=> false,
						'padding' 	=> false,
						'blockGap'	=> true,
					]
				]
			], $supports )
		];
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return <<<CSS
			.wc-block-order-confirmation-create-account {
			   display: grid;
			   grid-gap: var(--wp--preset--spacing--g);
			   grid-template-columns: repeat(2, 1fr);
			   padding: var(--wp--preset--spacing--g);
			}

			.wc-block-order-confirmation-create-account :where(h1,h2,h3,h4,h5,h6):first-child {
				margin-top: 0;
			}
		CSS;
	}
}