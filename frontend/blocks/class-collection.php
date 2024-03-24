<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Products
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Products block.
 */
class Collection extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'product-collection';

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
			'supports'	=> wp_parse_args( [
				'spacing'	=> [
					'margin'	=> true,
					'padding'	=> true,
					'blockGap'	=> true,
					'__experimentalDefaultControls' => [
						'margin'	=> false,
						'padding'	=> false,
						'blockGap'	=> true,
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
			.wc-blocks-product-collection__collections-section {
				display: grid;
				grid-template-columns: repeat(2, 1fr);
				grid-template-rows: auto;
				gap: 1rem;
			}
			.wc-blocks-product-collection__collection-button.components-button {
				display: flex;
				align-items: flex-start;
				gap: 1rem;
				padding: .75rem;
				height: auto;
				white-space: pre-wrap;
				text-align: left;
			}
			.wc-blocks-product-collection__collection-button-title {
				margin-top: 0;
				font-weight: bold;
			}
			.wc-blocks-product-collection__collection-button-description {
				margin-bottom: 0;
			}
			.wc-blocks-product-collection__footer {
				display: flex;
				justify-content: flex-end;
				gap: 0.5rem;
				margin-top: 1rem;
			}
		';
	}
}