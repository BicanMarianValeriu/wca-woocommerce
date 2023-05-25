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
			'categories' 	=> [ 'wecodeart', 'wecodeart/elements' ],
			'inserter'		=> false,
			'content'		=> serialize_blocks( parse_blocks( '
				<!-- wp:woocommerce/product-image {"saleBadgeAlign":"left","isDescendentOfQueryLoop":true} /-->
				<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}},"fontSize":"normal","__woocommerceNamespace":"woocommerce/product-query/product-title"} /-->
				<!-- wp:woocommerce/product-price {"textAlign":"center","isDescendentOfQueryLoop":true} /-->
				<!-- wp:woocommerce/product-rating {"textAlign":"center","isDescendentOfQueryLoop":true } /-->
				<!-- wp:woocommerce/product-button {"textAlign":"center","isDescendentOfQueryLoop":true} /-->
			' ) )
		] );

		register_block_pattern( 'wecodeart/query-products', [
			'title' 		=> esc_html__( 'Query (Products)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart', 'wecodeart-query' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> serialize_blocks( parse_blocks( '
				<!-- wp:woocommerce/filter-wrapper {"filterType":"active-filters","heading":"' . esc_html__( 'Active Filters', 'wca-woocommerce' ) . '"} -->
					<div class="wp-block-woocommerce-filter-wrapper">
						<!-- wp:heading {"level":3} -->
						<h3>' . esc_html__( 'Active Filters', 'wca-woocommerce' ) . '</h3>
						<!-- /wp:heading -->
						<!-- wp:woocommerce/active-filters {"displayStyle":"chips","heading":""} -->
						<div class="wp-block-woocommerce-active-filters is-loading" data-display-style="chips" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-active-filters__placeholder"></span></div>
						<!-- /wp:woocommerce/active-filters -->
					</div>
                <!-- /wp:woocommerce/filter-wrapper -->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
				<div class="wp-block-group">
					<!-- wp:woocommerce/product-results-count /-->
					<!-- wp:woocommerce/catalog-sorting {"fontSize":""} /-->
				</div>
				<!-- /wp:group -->
				<!-- wp:query {"query":{"perPage":9,"pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"__woocommerceAttributes":[],"__woocommerceStockStatus":["outofstock","onbackorder","instock"],"__woocommerceOnSale":false,"parents":[],"taxQuery":null},"displayLayout":{"type":"flex","columns":3},"namespace":"woocommerce/product-query"} -->
				<div class="wp-block-query">
					<!-- wp:post-template {"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
					<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
					<!-- /wp:post-template -->
					
					<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
					<!-- wp:query-pagination-previous /-->
					<!-- wp:query-pagination-numbers /-->
					<!-- wp:query-pagination-next /-->
					<!-- /wp:query-pagination -->
				
					<!-- wp:query-no-results -->
					<!-- wp:pattern {"slug":"woocommerce/no-products-found"} /-->
					<!-- /wp:query-no-results -->
				</div>
				<!-- /wp:query -->
			' ) )
		] );

		register_block_pattern( 'wecodeart/query-products-search', [
			'title' 		=> esc_html__( 'Query (Products - Search)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart', 'wecodeart-query' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> serialize_blocks( parse_blocks( '
				<!-- wp:query {"className":"wc-block-grid has-multiple-rows has-aligned-buttons","query":{"perPage":"12","pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"__woocommerceStockStatus":["instock","outofstock","onbackorder"]},"displayLayout":{"type":"flex","columns":4},"namespace":"woocommerce/product-query","layout":{"type":"default"}} -->
				<div class="wp-block-query wc-block-grid has-multiple-rows has-aligned-buttons">
					<!-- wp:post-template {"className":"wc-block-grid__listing","__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
					<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
					<!-- /wp:post-template -->
					
					<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
					<!-- wp:query-pagination-previous /-->
					<!-- wp:query-pagination-numbers /-->
					<!-- wp:query-pagination-next /-->
					<!-- /wp:query-pagination -->

					<!-- wp:query-no-results -->
					<!-- wp:pattern {"slug":"woocommerce/no-products-found"} /-->
					<!-- wp:pattern {"slug":"woocommerce/product-search-form"} /-->
					<!-- /wp:query-no-results -->
				</div>
				<!-- /wp:query -->
			' ) )
		] );
		
		register_block_pattern( 'wecodeart/query-products-tax', [
			'title' 		=> esc_html__( 'Query (Products - Taxonomy)', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart', 'wecodeart-query' ],
			'blockTypes' 	=> [ 'core/query' ],
			'inserter'		=> false,
			'content'		=> serialize_blocks( parse_blocks( '
				<!-- wp:query-title {"type":"archive","className":"mb-0"} /-->
				<!-- wp:term-description {"className":"mb-5"} /-->
				<!-- wp:separator {"backgroundColor":"light","className":"is-style-wide"} -->
				<hr class="wp-block-separator has-text-color has-light-color has-alpha-channel-opacity has-light-background-color has-background is-style-wide"/>
				<!-- /wp:separator -->
				<!-- wp:pattern {"slug":"wecodeart/query-products"} /-->
			' ) )
		] );
		
		register_block_pattern( 'wecodeart/section-related-products', [
			'title' 		=> esc_html__( 'Related Products', 'wca-woocommerce' ),
			'categories' 	=> [ 'wecodeart', 'wecodeart-query' ],
			'blockTypes' 	=> [ 'core/query' ],
			'content'		=> serialize_blocks( parse_blocks( '
				<!-- wp:woocommerce/related-products -->
				<div class="wp-block-woocommerce-related-products">
					<!-- wp:heading {"textAlign":"center"} -->
					<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Related Products', 'wca-woocommerce' ) . '</h2>
					<!-- /wp:heading -->
					<!-- wp:separator {"backgroundColor":"accent","className":"is-style-faded"} -->
					<hr class="wp-block-separator has-text-color has-accent-color has-alpha-channel-opacity has-accent-background-color has-background is-style-faded" />
					<!-- /wp:separator -->
					<!-- wp:query {"queryId":0,"query":{"perPage":"4","pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"title","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":4},"namespace":"woocommerce/related-products","lock":{"remove":true,"move":true},"layout":{"type":"constrained"}} -->
					<div class="wp-block-query">
						<!-- wp:post-template {"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
						<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->
						<!-- /wp:post-template -->
					</div>
					<!-- /wp:query -->
				</div>
				<!-- /wp:woocommerce/related-products -->
			' ) )
		] );
	}
}
