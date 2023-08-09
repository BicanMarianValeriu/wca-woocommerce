<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks
 */

namespace WCA\EXT\WOO\Frontend\Blocks;

use WeCodeArt\Singleton;
use WeCodeArt\Config\Traits\Asset;
use WeCodeArt\Gutenberg\Blocks\Dynamic;

/**
 * Block
 */
class Base extends Dynamic {

	/**
	 * Block namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'woocommerce';

    /**
	 * Get block asset handle.
	 *
	 * @return string
	 */
	public function get_asset_handle(): string {		
		return 'wc-blocks-style-' . $this->block_name;
	}
}
