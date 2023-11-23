<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Information
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Order Confirmation Additional Information block.
 */
class Information extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-additional-information';

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
					'gradients'	 => true,
					'background' => true,
					'link' 		 => true,
					'text'       => true
				],
				'typography' => [
					'fontSize' => true,
					'lineHeight' => true,
					'__experimentalFontFamily' => true,
					'__experimentalFontWeight' => true,
					'__experimentalFontStyle' => true,
					'__experimentalTextTransform' => true,
					'__experimentalTextDecoration' => true,
					'__experimentalLetterSpacing' => true,
					'__experimentalDefaultControls' => [
						'fontSize' => true,
					],
				],
				'__experimentalLayout'	=> [
					'allowSwitching'  => false,
					'allowInheriting' => false,
					'default'         => [
						'type'        => 'flex',
						'orientation' => 'vertical',
					],
				],
				'spacing'	=> [
					'margin'  	=> true,
					'padding' 	=> true,
					'blockGap' 	=> true,
					'__experimentalDefaultControls' => [
						'padding' 	=> true,
						'margin' 	=> false,
						'blockGap' 	=> false,
					]
				],
				'shadow' 	=> true
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
			.wc-block-order-confirmation-additional-information {
				box-sizing: border-box;
			}
		';
	}
}
