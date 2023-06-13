/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */
const {
    blocks: {
        registerBlockVariation
    },
} = wp;

import { viewedProductsVariation } from './blocks/variations';

function registerBlockVariations() {
    [
        viewedProductsVariation
    ].forEach(({ block, attributes }) => {
        registerBlockVariation(block, attributes);
    });
}

registerBlockVariations();