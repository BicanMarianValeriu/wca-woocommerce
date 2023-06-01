<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Card
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Card Styles
 */
class Card extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
		// Global
        return [];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.card {
				border: 1px solid var(--wp--preset--color--accent);
			}
			.card-header,
			.card-body,
			.card-footer {
				padding: 0.75rem 1rem;
			}
			.card-header {
				border-bottom: inherit;
			}
			.card-footer {
				background-color: var(--wp--preset--color--accent);
				border-top: inherit;
			}
			.card-footer:empty {
				display: none;
			}
        ';
	}
}
