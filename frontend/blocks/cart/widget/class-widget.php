<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Widget
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_action;
use function add_filter;
use function WeCodeArt\Functions\get_prop;

use \LiteSpeed\Tag;
use \LiteSpeed\Conf;
use \LiteSpeed\Base as LSBase;

/**
 * Gutenberg Mini Cart block.
 */
class Widget extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart';

	const ESI_TAG = 'woo_mini_cart';
	const COOKIES = [ 'woocommerce_cart_hash' ];

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		if ( apply_filters( 'litespeed_esi_status', false ) ) {
			add_action( 'litespeed_tpl_normal', 					__CLASS__ . '::is_not_esi' );
			add_action( 'litespeed_esi_load-' . self::ESI_TAG, 		__CLASS__ . '::esi_load' );
			add_filter( 'litespeed_esi_inline-' . self::ESI_TAG,	__CLASS__ . '::esi_inline',	20, 2 );
			add_filter( 'litespeed_vary_curr_cookies', 				__CLASS__ . '::check_cookies' ); 
			add_filter( 'litespeed_vary_cookies', 					__CLASS__ . '::register_cookies' ); 

			add_action( 'woocommerce_ajax_added_to_cart',			__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_add_to_cart',					__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_cart_item_removed',			__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_cart_item_restored',			__CLASS__ . '::esi_purge' );
		}
	}

	/**
	 * Hooked to the litespeed_tpl_normal action.
	 */
	public static function is_not_esi() {
		add_filter( 'render_block_woocommerce/mini-cart', __CLASS__ . '::esi_render', 30, 2 );
	}

	/**
	 * Filter Render
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public static function esi_render( string $content = '', array $block = [] ): string {		
		$params = [
			'block'	=> $block
		];

		$inline_tags = self::esi_tags();
		
		do_action( 'litespeed_esi_combine', self::ESI_TAG );
		
		$inline = [
			'val'		=> $content,
			'tag'		=> $inline_tags,
			'control' 	=> 'private,no-vary,max-age=' . Conf::cls()->conf( LSBase::O_CACHE_TTL_PRIV ),
		];

		return apply_filters( 'litespeed_esi_url', self::ESI_TAG, 'WOO MINI CART', $params, 'private,no-vary', false, true, true, $inline );
	}

	/**
	 * Generate ESI inline value
	 *
	 * @return 	array
	 */
	public static function esi_inline( $res, $params ) {
		if ( ! is_array( $res ) ) {
			$res = [];
		}

		$res['val'] 	= render_block( get_prop( $params, [ 'block' ], [] ) );
		$res['control'] = 'private,no-vary,max-age=' . Conf::cls()->conf( LSBase::O_CACHE_TTL_PRIV );
		$res['tag'] 	= self::esi_tags();

		return $res;
	}

	/**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public static function esi_load( $params ) {
		// Remove actions due to render block filter being called.
		remove_all_actions( 'litespeed_esi_load-' . self::ESI_TAG );
		remove_all_filters( 'litespeed_esi_inline-' . self::ESI_TAG );

		echo render_block( get_prop( $params, 'block', [] ) );
		
		do_action( 'litespeed_control_set_private', self::ESI_TAG );
		do_action( 'litespeed_vary_no' );
	}

	/**
	 * Inline ESI Tags
	 * 
	 * @return 	string
	 */
	public static function esi_tags(): string {
		$inline_tags = [ '', rtrim( Tag::TYPE_ESI, '.' ), Tag::TYPE_ESI . self::ESI_TAG ];
		$inline_tags = implode( ',', array_map( fn( $val ) => 'public:' . LSWCP_TAG_PREFIX . '_' . $val, $inline_tags ) );
		$inline_tags .= ',' . LSWCP_TAG_PREFIX . '_tag_priv';

		return $inline_tags;
	}

	/**
	 * Purge Cache
	 */
	public static function esi_purge() {
		do_action( 'litespeed_purge_all' );
		do_action( 'litespeed_purge_esi', self::ESI_TAG );
		do_action( 'litespeed_purge_private_esi', self::ESI_TAG );
	}

	/**
	 * Cookies
	 *
	 * @param	array	$list
	 *
	 * @return	array	$list
	 */
	public static function check_cookies( array $list = [] ): array {
		if ( ! is_woocommerce() ) {
			return $list;
		}

		return array_merge( $list, self::COOKIES );
	}

	public static function register_cookies( array $list = [] ): array {
		return array_merge( $list, self::COOKIES );
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wc-blocks-style-cart-dep', [
			'load'		=> function( $blocks ) {			
				if( wp_style_is( 'wc-blocks-style-cart' ) || wp_style_is( 'wc-blocks-style-cart-dep' ) ) {
					return false;
				}

				// Global
				return true;
			},
			'inline'	=> wecodeart( 'blocks' )->get( 'woocommerce/cart' )::get_instance()->styles()
		] );
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-mini-cart {
				display: inline-flex;
				flex-direction: column;
				justify-content: center;
			}
			.wc-block-mini-cart[aria-hidden=true] {
				display: none;
			}
			.wc-block-mini-cart__button {
				display: flex;
				align-items: center;
				background-color: transparent;
				border: none;
				color: inherit;
				font-size: inherit;
				font-family: inherit;
				padding: 0.5em 0;
				cursor: pointer;
			}
			.modal-open .wc-block-mini-cart__button {
				pointer-events: none;
			}
			.wc-block-mini-cart__amount {
				display: none;
			}
			.wc-block-mini-cart__quantity-badge {
				display: flex;
				align-items: center;
			}
			.wc-block-mini-cart__badge {
				display: flex;
				align-items: center;
				justify-content: center;
				background: var(--wp--preset--color--danger);
				border: 1px solid var(--wp--preset--color--danger);
				border-radius: 0.2em;
				color: var(--wp--preset--color--white);
				font-size: var(--wp--preset--font-size--small);
				height: 1.2em;
				min-width: 1em;
				margin-left: -0.65em;
				padding: 0.2em;
				transform: translateY(-50%);
				white-space: nowrap;
				z-index: 1;
			}
			.wc-block-mini-cart__badge:empty {
				display: none;
			}
			.wc-block-mini-cart__icon {
				display: block;
				height: 1.25em;
				width: 1.25em;
				transform: scale(1.35);
			}
			html[dir=rtl] .wc-block-mini-cart__icon {
				transform: scaleX(-1);
			}
			.wc-block-mini-cart__tax-label {
				margin-right: 1em;
			}
			.wc-block-mini-cart__drawer {
				font-size: 1rem;
			}
	
			@media screen and (min-width: 768px) {
				.wc-block-mini-cart__amount {
					display: initial;
					margin-right: 0.75em;
				}
			}
		';
	}
}
