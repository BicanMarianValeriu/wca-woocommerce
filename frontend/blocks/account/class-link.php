<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Account\Link
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Account;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Blocks\Navigation\Menu;
use WCA\EXT\WOO\Frontend\Blocks\Base;

use function add_filter;
use function str_replace;
use function WeCodeArt\Functions\get_prop;

use \LiteSpeed\Tag;
use \LiteSpeed\ESI;
use \LiteSpeed\Conf;
use \LiteSpeed\Base as LSBase;

/**
 * Gutenberg Account Link block.
 */
class Link extends Base {

	use Singleton;

	const ESI_TAG	= 'wca_customer_account';

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'customer-account';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		wecodeart( 'markup' )->SVG::add( 'account', [
			'viewBox' 	=> '0 0 512 512',
			'paths'		=> 'M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z'
		] );
		
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'filter_render' ], 20, 2 );

		if ( apply_filters( 'litespeed_esi_status', false ) ) {
			add_action( 'litespeed_tpl_normal', 					__CLASS__ . '::is_not_esi' );
			add_action( 'litespeed_esi_load-' . self::ESI_TAG, 		__CLASS__ . '::esi_load' );
			add_filter( 'litespeed_esi_inline-' . self::ESI_TAG, 	__CLASS__ . '::esi_inline', 20, 2 );
		}
	}

	/**
	 * Block args.
	 *
	 * @param	array $current	Existing register args
	 *
	 * @return 	array
	 */
	public function block_type_args( $current ): array {
		$supports 	= get_prop( $current, [ 'supports' ], [] );

		return [
			'supports' 			=> wp_parse_args( [
				'typography' => [
					'fontSize'		=> true,
					'lineHeight'	=> true,
					'__experimentalFontFamily'	=> true,
					'__experimentalFontWeight'	=> true,
					'__experimentalFontStyle'	=> true,
					'__experimentalTextTransform'	=> true,
					'__experimentalTextDecoration'	=> true,
					'__experimentalLetterSpacing'	=> true,
					'__experimentalDefaultControls' => [
						'fontSize' => true
					]
				],
			], $supports )
		];
	}

    /**
	 * Render Block
	 * 
	 * @param 	string 	$content
	 * 
	 * @return 	string
	 */
	public function filter_render( string $content = '', array $block = [] ): string {
		$dropdown 	= get_prop( wecodeart_option( 'woocommerce' ), [ 'customer_account_extra' ], false );
		$processor 	= wecodeart( 'dom' )::processor( $content );

		$processor->next_tag();

		if( $dropdown && is_user_logged_in() ) {
			$processor->add_class( 'dropdown' );
		}

		if( $classname = get_prop( $block, [ 'attrs', 'className' ] ) ) {
			$processor->add_class( $classname );
		}

		$processor->next_tag( 'a' );
		$processor->add_class( 'wc-block-customer-account__account-link' );
		$processor->set_attribute( 'aria-label', esc_html__( 'Customer account', 'woocommerce' ) );
		
		if( $dropdown && is_user_logged_in() && ! is_account_page() ) {		
			$processor->add_class( 'dropdown-toggle' );
			$processor->set_attribute( 'data-bs-toggle', 'dropdown' );
		}

		if( $processor->next_tag( 'span' ) ) {
			$processor->set_attribute( 'class', 'wc-block-customer-account__account-label' );
		}

		$content = $processor->get_updated_html();

		if( $dropdown && is_user_logged_in() && ! is_account_page() ) {
			$content = str_replace( '</a>', '</a>' . $this->dropdown( $block ), $content );
		}

		$dom	= $this->dom( $content );
		$svg_	= wecodeart( 'dom' )::get_element( 'svg', $dom );
		$link	= wecodeart( 'dom' )::get_element( 'a', $dom );
		
		$svg	= $dom->importNode( $this->dom( wecodeart( 'markup' )->SVG::compile( 'account', [
			'class' => 'wc-block-customer-account__account-icon',
		] ) )->documentElement, true );
		$svg->setAttribute( 'role', 'presentation' );
		$svg->setAttribute( 'aria-hidden', 'true' );

		$link->insertBefore( $svg, $svg_ );
		$link->removeChild( $svg_ );

		$content = $dom->saveHtml();

		return $content;
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function dropdown( array $block = [] ) {
		$block = [
			'context' 	=> [
				'openSubmenusOnClick' => true,
			],
			'inner_blocks' => [
				new \WP_Block( [
					'blockName'	=> 'core/navigation-link',
					'attrs'		=> [
						'kind' 		=> 'custom',
						'className' => 'dropdown-header',
						'label'		=> sprintf( esc_html__( 'Welcome %s', 'wca-woocommerce' ), wp_get_current_user()->display_name ),
						'isTopLevelLink' => false,
					]
				] )
			]
		];

		$divider = new \WP_Block( [
			'blockName'	=> 'core/navigation-link',
			'attrs'		=> [
				'kind' 		=> 'custom',
				'className' => 'dropdown-divider',
				'label'		=> '-',
				'isTopLevelLink' => false,
			]
		] );

		$block['inner_blocks'][] = $divider;

		global $wp;
		$current_url = trailingslashit( home_url( $wp->request ) );

		foreach( wc_get_account_menu_items() as $endpoint => $label ) :
			if( $endpoint === 'customer-logout' ) {
				$block['inner_blocks'][] = $divider;
			}

			$permalink = trailingslashit( wc_get_account_endpoint_url( $endpoint ) );
			
			$block['inner_blocks'][] = new \WP_Block( [
				'blockName'	=> 'core/navigation-link',
				'attrs'		=> [
					'kind' 	=> 'custom', // Could be post_type|page but is ok.
					'id'	=> $current_url === $permalink ? get_the_ID() : null,
					'label' => esc_html( $label ),
					'url'	=> esc_url( $permalink ),
					'isTopLevelLink' => false,
				]
			] );
		endforeach;

		\wp_enqueue_style( 'wp-block-navigation-submenu' );

		return Menu::render_dropdown( (object) $block, [], false );
	}

	/**
	 * Is ESI Block.
	 *
	 * @return 	void
	 */
	public static function is_not_esi() {
		add_filter( 'render_block_woocommerce/customer-account', __CLASS__ . '::esi_render', 30, 2 );
	}

	/**
	 * If there are no related products, return an empty string.
	 *
	 * @param 	string $content The block content.
	 * @param 	array  $block The block.
	 *
	 * @return 	string The block content.
	 */
	public static function esi_render( string $content = '', array $block = [] ): string {
		$params = [
			'block'	=> $block,
		];

		$inline_tags = self::esi_tags();

		do_action( 'litespeed_esi_combine', self::ESI_TAG );

		$inline = [
			'val' 		=> $content,
			'tag' 		=> $inline_tags,
			'control' 	=> 'private,no-vary,max-age=' . Conf::cls()->conf( LSBase::O_CACHE_TTL_PRIV ),
		];

		return apply_filters( 'litespeed_esi_url', self::ESI_TAG, 'CUSTOMER ACCOUNT', $params, 'private,no-vary', false, true, true, $inline );
	}

	/**
	 * Load ESI block.
	 *
	 * @param 	array 	$params.
	 *
	 * @return 	void
	 */
	public static function esi_load( $params ) {
		// Remove actions due to render block filter being called.
		remove_all_actions( 'litespeed_esi_load-' . self::ESI_TAG );
		remove_all_filters( 'litespeed_esi_inline-' . self::ESI_TAG );

		echo render_block( get_prop( $params, 'block', [] ) );

		do_action( 'litespeed_control_set_private', 'CUSTOMER ACCOUNT' );
		do_action( 'litespeed_vary_no' );
	}

	/**
	 * Inline ESI block.
	 *
	 * @param 	array 	$res.
	 * @param 	array 	$params.
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
	 * Get ESI tags.
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
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wp-block-woocommerce-customer-account {
				display: inline-flex;
				flex-direction: column;
    			justify-content: center;
			}
			.wp-block-woocommerce-customer-account a,
			.wc-block-customer-account__account-link {
				display: flex;
				align-items: center;
				text-decoration: none;
				color: inherit;
			}
			.wp-block-woocommerce-customer-account .dropdown-menu {
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-customer-account__account-icon {
				display: block;
				width: 1.25em;
				height: 1.25em;
			}
			.wc-block-customer-account__account-icon.svg-inline {
				height: initial;
			}
			.wc-block-customer-account__account-icon + :is(.wc-block-customer-account__account-label,.label) {
				margin-left: .5em;
			}
			.wp-block-woocommerce-customer-account .label,
			.wc-block-customer-account__account-label,
			.wc-block-customer-account__account-label:empty {
				display: none;
			}
			.wp-block-woocommerce-customer-account .dropdown-header {
				font-weight: 700;
				color: inherit;
			}
			@media screen and (min-width: 768px) {
				.wp-block-woocommerce-customer-account .label,
				.wc-block-customer-account__account-label {
					display: initial;
				}
			}
		';
	}
}
