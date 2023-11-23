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
use function WeCodeArt\Functions\dom_get_element;

/**
 * Gutenberg Account Link block.
 */
class Link extends Base {

	use Singleton;

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
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'filter_render' ], 20, 2 );

		wecodeart( 'markup' )->SVG::add( 'account', [
			'viewBox' 	=> '0 0 512 512',
			'paths'		=> 'M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z'
		] );
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
		$processor 	= new \WP_HTML_Tag_Processor( $content );

		$processor->next_tag();

		if( $dropdown && is_user_logged_in() ) {
			$processor->add_class( 'dropdown' );
		}

		if( $classname = get_prop( $block, [ 'attrs', 'className' ] ) ) {
			$processor->add_class( $classname );
		}

		$processor->next_tag( 'a' );
		$processor->add_class( 'wc-block-customer-account__account-link' );
		
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
		$svg_	= dom_get_element( 'svg', $dom );
		$link	= dom_get_element( 'a', $dom );
		
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

			$permalink = wc_get_account_endpoint_url( $endpoint );
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

		return Menu::render_dropdown( (object) $block, [], false );
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
