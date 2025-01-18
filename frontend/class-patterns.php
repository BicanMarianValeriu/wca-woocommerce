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
				<!-- wp:woocommerce/product-image {"saleBadgeAlign":"left","imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"height":"300px"} /-->
				<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal","__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
				<!-- wp:woocommerce/product-rating {"isDescendentOfQueryLoop":true,"textAlign":"center"} /-->
				<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} /-->
				<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"textAlign":"center","style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} /-->
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
						<!-- wp:post-template {"className":"wp-block-query__products","layout":{"type":"grid","columnCount":4},"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
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
	}
}
