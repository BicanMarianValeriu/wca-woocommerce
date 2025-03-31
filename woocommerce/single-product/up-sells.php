<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

use function WeCodeArt\Functions\toJSON;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) :

	$json_args = toJSON( [
		'queryId' 	=> 7,
		'query' 	=> [
			'perPage' 	=> apply_filters( 'woocommerce_product_upsells_columns', 4 ),
			'pages' 	=> 1,
			'offset' 	=> 0,
			'postType' 	=> 'product',
			'order' 	=> 'asc',
			'orderBy' 	=> 'title',
			'search' 	=> '',
			'exclude' 	=> [],
			'taxQuery' 	=> [],
			'inherit' 	=> false,
			'featured' 	=> false,
			'filterable'=> false,
			'relatedBy'	=> [
				'categories' 	=> true,
				'tags' 			=> true,
			],
			'isProductCollectionBlock' 	=> true,
			'woocommerceOnSale' 		=> false,
			'woocommerceStockStatus' 	=> [ 'instock', 'outofstock', 'onbackorder' ],
			'woocommerceAttributes' 	=> [],
			'woocommerceHandPickedProducts' => [],
		],
		'tagName' 		=> 'div',
		'displayLayout' => [
			'type' 			=> 'flex',
			'columns' 		=> apply_filters( 'woocommerce_product_upsells_columns', 4 ),
			'shrinkColumns' => true,
		],
		'dimensions' 	=> [
			'widthType' => 'fill',
		],
		'collection' 	=> 'woocommerce/product-collection/upsells',
		'hideControls' 	=> [ 'inherit', 'filterable' ],
		'queryContextIncludes' => [ 'collection' ],
	] );

	$heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

	$template = '<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"blockGap":"var:preset|spacing|md"}}} -->';
	$template .= '<div class="wp-block-group">';
	$template .= '<!-- wp:woocommerce/product-collection ' . $json_args . ' -->';
	if( $heading ) :
	$template .= '<!-- wp:heading {"level":3} -->';
	$template .= '<h3 class="wp-block-heading">' . $heading . '</h3>';
	$template .= '<!-- /wp:heading -->';
	endif;
	$template .= '<!-- wp:woocommerce/product-template -->';
	$template .= '<!-- wp:pattern {"slug":"wecodeart/el-product-loop"} /-->';
	$template .= '<!-- /wp:woocommerce/product-template -->';
	$template .= '<!-- /wp:woocommerce/product-collection -->';
	$template .= '</div>';
	$template .= '<!-- /wp:group -->';

	echo do_blocks( $template );

endif;
