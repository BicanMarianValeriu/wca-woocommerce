<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Layout
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Layout Styles
 */
class Layout extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
        return [
            'woocommerce/checkout',
			'woocommerce/cart',
        ];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.wc-block-components-sidebar-layout {
				position: relative;
				display: flex;
				flex-wrap: wrap;
				gap: calc(2 * var(--wp--custom--gutter));
			}
			.wc-block-components-sidebar-layout > .block-editor-inner-blocks > .block-editor-block-list__layout {
				position: relative;
				display: flex;
				flex-wrap: wrap;
				align-items: flex-start;
				gap: calc(2 * var(--wp--custom--gutter));
			}
			.wc-block-components-main,
			.wc-block-components-sidebar {
				position: relative;
				flex: 1 0 100%;
				width: 100%;
			}
			.is-large .wc-block-components-main,
			.is-large .wc-block-components-sidebar {
				flex: 1 0 0%;
			}
			.is-large .wc-block-components-sidebar {
				position: sticky;
				top: var(--wp--header-height, 80px);
				align-self: flex-start;
				flex: 0 0 30%;
			}
        ';
	}
}
