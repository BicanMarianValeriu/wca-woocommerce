<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Summary
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Order Confirmation Summary block.
 */
class Summary extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-summary';

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
				'typography' 	=> [
					'fontSize' 		=> true,
					'lineHeight'	=> true,
					'__experimentalFontFamily' 		=> true,
					'__experimentalFontWeight' 		=> true,
					'__experimentalFontStyle' 		=> true,
					'__experimentalTextTransform' 	=> true,
					'__experimentalTextDecoration' 	=> true,
					'__experimentalLetterSpacing' 	=> true,
					'__experimentalDefaultControls' => [
						'fontSize' => true,
					],
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
		$breaks 	= wecodeart_json( [ 'settings', 'custom', 'breakpoints' ], [] );

		$inline 	= '
			.wc-block-order-confirmation-summary-list {
				--wp--columns: 1;
				display: grid;
				grid-template-columns: repeat(var(--wp--columns), 1fr);
				gap: var(--wp--custom--gutter);
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.wc-block-order-confirmation-summary-list-item {
				background-color: var(--wp--preset--color--white);
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: 5px;
				padding: var(--wp--custom--gutter);
				box-shadow: 0 5px 25px rgb(250 250 250 / 85%);
			}
			.wc-block-order-confirmation-summary-list-item__key {
				display: block;
				font-weight: 700;
			}
			.wc-block-order-confirmation-summary-list-item__value {
				display: block;
				opacity: .8;
			}
			.theme-is-dark .wc-block-order-confirmation-summary-list-item {
				background-color: transparent;
				box-shadow: none;
			}
		';

		$inline .= "
			@media (min-width: {$breaks['sm']}) {
				.wc-block-order-confirmation-summary-list {
					--wp--columns: 2;
				}
			}
		";

		$inline .= "
			@media (min-width: {$breaks['lg']}) {
				.wc-block-order-confirmation-summary-list {
					--wp--columns: 3;
				}
			}
		";

		return $inline;
	}
}
