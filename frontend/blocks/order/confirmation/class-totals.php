<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation\Totals
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Order\Confirmation;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Order Confirmation Totals block.
 */
class Totals extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'order-confirmation-totals';

	/**
	 * Init.
	 */
	public function init() {
		\add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'render' ], 20, 2 );
    }

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function block_type_args(): array {
		return [
			'style'	=> [ 'wp-block-table', $this->get_asset_handle() ]
		];
	}

	/**
	 * Dynamically renders the `woocommerce/order-confirmation-totals` block.
	 * 
	 * @param 	string 	$content 		The block markup.
	 *
	 * @return 	string 	The block markup.
	 */
	public function render( string $content = '' ): string {
		$content 	= new \WP_HTML_Tag_Processor( $content );
		
		if( $content->next_tag( [
			'tag_name' 		=> 'table',
			'class_name' 	=> 'wc-block-order-confirmation-totals__table'
		] ) ) {
			$content->add_class( 'table table-bordered table-hover' );
		}
		
		while ( $content->next_tag( [
			'class_name' => 'wc-block-order-confirmation-totals__total'
		] ) ) {
			$content->add_class( 'has-text-align-right' );
		}
	
		return (string) $content->get_updated_html();
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-order-confirmation-totals__table {
				table-layout: fixed;
				width: 100%;
			}
			.wc-block-order-confirmation-totals__product a {
				font-weight: bold;
			}
			.wc-block-order-confirmation-totals__table tfoot .woocommerce-Price-amount {
				font-weight: bold;
			}
			.product-purchase-note {
				font-size: var(--wp--preset--font-size--small);
				opacity: .75;
			}
		';
	}
}
