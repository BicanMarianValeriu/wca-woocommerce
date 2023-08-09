<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks
 */

namespace WCA\EXT\WOO\Frontend;

use WeCodeArt\Singleton;
use WeCodeArt\Config\Traits\Asset;

/**
 * Blocks
 */
class Blocks {

	use Singleton;
    use Asset;

    /**
	 * The CSS cache file.
	 *
	 * @var string
	 */
    const CACHE_FILE    = 'woo-blocks.css';
    const CACHE_KEY     = 'wecodeart/gutenberg/woocommerce/blocks';

    /**
	 * Register blocks.
	 *
	 * @since	1.0.0
	 * @version	1.0.0
	 */
	public function register( $container ) {
		// Misc Blocks
		$container->register( 'woocommerce/store-notices',			Blocks\Notices::class );
		$container->register( 'woocommerce/catalog-sorting',		Blocks\Sorting::class );
		$container->register( 'woocommerce/all-reviews',			Blocks\Reviews::class );
		$container->register( 'woocommerce/all-products',			Blocks\Products::class );
		$container->register( 'woocommerce/breadcrumbs',			Blocks\Breadcrumbs::class );
		$container->register( 'woocommerce/categories',				Blocks\Categories::class );
		// Filters
		$container->register( 'woocommerce/filter-wrapper', 		Blocks\Filters::class );
		$container->register( 'woocommerce/active-filters',			Blocks\Filters\Active::class );
		$container->register( 'woocommerce/price-filter', 			Blocks\Filters\Price::class );
		$container->register( 'woocommerce/rating-filter',			Blocks\Filters\Rating::class );
		$container->register( 'woocommerce/stock-filter',			Blocks\Filters\Stock::class );
		$container->register( 'woocommerce/attribute-filter',		Blocks\Filters\Attribute::class );
		// Featured
		$container->register( 'woocommerce/featured-product',		Blocks\Featured::class );
		// Product
		$container->register( 'woocommerce/product-price', 			Blocks\Product\Price::class );
		$container->register( 'woocommerce/product-image', 			Blocks\Product\Image::class );
		$container->register( 'woocommerce/product-button', 		Blocks\Product\Button::class );
		$container->register( 'woocommerce/product-rating', 		Blocks\Product\Rating::class );
		$container->register( 'woocommerce/product-details',		Blocks\Product\Details::class );
		$container->register( 'woocommerce/product-image-gallery',	Blocks\Product\Gallery::class );
		$container->register( 'woocommerce/add-to-cart-form',		Blocks\Product\Cart::class );
		// Account
		$container->register( 'woocommerce/customer-account',		Blocks\Account\Link::class );
		// Cart
		$container->register( 'woocommerce/cart',								Blocks\Cart::class );
		$container->register( 'woocommerce/cart-cross-sells-products',			Blocks\Cart\Crossells::class );
		$container->register( 'woocommerce/cart-order-summary-shipping',		Blocks\Cart\Summary\Shipping::class );
		$container->register( 'woocommerce/cart-order-summary-coupon-form',		Blocks\Cart\Summary\Coupon::class );
		// Mini Cart
		$container->register( 'woocommerce/mini-cart',							Blocks\Cart\Widget::class );
		$container->register( 'woocommerce/mini-cart-title',					Blocks\Cart\Widget\Title::class );
		$container->register( 'woocommerce/mini-cart-items',					Blocks\Cart\Widget\Items::class );
		$container->register( 'woocommerce/mini-cart-contents',					Blocks\Cart\Widget\Contents::class );
		$container->register( 'woocommerce/mini-cart-footer',					Blocks\Cart\Widget\Footer::class );
		$container->register( 'woocommerce/mini-cart-shopping-button',			Blocks\Cart\Widget\Button::class );
		// Checkout
		$container->register( 'woocommerce/checkout',							Blocks\Checkout::class );
		$container->register( 'woocommerce/checkout-billing-address',			Blocks\Checkout\Address::class );
		$container->register( 'woocommerce/checkout-shipping-method',			Blocks\Checkout\Shipping::class );
		$container->register( 'woocommerce/checkout-order-summary-cart-items',	Blocks\Checkout\Summary\Items::class );
		$container->register( 'woocommerce/checkout-order-summary-coupon-form',	Blocks\Checkout\Summary\Coupon::class );
		
		// New Blocks
		$container->register( 'woocommerce/viewed-products',	Blocks\Viewed::class );
	}

    /**
	 * Cache components.
	 *
	 * @return  void
	 */
	public function cache() {
		$filesystem = wecodeart( 'files' );
		$filesystem->set_folder( 'cache' );

		if( ! $filesystem->has_file( self::CACHE_FILE ) || false === get_transient( self::CACHE_KEY ) ) {
			// Blocks Cache
			$inline = '';

			foreach( [
				// Misc
				'woocommerce/store-notices',
				'woocommerce/catalog-sorting',
				'woocommerce/all-reviews',
				'woocommerce/all-products',
				'woocommerce/breadcrumbs',
				'woocommerce/categories',
				// Filters
				'woocommerce/filter-wrapper',
				'woocommerce/active-filters',
				'woocommerce/attribute-filter',
				'woocommerce/stock-filter',
				'woocommerce/price-filter',
				'woocommerce/rating-filter',
				// Featured
				'woocommerce/featured-product',
				'woocommerce/featured-category',
				// Product
				'woocommerce/product-price',
				'woocommerce/product-image',
				'woocommerce/product-button',
				'woocommerce/product-rating',
				'woocommerce/product-details',
				'woocommerce/product-image-gallery',
				'woocommerce/add-to-cart-form',
				// Account
				'woocommerce/customer-account',
				// Everything else is added on page
				'woocommerce/cart',
				'woocommerce/cart-cross-sells-products',
				'woocommerce/cart-order-summary-coupon-form',
				'woocommerce/cart-order-summary-shipping',
				'woocommerce/mini-cart',
				'woocommerce/mini-cart-title',
				'woocommerce/mini-cart-items',
				'woocommerce/mini-cart-footer',
				'woocommerce/mini-cart-shopping-button',
				'woocommerce/checkout',
				'woocommerce/checkout-billing-address',
				'woocommerce/checkout-shipping-method',
				'woocommerce/checkout-order-summary-coupon-form',
				'woocommerce/checkout-order-summary-cart-items',
			] as $block ) {
				if( wecodeart( 'blocks' )->has( $block ) ) {
					$inline .= wecodeart( 'blocks' )->get( $block )::get_instance()->styles();
				}
			}

			$filesystem->create_file( self::CACHE_FILE, wecodeart( 'styles' )::compress( $inline ) );
			set_transient( self::CACHE_KEY, true, 12 * HOUR_IN_SECONDS );
		}
		$filesystem->set_folder( '' );
	}

	/**
	 * Filter - Restricted WooCommerce Blocks from theme code (extending their attributes will cause them to crash)
	 *
	 * @since	1.0.0
	 * @version	1.0.0
	 *
	 * @return 	array
	 */
	public function restricted( $blocks ) {
		return wp_parse_args( [
			'woocommerce/product-best-sellers', // ok
			'woocommerce/product-top-rated',	// ok
			'woocommerce/product-on-sale',		// ok
			'woocommerce/product-new',			// ok
			'woocommerce/product-tag',			// ok
			'woocommerce/product-category', 	// ok
			'woocommerce/products-by-attribute',// ok
			'woocommerce/handpicked-products',	// ok
			'woocommerce/product-categories',	// ok
			'fibosearch/search'
		], $blocks );
	}

	/**
     * Check if has products blocks
     *
     * @since	1.0.0
     * @version	1.0.0
     *
     * @return	boolean
     */
	public static function has_products( $blocks ) {
		// If any of this blocks styles are detected
		if( count( array_intersect( $blocks, [
			'woocommerce/product-on-sale',
			'woocommerce/product-top-rated',
			'woocommerce/product-best-sellers',
			'woocommerce/product-new',
			'woocommerce/product-tag',
			'woocommerce/product-category',
			'woocommerce/products-by-attribute',
			'woocommerce/all-products',
			'woocommerce/related-products',
			'woocommerce/handpicked-products',
			'woocommerce/cart-cross-sells-products-block'
		] ) ) ) {
			return true;
		}

		// Catalog page (if a pattern is in template and is not detected as a block when rendered)
		if( wecodeart_if( 'is_woocommerce_archive' ) ) {
			return true;
		}

		// For new block, we use the old fashioned way.
		global $_wp_wp_current_template_content;
		$template	= $_wp_wp_current_template_content ?: '';
		$content	= get_the_content( get_the_ID() );

		if(
			( has_block( 'core/query', $template ) && strpos( $template, 'woocommerce/product-query' ) ) || 
			( has_block( 'core/query', $content ) && strpos( $content, 'woocommerce/product-query' ) )
		) {
			return true;
		}
	}
}
