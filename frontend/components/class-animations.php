<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Animations
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Animations Styles
 */
class Animations extends Base {
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
			@keyframes animation__loading {
				to {
					transform: translateX(100%);
				}
			}
			@keyframes animation__rotate {
				to {
					transform: rotate(360deg);
				}
			}
			@keyframes animation__fadeIn {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
			}
			@keyframes animation__slideOut {
				from {
					transform: translate3d(0, 0, 0);
				}
				to {
					visibility: hidden;
					transform: translate3d(-100%, 0, 0);
				}
			}
        ';
	}
}
