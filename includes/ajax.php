<?php
// What we do?
define( 'DOING_AJAX', true );

// Only for our requests
if ( ! filter_input( INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) ) {
    die( '-1' );
}

// Hide any errors
ini_set( 'html_errors', 0 );

// Tell WordPress to load as little as possible
define( 'SHORTINIT', true );

// Load minimal
$path = explode( 'wp-content', __FILE__ );
if ( is_file( reset( $path ) . 'wp-load.php' ) ) {
	require_once( reset( $path ) . 'wp-load.php' );
} else {
	die( '-1' );
}

// Extra Security
$action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$allowed_actions = apply_filters( 'wecodeart/filter/woocommerce/reviews/ajax/actions', [ 'user', 'like', 'comment', 'review', 'query' ] );

if( ! in_array( $action, $allowed_actions, true ) ) {
    die( '-1' );
}

// Typical Headers
header( 'Content-Type: text/html' );
send_nosniff_header();

// Disable Caching
header( 'Cache-Control: no-cache' );
header( 'Pragma: no-cache' );

// Constants
wp_plugin_directory_constants();
wp_functionality_constants();
wp_cookie_constants();
wp_ssl_constants();

// Default Data
$data = [];

function __require_user() {
    require_once( ABSPATH . WPINC . '/user.php' );
    require_once( ABSPATH . WPINC . '/l10n.php' );
    require_once( ABSPATH . WPINC . '/kses.php' );
    require_once( ABSPATH . WPINC . '/rest-api.php' );
    require_once( ABSPATH . WPINC . '/pluggable.php' );
    require_once( ABSPATH . WPINC . '/capabilities.php' );
    require_once( ABSPATH . WPINC . '/class-wp-session-tokens.php' );
    require_once( ABSPATH . WPINC . '/class-wp-user-meta-session-tokens.php' );
    require_once( ABSPATH . WPINC . '/class-wp-roles.php' );
    require_once( ABSPATH . WPINC . '/class-wp-role.php' );
    require_once( ABSPATH . WPINC . '/class-wp-user.php' );
}

function __require_comment( bool $not_auth = false ) {
    // Requirements while logged in.
    require_once( ABSPATH . WPINC . '/post.php' );
    require_once( ABSPATH . WPINC . '/comment.php' );
    require_once( ABSPATH . WPINC . '/blocks.php' );
    require_once( ABSPATH . WPINC . '/taxonomy.php' );
    require_once( ABSPATH . WPINC . '/class-wp-post.php' );
    require_once( ABSPATH . WPINC . '/class-wp-comment.php' );
    require_once( ABSPATH . WPINC . '/class-wp-block-parser.php' );

    if( $not_auth ) {
        // Requirements while logged out.
        require_once( ABSPATH . WPINC . '/http.php' );
        require_once( ABSPATH . WPINC . '/link-template.php' );
        require_once( ABSPATH . WPINC . '/comment-template.php' );
        require_once( ABSPATH . WPINC . '/class-wp-http.php' );
        require_once( ABSPATH . WPINC . '/class-wp-date-query.php' );
        require_once( ABSPATH . WPINC . '/class-wp-comment-query.php' );
    }
}

switch( $action ) :

    // Setup User
    case 'user' :
        __require_user();

        if( is_user_logged_in() ) {
            $user_data  = wp_get_current_user();
            $user_data  = array_filter( (array) $user_data->data, function( $item ) {
                return in_array( $item, [ 'display_name', 'user_firstname', 'user_lastname', 'user_email' ] );
            }, ARRAY_FILTER_USE_KEY );
            
            $token = base64_encode( implode( ':', [ $user_data['display_name'], $user_data['user_email'] ] ) );
            
            $data = wp_parse_args( [
                'status'    => true,
                'token'     => $token
            ], $data );
        }
    break;

    // Working while: logged in/out (everyone can like)
    case 'like' :
        // Requirements.
        require_once( ABSPATH . WPINC . '/comment.php' );
        require_once( ABSPATH . WPINC . '/class-wp-comment.php' );

        $review_id      = filter_input( INPUT_POST, 'review_id', FILTER_SANITIZE_NUMBER_INT );
        $review_likes   = (int) get_comment_meta( $review_id, 'likes', true );
        $previous_liked = isset( $_COOKIE['wca_wooReviews_liked'] ) ? explode( ',', $_COOKIE['wca_wooReviews_liked'] ) : [];
        $previous_liked = array_map( 'intval', $previous_liked );
    
        if ( in_array( $review_id, $previous_liked ) ) {
            $like_action    = ( $review_likes - 1 );
            $previous_liked = array_diff( $previous_liked, [ $review_id ] );
        } else {
            $like_action    = ( $review_likes + 1 );
            $previous_liked = array_merge( $previous_liked, [ $review_id ] );
        }
    
        update_comment_meta( $review_id, 'likes', absint( $like_action ) );
        
        $cookie_val = implode( ',',  $previous_liked );
        setcookie( 'wca_wooReviews_liked', $cookie_val, time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
        
        $data = wp_parse_args( [
            'status'    => true,
            'likes'     => $like_action
        ], $data ); 
    break;
    
    // Working while: logged in (only users can comment)
    case 'comment' :
        // User required
        __require_user();
        // Requirements while logged in.
        __require_comment();
        // Translations are required.
        wp_load_translations_early();

        $comment = [
            'user_id'               => get_current_user_id(),
            'comment_author'        => wp_get_current_user()->display_name,
            'comment_author_email'  => wp_get_current_user()->user_email,
            'comment_author_url'    => '',
            'comment_content'       => filter_input( INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
            'comment_post_ID'       => filter_input( INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT ),
            'comment_parent'        => filter_input( INPUT_POST, 'parent', FILTER_SANITIZE_NUMBER_INT ),
            'comment_type'          => 'comment',
        ];
    
        $comment = wp_new_comment( $comment );

        clean_comment_cache( $comment );

        $message = $comment ? esc_html__( 'The comment has been sent.', 'wca-woocommerce' ) : esc_html__( 'Something went wrong.', 'wca-woocommerce' );

        $data = wp_parse_args( [
            'status'    => $comment,
            'message'   => $message
        ], $data );
    break;

    // Working while: logged in/out
    case 'review' :
        // User required
        __require_user();
        // Requirements for loggedin/out.
        __require_comment( true );
        // Extra requirements for review.
        require_once( ABSPATH . WPINC . '/shortcodes.php' );
        // Translations are required.
        wp_load_translations_early();
        // Disabled email notification to save some file requirements.
        add_filter( 'notify_post_author', '__return_false', PHP_INT_MAX );

        $review = [
            'comment_author'        => filter_input( INPUT_POST, 'reviewer', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
            'comment_author_email'  => filter_input( INPUT_POST, 'reviewer_email', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
            'comment_author_url'    => '',
            'comment_content'       => filter_input( INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
            'comment_post_ID'       => filter_input( INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT ),
            'comment_type'          => 'review',
        ];
    
        $review = wp_new_comment( $review );
    
        update_comment_meta( $review, 'title', filter_input( INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );
        update_comment_meta( $review, 'likes', 0 );
        update_comment_meta( $review, 'rating', filter_input( INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT ) );

        clean_comment_cache( $review );

        $message = $review ? esc_html__( 'The review has been sent.', 'wca-woocommerce' ) : esc_html__( 'Something went wrong.', 'wca-woocommerce' );

        $data = wp_parse_args( [
            'status'    => $review,
            'message'   => $message
        ], $data );
    break;

    // Working while: logged in/out
    case 'query':
        // Requirements while logged in.
        require_once( ABSPATH . WPINC . '/link-template.php' );
        require_once( ABSPATH . WPINC . '/comment.php' );
        require_once( ABSPATH . WPINC . '/class-wp-comment.php' );
        require_once( ABSPATH . WPINC . '/class-wp-query.php' );
        require_once( ABSPATH . WPINC . '/class-wp-comment-query.php' );

        function count_verified_reviews( int $id = 0 ) {
            if( $id === 0 ) {
                return 0;
            }

            global $wpdb;
        
            // Create the SQL query
            $sql = $wpdb->prepare("
                SELECT COUNT(*) AS total_verified_comments
                FROM {$wpdb->comments} AS c
                WHERE c.comment_post_ID = %d
                AND c.comment_ID IN (
                    SELECT comment_id
                    FROM {$wpdb->commentmeta}
                    WHERE meta_key = 'verified'
                    AND meta_value = true
                )
            ", $id );
        
            // Return the total count of comments
            return intval( $wpdb->get_var( $sql ) );
        }

        $request = array_filter( [
            'orderby'       => filter_input( INPUT_POST, 'orderby', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
            'paged'         => filter_input( INPUT_POST, 'page', FILTER_SANITIZE_NUMBER_INT ),
            'post__in'      => filter_input( INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT ),
            'comment__in'   => filter_input( INPUT_POST, 'include' ) ? array_map( 'absint', explode( ',', filter_input( INPUT_POST, 'include' ) ) ) : null,
            'search'        => filter_input( INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS ),
        ] );
    
        $prepared_args = wp_parse_args( $request, [
            'search'        => '',
            'paged'         => 1,
            'number'        => (int) get_option( 'comments_per_page' ),
            'type'          => isset( $request['comment__in'] ) ? 'comment' : 'review',
            'orderby'       => 'comment_date_gmt',
            'status'        => 'approve',
            'no_found_rows' => false,
        ] );
    
        $meta_query = [];
    
        if( $rating = filter_input( INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT ) ) {
            $meta_query[] = [
                'key'   => 'rating',
                'value' => $rating
            ];
        }
    
        if( $verified = filter_input( INPUT_POST, 'verified', FILTER_VALIDATE_BOOLEAN ) ) {
            $meta_query[] = [
                'key'   => 'verified',
                'value' => $verified,
            ];
        }
    
        if( in_array( $prepared_args['orderby'], [ 'likes', 'rating' ] ) ) {
            $prepared_args['meta_key'] 	= $prepared_args['orderby'];
            $prepared_args['orderby'] 	= 'meta_value_num';
        }
    
        if( ! empty( $meta_query ) ) {
            $prepared_args['meta_query'] = $meta_query;
        }
    
        $prepared_args = apply_filters( 'wecodeart/filter/woocommerce/reviews/ajax/query', $prepared_args );
    
        // Query reviews.
        $query        = new WP_Comment_Query();
        $query_result = $query->query( $prepared_args );
        $reviews      = [];
    
        foreach ( $query_result as $post ) {
            $reviews[] = apply_filters( 'wecodeart/filter/woocommerce/reviews/ajax/response', [
                'id'        => (int) $post->comment_ID,
                'product'   => (int) $post->comment_post_ID,
                'date'      => (string) $post->comment_date,
                'content'   => (string) wpautop( $post->comment_content ),
                'rating'    => (int) get_comment_meta( $post->comment_ID, 'rating', true ),
                'verified'  => get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ? (bool) get_comment_meta( $post->comment_ID, 'verified', true ) : null,
                'replies'   => $post->get_children() ? array_keys( (array) $post->get_children() ) : false,
                'likes'     => (int) get_comment_meta( $post->comment_ID, 'likes', true ),
                'title'     => (string) get_comment_meta( $post->comment_ID, 'title', true ),
                'author'    => [
                    'name'      => $post->comment_author,
                    'avatar'    => get_avatar_url( $post->comment_author_email, [ 'size' => 96 ] ),
                ],
            ], $post );
        } 
    
        $total      = (int) $query->found_comments;
        $pages      = (int) $query->max_num_pages;
        $verified   = count_verified_reviews( $request['post__in'] ?? 0 );
    
        if ( $total < 1 ) {
            $prepared_args['count'] = true;

            $query  = new WP_Comment_Query();
            $total  = $query->query( $prepared_args );
            $pages  = ceil( $total / (int) get_option( 'comments_per_page' ) );
        }

        $data = wp_parse_args( [
            'meta'      => [
                'totalResults'  => $total,
                'totalPages'    => $pages,
                'verified'      => $verified
            ],
            'data'      => $reviews,
            'args'      => $prepared_args
        ], $data );
    break;

endswitch;

do_action( 'wecodeart/woocommerce/reviews/ajax', $data, $action );

wp_send_json( $data );