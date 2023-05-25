<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend
 */

namespace WCA\EXT\WOO;

use WeCodeArt\Config\Traits\Asset;
use function WeCodeArt\Functions\get_prop;

/**
 * The frontend-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the frontend-specific stylesheet and JavaScript.
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend
 * @author     Bican Marian Valeriu <marianvaleriubican@gmail.com>
 */
class Frontend {

	use Asset;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The config of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		mixed    $config    The config of this plugin.
	 */
	private $config;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param	string    $plugin_name	The name of this plugin.
	 * @param	string    $version		The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $config ) {
		$this->plugin_name	= $plugin_name;
		$this->version 		= $version;
		$this->config 		= $config;
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since	unknown
	 */
	public function after_setup_theme() {
		$support = get_prop( $this->config, 'support', [] );

		// Theme Support
		foreach( $support as $feature => $value ) {
			if( $value === 'remove' ) {
                remove_theme_support( $feature );
                continue;
            }
			add_theme_support( $feature, $value );
		}

		// Register Blocks Overwrites
		// Misc Blocks
		wecodeart( 'blocks' )->register( 'woocommerce/store-notices',			Frontend\Blocks\Notices::class );
		wecodeart( 'blocks' )->register( 'woocommerce/all-reviews',				Frontend\Blocks\Reviews::class );
		wecodeart( 'blocks' )->register( 'woocommerce/all-products',			Frontend\Blocks\Products::class );
		wecodeart( 'blocks' )->register( 'woocommerce/breadcrumbs',				Frontend\Blocks\Breadcrumbs::class );
		// Filters
		wecodeart( 'blocks' )->register( 'woocommerce/filter-wrapper', 			Frontend\Blocks\Filters::class );
		wecodeart( 'blocks' )->register( 'woocommerce/active-filters',			Frontend\Blocks\Filters\ActiveFilters::class );
		wecodeart( 'blocks' )->register( 'woocommerce/price-filter', 			Frontend\Blocks\Filters\PriceFilter::class );
		wecodeart( 'blocks' )->register( 'woocommerce/rating-filter',			Frontend\Blocks\Filters\RatingFilter::class );
		wecodeart( 'blocks' )->register( 'woocommerce/stock-filter',			Frontend\Blocks\Filters\StockFilter::class );
		wecodeart( 'blocks' )->register( 'woocommerce/attribute-filter',		Frontend\Blocks\Filters\AttributeFilter::class );
		// Featured
		wecodeart( 'blocks' )->register( 'woocommerce/featured-product',		Frontend\Blocks\Featured::class );
		wecodeart( 'blocks' )->register( 'woocommerce/featured-category',		Frontend\Blocks\Featured\Category::class );
		// Product
		wecodeart( 'blocks' )->register( 'woocommerce/product-price', 			Frontend\Blocks\Product\Price::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-rating', 			Frontend\Blocks\Product\Rating::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-details',			Frontend\Blocks\Product\Details::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-image-gallery',	Frontend\Blocks\Product\Gallery::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-categories',		Frontend\Blocks\Categories::class );
		// Account
		wecodeart( 'blocks' )->register( 'woocommerce/customer-account',		Frontend\Blocks\Account\Link::class );
		// Cart
		wecodeart( 'blocks' )->register( 'woocommerce/cart',								Frontend\Blocks\Cart::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-cross-sells-products',			Frontend\Blocks\Cart\Crossells::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary',					Frontend\Blocks\Cart\Summary::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary-coupon-form',		Frontend\Blocks\Cart\Summary\Coupon::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary-shipping',			Frontend\Blocks\Cart\Summary\Shipping::class );
		// Mini Cart
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart',							Frontend\Blocks\Cart\Widget::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-title',						Frontend\Blocks\Cart\Widget\Title::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-items',						Frontend\Blocks\Cart\Widget\Items::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-footer',					Frontend\Blocks\Cart\Widget\Footer::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-shopping-button',			Frontend\Blocks\Cart\Widget\Button::class );
		// // Checkout
		wecodeart( 'blocks' )->register( 'woocommerce/checkout',							Frontend\Blocks\Checkout::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-billing-address',			Frontend\Blocks\Checkout\Address::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary',				Frontend\Blocks\Checkout\Summary::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary-cart-items',	Frontend\Blocks\Checkout\Summary\Items::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary-coupon-form',	Frontend\Blocks\Checkout\Summary\Coupon::class );
	}

	/**
	 * Assets
	 *
	 * @since 	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	void
	 */
	public function assets() {
		$options = get_prop( $this->config, [ 'options' ], [] );

		// By default we have our own simplified styles
		wp_deregister_style( 'wc-blocks-style' );

		if( get_prop( $options, 'remove_style' ) ) {
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		}

		if( get_prop( $options, 'remove_select2_style' ) ) {
			wp_deregister_style( 'select2' );
		}
		
		$path = wecodeart_if( 'is_dev_mode' ) ? 'unminified' : 'minified';
		$name = wecodeart_if( 'is_dev_mode' ) ? 'frontend' : 'frontend.min';

		wp_enqueue_style(
			$this->make_handle(),
			sprintf( '%s/assets/%s/css/%s.css', untrailingslashit( WCA_WOO_EXT_URL ), $path, $name ),
			$this->version,
		);

		wp_enqueue_script(
			$this->make_handle(),
			sprintf( '%s/assets/%s/js/%s.js', untrailingslashit( WCA_WOO_EXT_URL ), $path, $name ),
			[ 'wecodeart-support-assets' ],
			$this->version,
			true
		);
	}

	/**
	 * Block CSS process
	 *
	 * @since	5.6.3
	 * @version	6.1.2
	 *
	 * @return 	array
	 */
	public function block_inline_styles( $args ) {
		return array_merge( $args, [
			'woocommerce/product-categories',
			'woocommerce/featured-category',
			'woocommerce/featured-product',
			'woocommerce/reviews-by-category',
			'woocommerce/reviews-by-product',
			'woocommerce/all-reviews',
		] );
	}

	/**
	 * Filter - Restricted WooCommerce Blocks from theme code
	 *
	 * @since	5.0.0
	 * @version	6.1.2
	 *
	 * @return 	array
	 */
	public function restricted_blocks( $blocks ) {
		return wp_parse_args( [
			'woocommerce/products-by-attribute',// ok
			'woocommerce/product-best-sellers', // ok
			'woocommerce/product-top-rated',	// ok
			'woocommerce/product-on-sale',		// ok
			'woocommerce/product-category', 	// ok
			'woocommerce/product-new',			// ok
			'woocommerce/product-tag',			// ok
			'woocommerce/products-by-tag',		// old naming, just in case
		], $blocks );
	}

	/**
     * Form Field Markup
     *
     * @since	5.6.4
     * @version	6.1.2
     *
     * @return	array
     */
    public function form_field_markup( $field, $key, $args, $value ) {
        $invalid = [ 'state', 'country', 'select', 'radio' ];

        if( ! in_array( get_prop( $args, 'type' ), $invalid ) ) {

            $attributes = wp_array_slice_assoc( $args, [ 'id', 'input_class', 'placeholder', 'maxlength', 'autocomplete', 'autofocus', 'required' ] );
            $attributes = wp_parse_args( [
                'name' => $key,
                'value'=> $value
            ], $attributes );
            $custom_attributes = get_prop( $args, [ 'custom_attributes' ], [] );
            $attributes = wp_parse_args( $custom_attributes, $attributes );

            if( $classnames = get_prop( $attributes, [ 'input_class' ] ) ) {
                array_unshift( $classnames, 'form-control' );
                $attributes['class'] = join( ' ', $classnames );
                unset( $attributes['input_class'] );
            }

            $container     = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( get_prop( $args, 'priority', '' ) ) . '">%3$s</p>';
            
            $field_html =  wecodeart_input( get_prop( $args, 'type' ), [
                'label' => get_prop( $args, 'label' ),
                'attrs' => $attributes
            ], false );

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $container, $container_class, $container_id, $field_html );
        }

        // Default
        return $field;
    }

	/**
     * Returns loading CSS
     *
     * @since	6.1.2
     * @version	6.1.2
     *
     * @return	string
     */
	public static function get_loading_css( string $selector = '', $extra = '' ): string {
		return "
			{$selector} {
				position: relative;
				display: block;
				width: 100%;
				min-height: 1.5em;
				max-width: 100%;
				margin-top: 1rem;
				line-height: 1;
				background-color: var(--wp--gray-200);
				color: transparent;
				border: 0;
				border-radius: var(--wp--border-radius, .25rem);
				box-shadow: none;
				outline: 0;
				overflow: hidden;
				pointer-events: none;
				z-index: 1;
				{$extra}
			}
			{$selector}::after {
				content: ' ';
				position: absolute;
				display: block;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-image: linear-gradient(90deg,var(--wp--gray-200),var(--wp--gray-100),var(--wp--gray-200));
				background-repeat: no-repeat;
				animation: animation__loading 1.5s ease-in-out infinite;
				transform: translateX(-100%);
			}
		";
	}
}
