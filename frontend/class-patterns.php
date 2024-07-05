<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Patterns
 */

namespace WCA\EXT\WOO\Frontend;

use WeCodeArt\Singleton;

/**
 * Patterns
 */
class Patterns {

	use Singleton;

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since	unknown
	 */
	public function register() {
		register_block_pattern( 'wecodeart/el-product-loop', [
			'title' 		=> esc_html__( 'Product Item', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/product-image {"saleBadgeAlign":"left","imageSizing":"cropped","isDescendentOfQueryLoop":true} /-->
				<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal","__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
				<!-- wp:woocommerce/product-rating {"isDescendentOfQueryLoop":true,"textAlign":"center"} /-->
				<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} /-->
				<!-- wp:woocommerce/product-button {"textAlign":"center","isDescendentOfQueryLoop":true} /-->
			'
		] );

		register_block_pattern( 'wecodeart/query-products', [
			'title' 		=> esc_html__( 'Query (Products)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/filter-wrapper {"filterType":"active-filters","heading":"' . esc_html__( 'Active Filters', 'wca-woocommerce' ) . '"} -->
				<div class="wp-block-woocommerce-filter-wrapper">
					<!-- wp:heading {"level":4,"className":"text-uppercase fw-700"} -->
					<h4 class="wp-block-heading text-uppercase fw-700">' . esc_html__( 'Active Filters', 'wca-woocommerce' ) . '</h4>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/active-filters {"displayStyle":"chips","heading":""} -->
					<div class="wp-block-woocommerce-active-filters is-loading" data-display-style="chips" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-active-filters__placeholder"></span></div>
					<!-- /wp:woocommerce/active-filters -->
				</div>
                <!-- /wp:woocommerce/filter-wrapper -->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"},"className":"flex-column flex-md-row align-items-start"} -->
				<div class="wp-block-group flex-column flex-md-row align-items-start">
					<!-- wp:woocommerce/product-results-count /-->
					<!-- wp:woocommerce/catalog-sorting {"fontSize":""} /-->
				</div>
				<!-- /wp:group -->

				<!-- wp:woocommerce/product-collection {"queryId":0,"query":{"woocommerceAttributes":[],"woocommerceStockStatus":["outofstock","onbackorder","instock"],"woocommerceOnSale":false,"taxQuery":null,"isProductCollectionBlock":true,"perPage":1,"pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"parents":[]},"tagName":"div","displayLayout":{"type":"flex","columns":3,"shrinkColumns":false},"style":{"spacing":{"blockGap":"var:preset|spacing|md"}}} -->
				<div class="wp-block-woocommerce-product-collection">
					<!-- wp:woocommerce/product-template -->
					<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
					<!-- /wp:woocommerce/product-template -->
					<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
					<!-- wp:query-pagination-numbers /-->
					<!-- /wp:query-pagination -->
					<!-- wp:query-no-results -->
					<!-- wp:pattern {"slug":"woocommerce/no-products-found"} /-->
					<!-- /wp:query-no-results -->
				</div>
				<!-- /wp:woocommerce/product-collection -->
			'
		] );
		
		register_block_pattern( 'wecodeart/query-products-tax', [
			'title' 		=> esc_html__( 'Query (Products - Taxonomy)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:query-title {"type":"archive","className":"mb-0"} /-->
				<!-- wp:term-description {"className":"mb-5"} /-->
				<!-- wp:separator {"backgroundColor":"light","className":"is-style-wide"} -->
				<hr class="wp-block-separator has-text-color has-light-color has-alpha-channel-opacity has-light-background-color has-background is-style-wide"/>
				<!-- /wp:separator -->
				<!-- wp:pattern {"slug":"wecodeart/query-products"} /-->
			'
		] );
	
		register_block_pattern( 'wecodeart/query-products-related', [
			'title' 		=> apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'woocommerce' ) ),
			'categories' 	=> [ 'wecodeart' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/related-products -->
				<div class="wp-block-woocommerce-related-products">
					<!-- wp:query {"queryId":0,"query":{"perPage":"4","pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false},"namespace":"woocommerce/related-products","lock":{"remove":true,"move":true},"layout":{"type":"constrained"}} -->
					<div class="wp-block-query">
						<!-- wp:heading {"level":3,"className":"fw-500"} -->
						<h3 class="wp-block-heading fw-500">' . apply_filters( 'woocommerce_product_related_products_heading', esc_html__( 'Related products', 'woocommerce' ) ) . '</h3>
						<!-- /wp:heading -->
						<!-- wp:post-template {"className":"wp-block-query__products grid","layout":{"type":"grid","columnCount":4},"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
						<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
						<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->
				</div>
				<!-- /wp:woocommerce/related-products -->
			'
		] );

		register_block_pattern( 'wecodeart/catalog-filters', [
			'title' 		=> esc_html__( 'Filters', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/filter-wrapper {"filterType":"price-filter","heading":"' . esc_html__( 'Price filter', 'wca-woocommerce' ) . '"} -->
				<div class="wp-block-woocommerce-filter-wrapper">
					<!-- wp:heading {"level":5,"className":"fw-700","fontSize":"normal"} -->
					<h5 class="has-normal-font-size fw-700">' . esc_html__( 'Price filter', 'wca-woocommerce' ) . '</h5>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/price-filter {"heading":"","lock":{"remove":true}} -->
					<div class="wp-block-woocommerce-price-filter is-loading" data-showinputfields="true" data-showfilterbutton="false" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-categories__placeholder"></span></div>
					<!-- /wp:woocommerce/price-filter -->
				</div>
				<!-- /wp:woocommerce/filter-wrapper -->
				
				<!-- wp:woocommerce/filter-wrapper {"filterType":"attribute-filter","heading":"' . esc_html__( 'Color filter', 'wca-woocommerce' ) . '"} -->
				<div class="wp-block-woocommerce-filter-wrapper">
					<!-- wp:heading {"level":5,"className":"fw-700","fontSize":"normal"} -->
					<h5 class="has-normal-font-size fw-700">' . esc_html__( 'Color filter', 'wca-woocommerce' ) . '</h5>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/attribute-filter {"attributeId":1,"heading":"","displayStyle":"dropdown","lock":{"remove":true}} -->
					<div class="wp-block-woocommerce-attribute-filter is-loading" data-attribute-id="1" data-show-counts="true" data-query-type="or" data-heading="" data-heading-level="3" data-display-style="dropdown"><span aria-hidden="true" class="wc-block-product-attribute-filter__placeholder"></span></div>
					<!-- /wp:woocommerce/attribute-filter -->
				</div>
				<!-- /wp:woocommerce/filter-wrapper -->
				
				<!-- wp:woocommerce/filter-wrapper {"filterType":"stock-filter","heading":"' . esc_html__( 'Stock filter', 'wca-woocommerce' ) . '"} -->
				<div class="wp-block-woocommerce-filter-wrapper">
					<!-- wp:heading {"level":5,"className":"fw-700","fontSize":"normal"} -->
					<h5 class="has-normal-font-size fw-700">' . esc_html__( 'Stock filter', 'wca-woocommerce' ) . '</h5>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/stock-filter {"heading":"","lock":{"remove":true}} -->
					<div class="wp-block-woocommerce-stock-filter is-loading" data-show-counts="true" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-product-stock-filter__placeholder"></span></div>
					<!-- /wp:woocommerce/stock-filter -->
				</div>
				<!-- /wp:woocommerce/filter-wrapper -->
				
				<!-- wp:woocommerce/filter-wrapper {"filterType":"rating-filter"} -->
				<div class="wp-block-woocommerce-filter-wrapper">
					<!-- wp:heading {"level":5,"className":"fw-700","fontSize":"normal"} -->
					<h5 class="has-normal-font-size fw-700">' . esc_html__( 'Rating filter', 'wca-woocommerce' ) . '</h5>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/rating-filter {"lock":{"remove":true}} -->
					<div class="wp-block-woocommerce-rating-filter is-loading" data-show-counts="true">
						<span aria-hidden="true" class="wc-block-product-rating-filter__placeholder"></span>
					</div>
					<!-- /wp:woocommerce/rating-filter -->
				</div>
				<!-- /wp:woocommerce/filter-wrapper -->
			'
		] );
		
		register_block_pattern( 'wecodeart/section-products', [
			'title' 		=> esc_html__( 'Query (Products - Section)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'content'		=> '
				<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg","right":"var:preset|spacing|g","left":"var:preset|spacing|g"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--g);padding-bottom:var(--wp--preset--spacing--lg);padding-left:var(--wp--preset--spacing--g)">
					<!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false,"__woocommerceAttributes":[],"__woocommerceStockStatus":["instock","outofstock","onbackorder"]},"displayLayout":{"type":"flex","columns":4},"namespace":"woocommerce/product-query"} -->
					<div class="wp-block-query">
					<!-- wp:post-template {"className":"wp-block-query__products","layout":{"type":"grid","columnCount":3},"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
					<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
					<!-- /wp:post-template -->
					
					<!-- wp:query-pagination {"className":"mt-3","layout":{"type":"flex","justifyContent":"center"}} -->
					<!-- wp:query-pagination-numbers /-->
					<!-- /wp:query-pagination -->
					
					<!-- wp:query-no-results -->
					<!-- wp:pattern {"slug":"woocommerce/no-products-found"} /-->
					<!-- /wp:query-no-results -->
					</div>
					<!-- /wp:query -->
				</div>
				<!-- /wp:group -->
			'
		] );

		register_block_pattern( 'wecodeart/page-cart', [
			'title' 		=> esc_html__( 'Cart', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/cart {"align":""} -->
				<div class="wp-block-woocommerce-cart is-loading">
					<!-- wp:woocommerce/filled-cart-block -->
					<div class="wp-block-woocommerce-filled-cart-block">
						<!-- wp:woocommerce/cart-items-block -->
						<div class="wp-block-woocommerce-cart-items-block">
							<!-- wp:woocommerce/cart-line-items-block -->
							<div class="wp-block-woocommerce-cart-line-items-block"></div>
							<!-- /wp:woocommerce/cart-line-items-block -->
							<!-- wp:woocommerce/cart-cross-sells-block -->
							<div class="wp-block-woocommerce-cart-cross-sells-block">
								<!-- wp:separator {"backgroundColor":"accent","className":"my-5 is-style-wide"} -->
								<hr class="wp-block-separator has-text-color has-accent-color has-alpha-channel-opacity has-accent-background-color has-background my-5 is-style-wide" />
								<!-- /wp:separator -->
								<!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"large"} -->
								<h2 class="wp-block-heading has-large-font-size" style="font-style:normal;font-weight:500">' . esc_html__( 'You might also like', 'wca-woocommerce' ) . '</h2>
								<!-- /wp:heading -->
								<!-- wp:woocommerce/cart-cross-sells-products-block -->
								<div class="wp-block-woocommerce-cart-cross-sells-products-block"></div>
								<!-- /wp:woocommerce/cart-cross-sells-products-block -->
							</div>
							<!-- /wp:woocommerce/cart-cross-sells-block -->
						</div>
						<!-- /wp:woocommerce/cart-items-block -->
						<!-- wp:woocommerce/cart-totals-block -->
						<div class="wp-block-woocommerce-cart-totals-block">
							<!-- wp:woocommerce/cart-order-summary-block -->
							<div class="wp-block-woocommerce-cart-order-summary-block">
								<!-- wp:woocommerce/cart-order-summary-heading-block {"content":"' . esc_html__( 'Cart Total', 'wca-woocommerce' ) . '"} -->
								<div class="wp-block-woocommerce-cart-order-summary-heading-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-heading-block -->
								<!-- wp:woocommerce/cart-order-summary-coupon-form-block -->
								<div class="wp-block-woocommerce-cart-order-summary-coupon-form-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-coupon-form-block -->
								<!-- wp:woocommerce/cart-order-summary-subtotal-block -->
								<div class="wp-block-woocommerce-cart-order-summary-subtotal-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-subtotal-block -->
								<!-- wp:woocommerce/cart-order-summary-fee-block -->
								<div class="wp-block-woocommerce-cart-order-summary-fee-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-fee-block -->
								<!-- wp:woocommerce/cart-order-summary-discount-block -->
								<div class="wp-block-woocommerce-cart-order-summary-discount-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-discount-block -->
								<!-- wp:woocommerce/cart-order-summary-shipping-block -->
								<div class="wp-block-woocommerce-cart-order-summary-shipping-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-shipping-block -->
								<!-- wp:woocommerce/cart-order-summary-taxes-block -->
								<div class="wp-block-woocommerce-cart-order-summary-taxes-block"></div>
								<!-- /wp:woocommerce/cart-order-summary-taxes-block -->
							</div>
							<!-- /wp:woocommerce/cart-order-summary-block -->
							<!-- wp:woocommerce/cart-express-payment-block -->
							<div class="wp-block-woocommerce-cart-express-payment-block"></div>
							<!-- /wp:woocommerce/cart-express-payment-block -->
							<!-- wp:woocommerce/proceed-to-checkout-block -->
							<div class="wp-block-woocommerce-proceed-to-checkout-block"></div>
							<!-- /wp:woocommerce/proceed-to-checkout-block -->
							<!-- wp:woocommerce/cart-accepted-payment-methods-block -->
							<div class="wp-block-woocommerce-cart-accepted-payment-methods-block"></div>
							<!-- /wp:woocommerce/cart-accepted-payment-methods-block -->
						</div>
						<!-- /wp:woocommerce/cart-totals-block -->
					</div>
					<!-- /wp:woocommerce/filled-cart-block -->
					<!-- wp:woocommerce/empty-cart-block -->
					<div class="wp-block-woocommerce-empty-cart-block">
						<!-- wp:heading {"textAlign":"center","className":"with-empty-cart-icon wc-block-cart__empty-cart__title"} -->
						<h2 class="wp-block-heading has-text-align-center with-empty-cart-icon wc-block-cart__empty-cart__title">' . esc_html__( 'Your cart is empty!', 'wca-woocommerce' ) . '</h2>
						<!-- /wp:heading -->
						<!-- wp:paragraph {"align":"center"} -->
						<p class="has-text-align-center">
							<a href="#">' . esc_html__( 'Browse the store', 'wca-woocommerce' ) . '</a>
						</p>
						<!-- /wp:paragraph -->
						<!-- wp:separator {"className":"is-style-dots"} -->
						<hr class="wp-block-separator has-alpha-channel-opacity is-style-dots" />
						<!-- /wp:separator -->
						<!-- wp:heading {"textAlign":"center"} -->
						<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'New in store', 'wca-woocommerce' ) . '</h2>
						<!-- /wp:heading -->
						<!-- wp:woocommerce/product-new {"rows":1} /-->
					</div>
					<!-- /wp:woocommerce/empty-cart-block -->
				</div>
				<!-- /wp:woocommerce/cart -->
			'
		] );
		
		register_block_pattern( 'wecodeart/page-checkout', [
			'title' 		=> esc_html__( 'Checkout', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/checkout {"align":""} -->
				<div class="wp-block-woocommerce-checkout wc-block-checkout is-loading">
					<!-- wp:woocommerce/checkout-fields-block -->
					<div class="wp-block-woocommerce-checkout-fields-block">
						<!-- wp:woocommerce/checkout-express-payment-block -->
						<div class="wp-block-woocommerce-checkout-express-payment-block"></div>
						<!-- /wp:woocommerce/checkout-express-payment-block -->
						<!-- wp:woocommerce/checkout-contact-information-block -->
						<div class="wp-block-woocommerce-checkout-contact-information-block"></div>
						<!-- /wp:woocommerce/checkout-contact-information-block -->
						<!-- wp:woocommerce/checkout-shipping-method-block -->
						<div class="wp-block-woocommerce-checkout-shipping-method-block"></div>
						<!-- /wp:woocommerce/checkout-shipping-method-block -->
						<!-- wp:woocommerce/checkout-pickup-options-block -->
						<div class="wp-block-woocommerce-checkout-pickup-options-block"></div>
						<!-- /wp:woocommerce/checkout-pickup-options-block -->
						<!-- wp:woocommerce/checkout-shipping-address-block -->
						<div class="wp-block-woocommerce-checkout-shipping-address-block"></div>
						<!-- /wp:woocommerce/checkout-shipping-address-block -->
						<!-- wp:woocommerce/checkout-billing-address-block -->
						<div class="wp-block-woocommerce-checkout-billing-address-block"></div>
						<!-- /wp:woocommerce/checkout-billing-address-block -->
						<!-- wp:woocommerce/checkout-shipping-methods-block {"description":"Lorem ipsum"} -->
						<div class="wp-block-woocommerce-checkout-shipping-methods-block"></div>
						<!-- /wp:woocommerce/checkout-shipping-methods-block -->
						<!-- wp:woocommerce/checkout-payment-block {"description":"Lorem ipsum"} -->
						<div class="wp-block-woocommerce-checkout-payment-block"></div>
						<!-- /wp:woocommerce/checkout-payment-block -->
						<!-- wp:woocommerce/checkout-order-note-block -->
						<div class="wp-block-woocommerce-checkout-order-note-block"></div>
						<!-- /wp:woocommerce/checkout-order-note-block -->
						<!-- wp:woocommerce/checkout-terms-block {"checkbox":true} -->
						<div class="wp-block-woocommerce-checkout-terms-block"></div>
						<!-- /wp:woocommerce/checkout-terms-block -->
						<!-- wp:woocommerce/checkout-actions-block -->
						<div class="wp-block-woocommerce-checkout-actions-block"></div>
						<!-- /wp:woocommerce/checkout-actions-block -->
					</div>
					<!-- /wp:woocommerce/checkout-fields-block -->
					<!-- wp:woocommerce/checkout-totals-block -->
					<div class="wp-block-woocommerce-checkout-totals-block">
						<!-- wp:woocommerce/checkout-order-summary-block -->
						<div class="wp-block-woocommerce-checkout-order-summary-block">
							<!-- wp:woocommerce/checkout-order-summary-coupon-form-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-coupon-form-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-coupon-form-block -->
							<!-- wp:woocommerce/checkout-order-summary-cart-items-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-cart-items-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-cart-items-block -->
							<!-- wp:woocommerce/checkout-order-summary-subtotal-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-subtotal-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-subtotal-block -->
							<!-- wp:woocommerce/checkout-order-summary-fee-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-fee-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-fee-block -->
							<!-- wp:woocommerce/checkout-order-summary-discount-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-discount-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-discount-block -->
							<!-- wp:woocommerce/checkout-order-summary-shipping-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-shipping-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-shipping-block -->
							<!-- wp:woocommerce/checkout-order-summary-taxes-block -->
							<div class="wp-block-woocommerce-checkout-order-summary-taxes-block"></div>
							<!-- /wp:woocommerce/checkout-order-summary-taxes-block -->
						</div>
						<!-- /wp:woocommerce/checkout-order-summary-block -->
					</div>
					<!-- /wp:woocommerce/checkout-totals-block -->
				</div>
				<!-- /wp:woocommerce/checkout -->
			'
		] );
		
		register_block_pattern( 'wecodeart/page-order-confirmation', [
			'title' 		=> esc_html__( 'Order Confirmation', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart' ],
			'inserter'		=> false,
			'content'		=> '
				<!-- wp:woocommerce/order-confirmation-status {"align":"","fontSize":"large"} /-->
				<!-- wp:woocommerce/order-confirmation-summary {"align":""} /-->
				<!-- wp:woocommerce/order-confirmation-totals-wrapper -->
					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading">' . esc_html__( 'Order details', 'woocommerce' ) . '</h3>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/order-confirmation-totals {"lock":{"remove":true}} /-->
				<!-- /wp:woocommerce/order-confirmation-totals-wrapper -->
				<!-- wp:woocommerce/order-confirmation-downloads-wrapper -->
					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading">' . esc_html__( 'Downloads', 'woocommerce' ) . '</h3>
					<!-- /wp:heading -->
					<!-- wp:woocommerce/order-confirmation-downloads {"lock":{"remove":true},"backgroundColor":"accent"} /-->
				<!-- /wp:woocommerce/order-confirmation-downloads-wrapper -->
				<!-- wp:columns {"className":""} -->
				<div class="wp-block-columns">
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:woocommerce/order-confirmation-billing-wrapper {"align":"","backgroundColor":"accent","style":{"spacing":{"padding":{"top":"var:preset|spacing|g","bottom":"var:preset|spacing|g","left":"var:preset|spacing|g","right":"var:preset|spacing|g"}},"border":{"radius":"5px"}}} -->
							<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0"}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"}},"fontSize":"normal"} -->
							<h4 class="wp-block-heading has-normal-font-size" style="margin-top:0;font-style:normal;font-weight:600;text-transform:uppercase">' . esc_html__( 'Billing address', 'woocommerce' ) . '</h4>
							<!-- /wp:heading -->
							<!-- wp:woocommerce/order-confirmation-billing-address {"lock":{"remove":true}} /-->
						<!-- /wp:woocommerce/order-confirmation-billing-wrapper -->
					</div>
					<!-- /wp:column -->
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:woocommerce/order-confirmation-shipping-wrapper {"align":"","backgroundColor":"accent","style":{"spacing":{"padding":{"top":"var:preset|spacing|g","bottom":"var:preset|spacing|g","left":"var:preset|spacing|g","right":"var:preset|spacing|g"}},"border":{"radius":"5px"}}} -->
							<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0"}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"}},"fontSize":"normal"} -->
							<h4 class="wp-block-heading has-normal-font-size" style="margin-top:0;font-style:normal;font-weight:600;text-transform:uppercase">' . esc_html__( 'Shipping address', 'woocommerce' ) . '</h4>
							<!-- /wp:heading -->
							<!-- wp:woocommerce/order-confirmation-shipping-address {"lock":{"remove":true}} /-->
						<!-- /wp:woocommerce/order-confirmation-shipping-wrapper -->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
				<!-- wp:woocommerce/order-confirmation-additional-information {"align":""} /-->
			'
		] );
	}
}
