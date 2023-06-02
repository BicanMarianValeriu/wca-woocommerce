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
use WeCodeArt\Gutenberg\Blocks\Dynamic;
use WeCodeArt\Gutenberg\Blocks\Navigation\Menu;

use function add_filter;
use function str_replace;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Account Link block.
 */
class Link extends Dynamic {

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
	protected $block_name = 'customer-account';

	/**
	 * Block args.
	 *
	 * @return 	array
	 */
	public function init() {
		add_filter( 'render_block_' . $this->get_block_type(),	[ $this, 'filter_render' ], 20, 2 );
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
		$processor->add_class( 'dropdown' );

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

		return $content;
	}

	/**
	 * Block styles.
	 *
	 * @return 	string Block CSS.
	 */
	public function dropdown( array $block = [] ) {		
		$block = [
			'context' => [
				'openSubmenusOnClick' => true,
			]
		];

		global $wp;
		$current_url = trailingslashit( home_url( $wp->request ) );

		foreach( wc_get_account_menu_items() as $endpoint => $label ) :
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
			}
			.wp-block-woocommerce-customer-account .dropdown-menu {
				font-size: var(--wp--preset--font-size--small);
			}
			.wc-block-customer-account__account-icon {
				display: block;
				width: 1.25em;
				height: 1.25em;
			}
			.wc-block-customer-account__account-icon + :is(.wc-block-customer-account__account-label,.label) {
				margin-left: .5em;
			}
			.wp-block-woocommerce-customer-account .label,
			.wc-block-customer-account__account-label,
			.wc-block-customer-account__account-label:empty {
				display: none;
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
