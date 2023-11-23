<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components
 */

namespace WCA\EXT\WOO\Frontend;

use WeCodeArt\Singleton;
use WeCodeArt\Config\Traits\Asset;
use WeCodeArt\Config\Interfaces\Configuration;

/**
 * Components Styles
 */
class Components implements Configuration {

	use Singleton;
    use Asset;

    /**
	 * The CSS cache file.
	 *
	 * @var string
	 */
    const CACHE_FILE    = 'woo-components.css';
    const CACHE_KEY     = 'wecodeart/gutenberg/woocommerce/components';
    const CSS_HANDLE    = 'wecodeart-woocommerce-components';

	/**
     * All of the configuration items.
     *
     * @var array
     */
    protected $items 	= [];

    /**
	 * Send to Constructor
	 */
	public function init() {
        // Root
		$this->register( 'global',      Components\Root::class      );
        // Modules
		$this->register( 'address',     Components\Address::class   );
		$this->register( 'text',        Components\Text::class      );
		$this->register( 'textarea',    Components\TextArea::class  );
		$this->register( 'dropdown',    Components\Dropdown::class  );
		$this->register( 'checkbox',    Components\Checkbox::class  );
		$this->register( 'radio',       Components\Radio::class     );
		$this->register( 'quantity',    Components\Quantity::class  );
		$this->register( 'chips',       Components\Chips::class     );
		$this->register( 'skeleton',    Components\Skeleton::class  );
		$this->register( 'sortable',    Components\Sortable::class  );
		$this->register( 'loading',     Components\Loading::class   );
		$this->register( 'layout',      Components\Layout::class    );
		$this->register( 'drawer',      Components\Drawer::class    );
		$this->register( 'notices',     Components\Notices::class   );
        $this->register( 'totals',      Components\Totals::class    );
		$this->register( 'badges',      Components\Badges::class    );
		$this->register( 'panel',       Components\Panel::class     );
		$this->register( 'card',        Components\Card::class      );
		$this->register( 'more',        Components\More::class      );
        $this->register( 'account',     Components\Account::class   );
        $this->register( 'validation',  Components\Validation::class);
        $this->register( 'animations',  Components\Animations::class);
	}
    
    /**
	 * Enqueue Front-End Assets
	 *
	 * @since	1.0.0
	 * @version	1.0.0
	 */
	public function wp_enqueue_scripts() {
        $blocks = [];

        global $_wp_current_template_content;
        $template   = $_wp_current_template_content ?: '';
        $blocks_1   = parse_blocks( get_post_field( 'post_content', get_the_ID() ) );
        $blocks_1 	= wp_list_pluck( _flatten_blocks( $blocks_1 ), 'blockName' );
        $blocks_2   = parse_blocks( $template );
        $blocks_2 	= wp_list_pluck( _flatten_blocks( $blocks_2 ), 'blockName' );
        $blocks     = array_unique( array_merge( $blocks_2, $blocks_1 ) );

		$inline = '';

        static $loaded = [];

		foreach( $this->all() as $key => $class ) {
			if( ! empty( $deps = $class::$deps ) ) {
				foreach( $deps as $dep ) {
					// Skip already loaded.
					if( in_array( $dep, $loaded ) ) {
						continue;
					}

                    if(
                        empty( $blocks ) || // Anywhere empty.
                        empty( $this->get( $dep )::blocks() ) || // No requiredments.
                        count( array_intersect( $blocks, $this->get( $dep )::blocks() ) ) // Must meet requirements.
                    ) {
                        $inline .= $this->get( $dep )::styles();
                        $loaded[] = $dep;
                    }
				}
			}

            if(
                empty( $blocks ) || // Anywhere empty.
                empty( $class::blocks() ) || // No requiredments.
                count( array_intersect( $blocks, $class::blocks() ) ) // Must meet requirements.
            ) {
                $inline .= $class::styles();
                $loaded[] = $key;
            }
		}

        if( ! empty( $inline ) ) {
            // Load a fake input to trigger body class vars
            $fake_input = wecodeart_input( 'hidden', [], false );
            $inline     = wecodeart( 'styles' )::compress( $inline );
    
            wp_register_style( self::CSS_HANDLE, '' );
            wp_enqueue_style( self::CSS_HANDLE );
            wp_add_inline_style( self::CSS_HANDLE, $inline );
        }
	}

    /**
	 * Cache components.
	 *
	 * @return  void
	 */
	public function cache() {
        $filesystem = wecodeart( 'files' );
        $filesystem->set_folder( 'cache' );
        if( ! $filesystem->has_file( self::CACHE_FILE ) || false === get_transient( self::CACHE_KEY ) ) {
            $inline = '';
            foreach( $this->all() as $component ) {
                $inline .= $component::styles();
            }
			$filesystem->create_file( self::CACHE_FILE, wecodeart( 'styles' )::compress( $inline ) );
			set_transient( self::CACHE_KEY, true, 5 * MINUTE_IN_SECONDS );
		}
        $filesystem->set_folder( '' );
	}
	
	/**
     * Set a given integration value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     *
     * @return void
     */
    public function register( $key, $value = null ) {
        $this->set( $key, $value );
	}

    /**
     * Set a given configuration value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     *
     * @return void
     */
    public function set( $key, $value = null ) {
        $keys = is_array( $key ) ? $key : [ $key => $value ];

        foreach ( $keys as $key => $value ) {
            $this->items[$key] = $value;
        }
    }

	/**
     * Determine if the given configuration value exists.
     *
     * @param  string  $key
     *
     * @return bool
     */
    public function has( $key ) {
        return isset( $this->items[$key] );
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @param  mixed   $default
     *
     * @return mixed
     */
    public function get( $key, $default = null ) {
        if ( ! isset( $this->items[$key] ) ) {
            return $default;
        }

        return $this->items[$key];
	}

    /**
     * Forget a given configuration value.
     *
     * @param string  $key
     *
     * @return void
     */
    public function forget( $key ) {
        unset( $this->items[$key] );
    }

    /**
     * Get all of the configuration items for the application.
     *
     * @return array
     */
    public function all() {
        return $this->items;
    }
}
