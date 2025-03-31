<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Blocks\Cart\Checkout
 */

namespace WCA\EXT\WOO\Frontend\Blocks\Cart;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WCA\EXT\WOO\Frontend\Blocks\Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Gutenberg Cart Checkout block.
 */
class Checkout extends Base {

	use Singleton;

	/**
	 * Block name.
	 *
	 * @var string
	 */
	protected $block_name = 'proceed-to-checkout-block';

	/**
	 * Block args.
	 *
	 * @param	array $current	Existing register args
	 *
	 * @return 	array
	 */
	public function block_type_args( array $current ): array {
		$supports 	= get_prop( $current, [ 'supports' ], [] );

		return [
			'supports'	=> wp_parse_args( [
				'color'	=> [
					'gradients' 						=> true,
					'__experimentalSkipSerialization'  	=> true,
					'__experimentalDefaultControls'		=> [
						'background'	=> true,
						'text' 			=> true,
					],
				],
				'typography'	=> [
					'fontSize'		=> true,
					'lineHeight'  	=> true,
					'__experimentalFontFamily'  	=> true,
					'__experimentalFontWeight'  	=> true,
					'__experimentalFontStyle'  		=> true,
					'__experimentalTextTransform'  	=> true,
					'__experimentalTextDecoration'	=> true,
					'__experimentalLetterSpacing'  	=> true,
					'__experimentalDefaultControls'	=> [
						'fontSize'	=> true,
					],
				],
				'__experimentalBorder'	=> [
					'color'  	=> true,
					'radius' 	=> true,
					'style' 	=> true,
					'width' 	=> true,
					'__experimentalSkipSerialization' => true,
				],
				'__experimentalSelector' => '.wc-block-cart__submit .wc-block-cart__submit-button'
			], $supports )
		];
	}

	/**
	 * Block styles
	 *
	 * @return 	string 	The block styles.
	 */
	public function styles(): string {
		return '
			.wc-block-cart__submit {
				margin-top: var(--wp--preset--spacing--md);
			}
			.wc-block-cart__submit-container {
				text-align: right;
			}
			.wc-block-cart__submit-button {
				display: grid;
				place-items: center;
				grid-template-columns: auto 1fr;
				grid-gap: 1em;
			}
			.wc-block-cart__submit-button::before {
				content: "";
				display: block;
				width: 1.5em;
				height: 1.5em;
				margin-top: -5px;
				background-color: currentColor;
				-webkit-mask-repeat: no-repeat;
				-webkit-mask-size: contain;
				-webkit-mask-image: var(--wc--icon--checkout);
				mask-image: var(--wc--icon--checkout);
			}
		';
	}
}
