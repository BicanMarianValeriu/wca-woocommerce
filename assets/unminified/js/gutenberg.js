/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/gutenberg/blocks/variations.js":
/*!***********************************************!*\
  !*** ./src/js/gutenberg/blocks/variations.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "viewedProductsVariation": () => (/* binding */ viewedProductsVariation)
/* harmony export */ });
/**
 * WordPress dependencies
 */
const {
  i18n: {
    __
  }
} = wp;
const VARIATION_NAME = 'woocommerce/product-query/viewed-products';
const viewedProductsVariation = {
  block: 'core/query',
  attributes: {
    name: VARIATION_NAME,
    title: __('Recently viewed products', 'wca-woocommerce'),
    icon: 'products',
    description: __('Displays a list of recently viewed products for logged in users.', 'wca-woocommerce'),
    isActive: ['namespace'],
    attributes: {
      namespace: VARIATION_NAME,
      query: {
        postType: 'product',
        perPage: 4
      }
    },
    allowedControls: [],
    innerBlocks: [['core/heading', {
      level: 2,
      className: 'fw-500',
      content: __('Recently viewed products', 'wca-woocommerce')
    }], ['core/post-template', {
      className: 'wp-block-query__products',
      __woocommerceNamespace: 'woocommerce/product-query/product-template',
      layout: {
        type: 'grid',
        columns: 4
      },
      lock: {
        move: true,
        remove: true
      }
    }, [['core/pattern', {
      slug: 'wecodeart/el-product-loop'
    }]]]]
  }
};


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***********************************!*\
  !*** ./src/js/gutenberg/index.js ***!
  \***********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _blocks_variations__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./blocks/variations */ "./src/js/gutenberg/blocks/variations.js");
/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */
const {
  blocks: {
    registerBlockVariation
  }
} = wp;


function registerBlockVariations() {
  [_blocks_variations__WEBPACK_IMPORTED_MODULE_0__.viewedProductsVariation].forEach(_ref => {
    let {
      block,
      attributes
    } = _ref;
    registerBlockVariation(block, attributes);
  });
}

registerBlockVariations();
})();

/******/ })()
;
//# sourceMappingURL=gutenberg.js.map