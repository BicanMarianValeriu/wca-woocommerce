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
use WCA\EXT\WOO\Frontend;

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
	public function after_setup_theme() {
        // Register Blocks Overwrites
		// Misc Blocks
		wecodeart( 'blocks' )->register( 'woocommerce/store-notices',			Blocks\Notices::class );
		wecodeart( 'blocks' )->register( 'woocommerce/catalog-sorting',			Blocks\Sorting::class );
		wecodeart( 'blocks' )->register( 'woocommerce/all-reviews',				Blocks\Reviews::class );
		wecodeart( 'blocks' )->register( 'woocommerce/all-products',			Blocks\Products::class );
		wecodeart( 'blocks' )->register( 'woocommerce/breadcrumbs',				Blocks\Breadcrumbs::class );
		wecodeart( 'blocks' )->register( 'woocommerce/categories',				Blocks\Categories::class );
		// Filters
		wecodeart( 'blocks' )->register( 'woocommerce/filter-wrapper', 			Blocks\Filters::class );
		wecodeart( 'blocks' )->register( 'woocommerce/active-filters',			Blocks\Filters\Active::class );
		wecodeart( 'blocks' )->register( 'woocommerce/price-filter', 			Blocks\Filters\Price::class );
		wecodeart( 'blocks' )->register( 'woocommerce/rating-filter',			Blocks\Filters\Rating::class );
		wecodeart( 'blocks' )->register( 'woocommerce/stock-filter',			Blocks\Filters\Stock::class );
		wecodeart( 'blocks' )->register( 'woocommerce/attribute-filter',		Blocks\Filters\Attribute::class );
		// Featured
		wecodeart( 'blocks' )->register( 'woocommerce/featured-product',		Blocks\Featured::class );
		wecodeart( 'blocks' )->register( 'woocommerce/featured-category',		Blocks\Featured\Category::class );
		// Product
		wecodeart( 'blocks' )->register( 'woocommerce/product-price', 			Blocks\Product\Price::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-image', 			Blocks\Product\Image::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-button', 			Blocks\Product\Button::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-rating', 			Blocks\Product\Rating::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-details',			Blocks\Product\Details::class );
		wecodeart( 'blocks' )->register( 'woocommerce/product-image-gallery',	Blocks\Product\Gallery::class );
		wecodeart( 'blocks' )->register( 'woocommerce/add-to-cart-form',		Blocks\Product\Cart::class );
		// Account
		wecodeart( 'blocks' )->register( 'woocommerce/customer-account',		Blocks\Account\Link::class );
		// Cart
		wecodeart( 'blocks' )->register( 'woocommerce/cart',								Blocks\Cart::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-cross-sells-products',			Blocks\Cart\Crossells::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary',					Blocks\Cart\Summary::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary-coupon-form',		Blocks\Cart\Summary\Coupon::class );
		wecodeart( 'blocks' )->register( 'woocommerce/cart-order-summary-shipping',			Blocks\Cart\Summary\Shipping::class );
		// Mini Cart
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart',							Blocks\Cart\Widget::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-title',						Blocks\Cart\Widget\Title::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-items',						Blocks\Cart\Widget\Items::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-footer',					Blocks\Cart\Widget\Footer::class );
		wecodeart( 'blocks' )->register( 'woocommerce/mini-cart-shopping-button',			Blocks\Cart\Widget\Button::class );
		// Checkout
		wecodeart( 'blocks' )->register( 'woocommerce/checkout',							Blocks\Checkout::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-billing-address',			Blocks\Checkout\Address::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary',				Blocks\Checkout\Summary::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary-cart-items',	Blocks\Checkout\Summary\Items::class );
		wecodeart( 'blocks' )->register( 'woocommerce/checkout-order-summary-coupon-form',	Blocks\Checkout\Summary\Coupon::class );
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
			] as $block ) {
				if( wecodeart( 'blocks' )->has( $block ) ) {
					$inline .= wecodeart( 'blocks' )->get( $block )::get_instance()->styles();
				}
			}

			$filesystem->create_file( self::CACHE_FILE, wecodeart( 'styles' )::compress( $inline ) );
			set_transient( self::CACHE_KEY, true, 5 * MINUTE_IN_SECONDS );
		}
		$filesystem->set_folder( '' );
	}
}
