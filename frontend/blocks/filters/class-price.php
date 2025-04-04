<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Filters
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Filters;

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend;
use WCA\EXT\WOO\Frontend\Blocks\Base;

/**
 * Gutenberg Price Filter block.
 */
class Price extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'price-filter';

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		$inline = '
			.wc-block-components-price-slider {
				--wp--slider-height: 7px;
				--wp--slider-color: var(--wp--preset--color--accent);
				--wp--thumb-size: 1rem;
				--wp--border-radius: .25rem;
			}
			.wc-block-components-price-slider__range-input {
				position: absolute;
				display: block;
				left: 0;
				top: 0;
				width: 100%;
				height: 0;
				margin: 0;
				padding: 0;
				border: 0;
				background: transparent;
				pointer-events: none;
				-webkit-appearance: none;
						appearance: none;
				outline: none;
			}
			.wc-block-components-price-slider__range-input:focus {
				outline: 0;
			}
			.wc-block-components-price-slider__range-input:focus::-moz-range-thumb {
				box-shadow: 0 0 0 1px white, 0 0 0 2px var(--wp--preset--color--primary);
			}
			.wc-block-components-price-slider__range-input:focus::-webkit-slider-thumb {
				box-shadow: 0 0 0 1px white, 0 0 0 2px var(--wp--preset--color--primary);
			}
			.wc-block-components-price-slider__range-input::-moz-focus-outer {
				border: 0;
			}
			.wc-block-components-price-slider__range-input::-moz-range-track {
				height: 1px;
				outline: 0;
				appearance: none;
				border-color: transparent;
				cursor: default;
			}
			.wc-block-components-price-slider__range-input::-webkit-slider-runnable-track {
				height: 1px;
				outline: 0;
				border-color: transparent;
				cursor: default;
				-webkit-appearance: none;
						appearance: none;
			}
			.wc-block-components-price-slider__range-input::-moz-range-thumb {
				background-color: var(--wp--preset--color--primary);
				width: var(--wp--thumb-size);
				height: var(--wp--thumb-size);
				border: 0;
				border-radius: 50%;
				padding: 0;
				pointer-events: auto;
				-moz-transition: transform 0.2s ease-in-out;
				transition: transform 0.2s ease-in-out;
				transform: translateY(calc(var(--wp--slider-height) / 2 - 1px));
				appearance: none;
				z-index: 20;
				cursor: pointer;
			}
			.wc-block-components-price-slider__range-input::-webkit-slider-thumb {
				background-color: var(--wp--preset--color--primary);
				width: var(--wp--thumb-size);
				height: var(--wp--thumb-size);
				border: 0;
				border-radius: 50%;
				padding: 0;
				pointer-events: auto;
				-webkit-transition: transform 0.2s ease-in-out;
				transition: transform 0.2s ease-in-out;
				margin-top: calc(var(--wp--slider-height) / 2 - var(--wp--thumb-size) / 2);
				z-index: 20;
				cursor: pointer;
				-webkit-appearance: none;
						appearance: none;
			}
			.wc-block-components-price-slider__range-input::-moz-range-thumb:hover {
				transform: translateY(calc(var(--wp--slider-height) / 2 - 1px)) scale(1.1);
			}
			.wc-block-components-price-slider__range-input::-webkit-slider-thumb:hover {
				transform: scale(1.1);
			}
			.wc-block-components-price-slider__range-input::-moz-range-progress {
				margin: 0 !important;
				padding: 0 !important;
				border: 0 !important;
				outline: none;
				background: transparent;
				appearance: none;
			}
			.wc-block-components-price-slider__range-input:-webkit-slider-progress {
				margin: 0 !important;
				padding: 0 !important;
				border: 0 !important;
				outline: none;
				background: transparent;
				-webkit-appearance: none;
						appearance: none;
			}
			.wc-block-components-price-slider__range-input-wrapper {
				width: 100%;
				order: 99;
			}
			.wc-block-components-price-slider__range-input-wrapper > div {
				position: relative;
				display: flex;
				height: var(--wp--slider-height);
				padding: 0 !important;
				border: 0 !important;
				border-radius: var(--wp--border-radius);
				margin: 15px 0;
				background: var(--wp--slider-color);
				box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.05);
				outline: none;
				clear: both;
				-webkit-appearance: none;
						appearance: none;
			}
			.wc-block-components-price-slider__range-input-progress {
				--range-color: var(--wp--preset--color--primary);
				--track-background: linear-gradient(
					90deg,
					transparent calc(var(--low) + 5px),
					var(--range-color) 0,
					var(--range-color) calc(var(--high) - 5px),
					transparent 0
				) no-repeat 0 100%/100% 100%;
				position: absolute;
				left: 0;
				top: 0;
				width: 100%;
				height: inherit;
				border-radius: inherit;
				background: var(--track-background);
			}
			.wc-block-components-price-slider__range-text,
			.wc-block-components-price-slider__controls {
				display: flex;
				flex-wrap: wrap;
				justify-content: space-between;
				gap: 1rem;
			}
			.wc-block-components-price-slider__control {
				flex: 0 0 calc(50% - .5rem);
			}
			.wc-block-components-price-slider__amount {
				flex: 1 0 0%;
				width: 100%;
				padding: .25rem var(--wc--input--padding-x);
				font-size: var(--wc--input--font-size);
				font-weight: var(--wc--input--font-weight);
				line-height: var(--wc--input--line-height);
				color: var(--wc--input--color);
				background-color: var(--wc--input--background-color);
				border: var(--wc--input--border);
				border-radius: var(--wc--input--border-radius);
				transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
			}
			.wc-block-components-price-slider__amount:focus {
				border-color: var(--wc--input--border-focus);
                box-shadow: 0 0 0 0.25rem var(--wp--preset--color--accent);
                outline: 0;
			}
		';
		$inline .= Frontend::get_loading_css( '.wc-block-price-filter__range-input-wrapper.is-loading', 'min-height: .5em;' );
		$inline .= Frontend::get_loading_css( '.wc-block-price-filter__controls .input-loading', 'flex: 1 0 0%;min-height: 2em;' );
		
		return $inline;
	}
}