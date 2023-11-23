<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Wrappers
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Wrappers;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Order Confirmation Downloads wrapper block.
 */
class Downloads extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-downloads-wrapper';

	/**
	 * Block args.
	 *
	 * @param	array $current	Existing register args
	 *
	 * @return 	array
	 */
	public function block_type_args( $current ): array {
		$supports 	= get_prop( $current, [ 'supports' ], [] );

		return [
			'supports'		=> wp_parse_args( [
				'color'		=> [
                    'text'          => false,
					'gradients'	    => true,
					'background'    => true,
				],
				'__experimentalLayout'	=> [
					'allowSwitching'  => true,
					'allowInheriting' => false,
					'default'         => [
						'type'        		=> 'flex',
						'orientation' 		=> 'vertical',
                        'justifyContent' 	=> 'stretch'
					],
				],
				'__experimentalBorder'	=> [
					'color'  	=> true,
					'radius' 	=> true,
					'style' 	=> true,
					'width' 	=> true,
					'__experimentalDefaultControls'	=> [
						'color'  	=> true,
						'radius'	=> true,
						'style' 	=> true,
						'width' 	=> true,
					],
				],
				'spacing'	=> [
					'margin'  	=> true,
					'padding' 	=> true,
					'blockGap' 	=> true,
					'__experimentalDefaultControls' => [
						'blockGap' 	=> true,
						'padding' 	=> true,
						'margin' 	=> false,
					]
				],
			], $supports )
		];
	}

    /**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-order-confirmation-downloads-wrapper {
				box-sizing: border-box;
			}
		';
	}
}
