/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
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
/*!*************************!*\
  !*** ./src/js/admin.js ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);


/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */
const {
  i18n: {
    __,
    sprintf
  },
  hooks: {
    addFilter
  },
  components: {
    Placeholder,
    DropdownMenu,
    ToggleControl,
    Card,
    CardHeader,
    CardBody,
    Dashicon,
    Spinner,
    Tooltip,
    Button
  },
  element: {
    useState,
    useEffect
  }
} = wp;
addFilter('wecodeart.admin.tabs.plugins', 'wecodeart/woocommerce/admin/panel', optionsPanel);

function optionsPanel(panels) {
  return [...panels, {
    name: 'wca-woocommerce',
    title: __('WooCommerce', 'wca-woocommerce'),
    render: props => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Options, props)
  }];
}

const Options = props => {
  const {
    settings,
    saveSettings,
    isRequesting,
    createNotice
  } = props;

  if (isRequesting || !settings) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Placeholder, {
      icon: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null),
      label: __('Loading', 'wca-woocommerce'),
      instructions: __('Please wait, loading settings...', 'wca-woocommerce')
    });
  }

  const [loading, setLoading] = useState(null);

  const apiOptions = (_ref => {
    let {
      woocommerce
    } = _ref;
    return woocommerce;
  })(settings);

  const [formData, setFormData] = useState(apiOptions);

  const handleNotice = () => {
    setLoading(false);
    return createNotice('success', __('Settings saved.', 'wca-woocommerce'));
  };

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Card, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardHeader, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    className: "text-uppercase fw-medium m-0"
  }, __('Optimization', 'wca-woocommerce'))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardBody, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, __('Remove CSS?', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(DropdownMenu, {
      label: __('More Information', 'wca-woocommerce'),
      icon: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Dashicon, {
        icon: "info",
        style: {
          color: 'var(--wca--header--color)'
        }
      }),
      toggleProps: {
        style: {
          height: 'initial',
          minWidth: 'initial',
          padding: 0
        }
      },
      popoverProps: {
        focusOnMount: 'container',
        position: 'bottom',
        noArrow: false
      }
    }, () => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      style: {
        minWidth: 250,
        margin: 0
      }
    }, __('These styles primarily cater to legacy themes, whereas WooCommerce blocks now have their own styles.', 'wca-woocommerce'))))),
    help: __('Remove default WooCommerce stylesheets.', 'wca-woocommerce'),
    checked: formData['remove_style'],
    onChange: value => setFormData({ ...formData,
      remove_style: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: __('Replace Select2 CSS?', 'wca-woocommerce'),
    help: __('Replace Select2 stylesheet with an optimized version for our theme.', 'wca-woocommerce'),
    checked: formData['replace_select2_style'],
    onChange: value => setFormData({ ...formData,
      replace_select2_style: value
    })
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("hr", {
    style: {
      margin: '20px 0'
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
    className: "button",
    isPrimary: true,
    isLarge: true,
    icon: loading && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null),
    onClick: () => {
      setLoading(true);
      saveSettings({
        woocommerce: formData
      }, handleNotice);
    },
    disabled: loading
  }, loading ? '' : __('Save', 'wecodeart')));
};
})();

/******/ })()
;
//# sourceMappingURL=admin.js.map