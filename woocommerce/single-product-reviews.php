<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'wp-block-separator' );
} );

wecodeart( 'styles' )->Utilities->load( [
	'position-sticky', 
	'span-lg-2',
	'span-lg-1',
	'span-3',
	'my-3',
	'mb-3',
	'me-1',
	'fw-500'
] );

?>
<div id="reviews" class="woocommerce-reviews grid" style="--wp--columns:3;--wp--style--block-gap:2.5rem;">
	<div class="span-3 span-lg-2" id="comments">
		<h3 class="woocommerce-reviews-title fw-500 mb-3">
		<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'woocommerce' );
			}
		?>
		</h3>
		<hr class="wp-block-separator is-style-wide has-accent-background-color my-3">
		<?php if ( have_comments() ) : ?>
		<ol class="commentlist list-unstyled">
			<?php

			wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', [
				'callback' 	=> 'woocommerce_comments',
				'type'		=> 'review',
			] ) );

			?>
		</ol>
		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
		?>
		<?php else : ?>
		<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	</div>
	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
	<div class="span-3 span-lg-1" id="review_form_wrapper">
		<div class="position-sticky" id="review_form" style="top:90px;">
			<?php
			$commenter	= wp_get_current_commenter();
			$required 	= (bool) get_option( 'require_name_email', 1 );

			$comment_form = [
				/* translators: %s is product title */
				'title_reply'         	=> have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
				/* translators: %s is product title */
				'title_reply_to'      	=> esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
				'title_reply_before'  	=> '<h3 id="reply-title" class="comment-reply-title fw-500 mb-3">',
				'title_reply_after'   	=> '</h3><hr class="wp-block-separator is-style-wide has-accent-background-color my-3" />',
				'comment_notes_after' 	=> '',
				'label_submit'        	=> esc_html__( 'Submit', 'woocommerce' ),
				'class_submit'			=> 'comment-form-submit wp-block-button__link has-primary-background-color',
				'submit_field'			=> '<div class="comment-form-field wp-block-button">%1$s %2$s</div>',
				'submit_button'			=> '<button name="%1$s" type="submit" id="%2$s" class="%3$s">' . wecodeart( 'markup' )->SVG::compile( 'comment-dots', [
					'class' => 'me-1'
				] ) . '<span>%4$s</span></button>',
				'logged_in_as'        	=> '',
				'comment_field'       	=> '',
			];

			$fields              = [
				'author' => array(
					'label'    => __( 'Name', 'woocommerce' ) . ( $required ? ' *' : '' ),
					'type'     => 'text',
					'value'    => $commenter['comment_author'],
				),
				'email'  => array(
					'label'    => __( 'Email', 'woocommerce' ) . ( $required ? ' *' : '' ),
					'type'     => 'email',
					'value'    => $commenter['comment_author_email'],
				),
			];

			$comment_form['fields'] = [];

			foreach ( $fields as $key => $field ) {
				$comment_form['fields'][ $key ] = wecodeart( 'markup' )::wrap( 'comment-author-' . $key, [ [
					'tag' 	=> 'div',
					'attrs' => [
						'class' => 'comment-form-field comment-form-' . $key . ' my-3'
					]
				] ], 'wecodeart_input', [ 'floating', [
					'type' 	=> $field['type'],
					'label' => $field['label'],
					'attrs' => [
						'id' 			=> 'comment-' . $key,
						'name' 			=> $key,
						'size' 			=> 30,
						'maxlength' 	=> 100,
						'value' 		=> $field['value'],
						'placeholder'	=> $field['label'],
						'required' 		=> ( $required ) ? 'required' : NULL,
					]
				] ], false );
			}

			$account_page_url = wc_get_page_permalink( 'myaccount' );
			if ( $account_page_url ) {
				/* translators: %s opening and closing link tags respectively */
				$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
			}

			if ( wc_review_ratings_enabled() ) {
				$comment_form['comment_field'] = '<div class="comment-form-field comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
					<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
					<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
					<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
					<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
					<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
					<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
				</select></div>';
			}

			$comment_form['comment_field'] .= wecodeart( 'markup' )::wrap( 'comment-author-comment', [ [
				'tag' 	=> 'div',
				'attrs' => [
					'class' => 'comment-form-field comment-form-comment mb-3'
				]
			] ], 'wecodeart_input', [ 'floating', [
				'type'	=> 'textarea',
				'label' => __( 'Your review', 'woocommerce' ),
				'attrs' => [
					'id' 	=> 'comment',
					'name' 	=> 'comment',
					'style'	=> 'min-height:150px;',
					'rows'	=> 8,
					'placeholder'	=> esc_html__( 'Comment *', 'woocommerce' ),
					'required' 		=> 'required'
				]
			] ], false );

			comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

			?>
		</div>
	</div>
	<?php else : ?>
	<div class="span-3 span-lg-1">
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	</div>
	<?php endif; ?>
</div>
