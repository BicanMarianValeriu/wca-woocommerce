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

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

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
			:where(.wc-block-product,.cross-sells-product) {
				--wp--radius: 0.375rem;
				position: relative;
				display: flex;
				flex-direction: column;
				justify-content: space-between;
				text-align: center;
				background-color: transparent;
				transition: border-color 0.5s cubic-bezier(0.075, 0.82, 0.165, 1), box-shadow 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
				border: 1px solid var(--wp--preset--color--accent);
				border-radius: var(--wp--radius);
				box-sizing: border-box;
			}
			:where(.wc-block-product,.cross-sells-product):hover {
				border-color: var(--wp--preset--color--primary);
				box-shadow: 0 0 15px 5px rgba(0, 0, 0, 0.05);
			}
			:where(.wc-block-product .wp-block-post-title a,.wc-block-components-product-title a) {
				display: block;
				font-size: 1rem;
				font-weight: 700;
				text-transform: uppercase;
				margin-left: .5rem;
				margin-right: .5rem;
			}
			.wc-block-pagination {
				margin: 3rem 0 0;
			}
			.wc-block-pagination-page {
				padding: 0.5rem 1rem;
				margin: 1px;
			}
			.wc-block-pagination-page:hover:not(:disabled),
			.wc-block-pagination-page--active {
				background-color: var(--wp--preset--color--primary);
				border-color: var(--wp--preset--color--primary);
				color: white !important;
			}
			.wc-block-pagination-page:disabled {
				color: var(--wp--gray-500);
				pointer-events: none;
			}

			/* Misc */
			.woocommerce-result-count {
				margin: 0;
			}
		';
	}
}