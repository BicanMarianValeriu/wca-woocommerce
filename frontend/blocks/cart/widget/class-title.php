<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Widget\Title
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart\Widget;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Summary block.
 */
class Title extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'mini-cart-title-block';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return <<<CSS
			h2.wc-block-mini-cart__title,
			h2.wc-block-mini-cart__title .block-editor-block-list__layout {
				display: flex;
				gap: .75rem;
				font-size: var(--wp--preset--font-size--normal);
				font-weight: 700;
				background-color: var(--wp--preset--color--accent);
				padding: var(--wp--custom--gutter, 1rem);
				margin: 0;
			}
		CSS;
	}
}
