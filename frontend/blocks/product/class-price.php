<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Product\Price
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Product;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WCA\EXT\WOO\Frontend;

use function add_action;
use function add_filter;
use function str_replace;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Product Price block.
 */
class Price extends Dynamic {

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
	protected $block_name = 'product-price';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		$is_enabled = get_prop( wecodeart_option( 'woocommerce' ), [ 'product_price_extra' ] );

		if( ! $is_enabled ) return;

		add_action( 'woocommerce_product_options_general_product_data', [ $this, 'manufacturer_product_data' 	], 20 );
		add_action( 'woocommerce_variation_options_pricing', 			[ $this, 'manufacturer_variation_data' 	], 20, 3 );
		add_action( 'woocommerce_process_product_meta', 				[ $this, 'process_product_meta' 		], 20);
		add_action( 'woocommerce_save_product_variation', 				[ $this, 'process_variation_meta' 		], 20, 2 );
		add_filter( 'woocommerce_available_variation',					[ $this, 'render_variation'	], 20 );
		add_filter( 'render_block_' . $this->get_block_type(),			[ $this, 'render_block'		], 20 );
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function render_block( string $content = '', array $block = [] ): string {
		// $is_single_product = get_prop( $block, [ 'attrs', 'isDescendentOfSingleProductTemplate' ] ) === true;

		$content = str_replace( '<del', $this->markup() . '<del', $content );

		$processor = new \WP_HTML_Tag_Processor( $content );
		$processor->next_tag();
	
		// Clean empty class
		if( $class = $processor->get_attribute( 'class' ) ) {
			$processor->set_attribute( 'class', rtrim( $class ) );
		}

		return $processor->get_updated_html();
	}

	/**
	 * Render Variation 
	 *
	 * @param 	array 	$variations
	 *
	 * @return 	array
	 */
	public function render_variation( array $variations = [] ): array {
		$variations['price_manufacturer'] = $this->markup( wc_get_product( $variations[ 'variation_id' ] ) );
		
		return $variations;
	}

	/**
	 * Markup
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function markup( object $product = null ): string {
		if( is_null( $product ) ) {
			global $product;
		}

		if( ! is_object( $product ) ) {
			return '';
		}
		
		$prp = $product->get_meta( 'price_manufacturer' );
		
		if( empty( $prp ) ) {
			return '';
		}
		
		$message = esc_html__( 'This is the manufacturer\'s recommended price. The selling price of the product is shown below.', 'wca-woocommerce' );
		
		wecodeart( 'styles' )->Utilities->load( [
			'ms-1',
			'mb-1',
			'fw-400'
		] );
		
		wecodeart( 'markup' )->SVG::add( 'info', [
			'viewBox'	=> '0 0 16 16',
			'paths' 	=> [
				'M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z',
				'm8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z'
			]
		] );
		
		ob_start();

		?>
		<p class="has-small-font-size has-cyan-bluish-gray-color fw-400 mb-1">
			<span><?php
			
				printf( 'PRP: %s', wc_price( $prp ) );
		
			?></span>
			<a class="has-cyan-bluish-gray-color ms-1"
				href="javascript:void(0);"
				data-bs-toggle="tooltip"
				data-bs-custom-class="prp-tooltip"
				title="<?php echo esc_attr( $message ); ?>">
				<?php
				
				wecodeart( 'markup' )->SVG::render( 'info', [
					'class' => 'fa-fw'
				] );
		
				?>
			</a>
		</p>
		<?php

		return ob_get_clean();
	}

	/**
	 * Process Variation Meta
	 *
	 * @param 	int		$variation_id
	 * @param 	int		$i
	 *
	 * @return 	void
	 */
	public function process_variation_meta( $variation_id, $i ) {
		$product = wc_get_product( $variation_id );
		$product_prp = sanitize_text_field( get_prop( $_POST, [ 'price_manufacturer', $i ], '' ) );
		$product->update_meta_data( 'price_manufacturer', $product_prp );
		$product->save();
	}
	
	/**
	 * Process Product Meta
	 *
	 * @param 	int		$post_id
	 *
	 * @return 	string
	 */
	public function process_product_meta( $post_id ) {
		$product = wc_get_product( $post_id );
		$product_prp = sanitize_text_field( get_prop( $_POST, [ 'price_manufacturer' ], '' ) );
		$product->update_meta_data( 'price_manufacturer', $product_prp );
		$product->save();
	}

	/**
	 * General Product Data
	 *
	 * @return 	string
	 */
	public function manufacturer_product_data() {
		// Number Field
		woocommerce_wp_text_input( [
			'data_type'		=> 'price',
			'id' 			=> 'price_manufacturer', 
			'label' 		=> sprintf( __( 'Recommended price (%s)', 'woocommerce' ), get_woocommerce_currency_symbol() ), 
			'placeholder' 	=> '', 
			'description'	=> __( 'Enter the price recommended by manufacturer.', 'woocommerce' ),
			'desc_tip' 		=> true,
		] );
	}

	/**
	 * Variation Data
	 *
	 * @return 	void
	 */
	public function manufacturer_variation_data( $loop, $variation_data, $variation ) { 
		// Number Field
		woocommerce_wp_text_input( [
			'data_type'		=> 'price',
			'wrapper_class'	=> 'form-row',
			'id' 			=> 'price_manufacturer[' . $loop . ']', 
			'label' 		=> sprintf( __( 'Recommended price (%s)', 'woocommerce' ), get_woocommerce_currency_symbol() ), 
			'value' 		=> get_post_meta( $variation->ID, 'price_manufacturer', true ),
			'placeholder' 	=> '', 
			'description'	=> __( 'Enter the price recomended by manufacturer.', 'woocommerce' ),
			'desc_tip' 		=> true,
		] );
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-price', [
			'load'		=> function( $blocks ) {
				if( wp_style_is( 'wp-block-price' ) || wp_style_is( 'wp-block-product-price' ) ) {
					return false;
				}

				// Products
				if( Frontend\Blocks::has_products( $blocks ) ) {
					return true;
				}

				// If any of this blocks styles are detected
				if( count( array_intersect( $blocks, [
					'woocommerce/cart-cross-sells-products-block',
					'woocommerce/checkout-order-summary-cart-items-block',
				] ) ) ) {
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
			:is(.price,.wc-block-grid__product-price,.wc-block-components-product-price) {
				font-weight: bold;
				line-height: 1;
				color: var(--wp--gray-800);
			}
			:is(.price,.wc-block-grid__product-price,.wc-block-components-product-price) :where(del, ins) > * {
				font-size: inherit;
				color: inherit;
			}
			:is(.price,.wc-block-grid__product-price,.wc-block-components-product-price) del {
				font-size: var(--wp--preset--font-size--small);
				color: var(--wp--gray-500); 
			}
			:is(.price,.wc-block-grid__product-price,.wc-block-components-product-price) ins {
				color: var(--wp--preset--color--danger);
				text-decoration: none;
				margin-left: 5px;
			}
			.wc-block-components-product-price--align-center,
			.wc-block-components-product-price--align-right {
				display: block;
			}
			.wc-block-components-product-price--align-center {
				text-align: center;
			}
			.wc-block-components-product-price--align-right {
				text-align: right;
			}
			.prp-tooltip .tooltip-inner {
				max-width: 350px;
			}
		';
	}
}
