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
use WeCodeArt\Gutenberg\Blocks\Dynamic;

use function add_action;
use function add_filter;
use function WeCodeArt\Functions\get_prop;

use \LiteSpeed\Tag;
use \LiteSpeed\Conf;
use \LiteSpeed\Base;

/**
 * Gutenberg Mini Cart block.
 */
class Widget extends Dynamic {

	use Singleton;

	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'woocommerce';

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart';

	const ESI_TAG = 'woo_mini_cart'; 

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		if ( apply_filters( 'litespeed_esi_status', false ) ) {
			add_action( 'litespeed_tpl_normal', 					__CLASS__ . '::is_not_esi' );
			add_action( 'litespeed_esi_load-' . self::ESI_TAG, 		__CLASS__ . '::esi_load' );
			add_filter( 'litespeed_esi_inline-' . self::ESI_TAG,	__CLASS__ . '::esi_inline', 20, 2 );
			
			add_action( 'woocommerce_ajax_added_to_cart',			__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_add_to_cart',					__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_cart_item_removed',			__CLASS__ . '::esi_purge' );
			add_action( 'woocommerce_cart_item_restored',			__CLASS__ . '::esi_purge' );
		}
	}

	/**
	 * Filter Render
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public static function render_block( string $content = '', array $block = [] ): string {		
		$inline = [
			'val'		=> $content,
			'tag'		=> self::esi_tags(),
			'control' 	=> 'private,no-cache',
		];

		$params = [
			'content' 	=> $content,
			'block'		=> $block
		];

		do_action( 'litespeed_esi_combine', self::ESI_TAG );

		return apply_filters( 'litespeed_esi_url', self::ESI_TAG, 'WOO_ESI_BLOCK', $params, 'private,no-cache', false, false, false, $inline );
	}

	/**
	 * Hooked to the litespeed_is_not_esi_template action.
	 */
	public static function is_not_esi() {
		add_filter( 'render_block_woocommerce/mini-cart', __CLASS__ . '::render_block', 100, 2 );
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

		remove_all_actions( 'litespeed_esi_load-' . self::ESI_TAG );
		remove_all_filters( 'litespeed_esi_inline-' . self::ESI_TAG );

		$value = render_block( get_prop( $params, 'block', [] ) );

		return wp_parse_args( [
			'val'		=> $value,
			'control' 	=> 'private,no-cache',
			'tag'		=> self::esi_tags(),
		], $res );
	}

	/**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public static function esi_load( $params ) {
		remove_all_actions( 'litespeed_esi_load-' . self::ESI_TAG );
		remove_all_filters( 'litespeed_esi_inline-' . self::ESI_TAG );

		echo render_block( get_prop( $params, 'block', [] ) );
	
		do_action( 'litespeed_control_set_private', 'woo mini cart' );
		do_action( 'litespeed_control_set_nocache' );
		// do_action( 'litespeed_vary_no' );
	}

	/**
	 * Inline ESI Tags
	 * 
	 * @return 	string
	 */
	public static function esi_tags(): string {
		$inline_tags = [ '', rtrim( Tag::TYPE_ESI, '.' ), Tag::TYPE_ESI . self::ESI_TAG ];
		$inline_tags = implode( ',', array_map( fn( $val ) => 'private:' . LSWCP_TAG_PREFIX . '_' . $val, $inline_tags ) );
		$inline_tags .= ',' . LSWCP_TAG_PREFIX . '_tag_priv';

		return $inline_tags;
	}

	/**
	 * Purge Cache
	 */
	public static function esi_purge() {
		// do_action( 'litespeed_purge_esi', self::ESI_TAG );
		// do_action( 'litespeed_purge_widget', self::ESI_TAG );
		// do_action( 'litespeed_purge_private', self::ESI_TAG );
		// do_action( 'litespeed_purge_private_esi', self::ESI_TAG );
		do_action( 'litespeed_purge_all' );
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function enqueue_styles() {
		parent::enqueue_styles();

		wecodeart( 'assets' )->add_style( 'wp-block-cart-dep', [
			'load'		=> function( $blocks ) {			
				if( wp_style_is( 'wp-block-cart' ) || wp_style_is( 'wp-block-cart-dep' ) ) {
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
			.wc-block-mini-cart__button:hover:not([disabled]) {
				opacity: 0.6;
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
			.wc-block-mini-cart__icon {
				display: block;
				height: 1.25em;
				width: 1.25em;
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
			.wc-block-mini-cart__drawer .components-modal__header {
				position: absolute;
				top: var(--wp--custom--gutter, 1rem);
				right: var(--wp--custom--gutter, 1rem);
			}
			.wc-block-mini-cart__drawer .components-modal__header button {
				display: block;
				padding: 0;
				background: none;
				border: none;
				box-shadow: none;
				font-size: 1.5rem;
				color: inherit;
				z-index: 9999;
				cursor: pointer;
			}
			.wc-block-mini-cart__drawer .components-modal__header svg {
				display: block;
				width: 1em;
				height: 1em;
			}
			.wc-block-mini-cart__drawer .components-modal__header span {
				display: none;
			}
			.wp-block-woocommerce-mini-cart-contents {
				height: 100vh;
			}
			.wp-block-woocommerce-empty-mini-cart-contents-block,
			.wp-block-woocommerce-filled-mini-cart-contents-block {
				display: flex;
				flex-direction: column;
				height: 100%;
			}
			.wp-block-woocommerce-empty-mini-cart-contents-block {
				justify-content: center;
			}
			.wp-block-woocommerce-filled-mini-cart-contents-block {
				justify-content: space-between;
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
