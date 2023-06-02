/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/admin/components/MissingTemplates.js":
/*!*****************************************************!*\
  !*** ./src/js/admin/components/MissingTemplates.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
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
    __
  },
  components: {
    Spinner,
    Button
  },
  element: {
    useState
  }
} = wp;
const {
  missing: _missingTemplates = []
} = wecodeartWooCommerce;

const MissingTemplates = _ref => {
  let {
    loading,
    setLoading,
    handleNotice
  } = _ref;
  const [missingTemplates, setMissingTemplates] = useState(_missingTemplates);

  if (missingTemplates.length === 0) {
    return null;
  }

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "components-notice is-warning flex-column align-items-start m-0 mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "my-3"
  }, __('Your current theme is missing the following WooCommerce templates:', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    className: "my-0"
  }, missingTemplates.map(_ref2 => {
    let {
      title,
      description
    } = _ref2;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, title), ": ", description);
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
    className: "button",
    isPrimary: true,
    icon: loading && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null),
    onClick: () => {
      setLoading(true);
      const formData = new FormData();
      formData.append('action', 'wca_manage_woo_data');
      formData.append('type', 'copy');
      formData.append('slugs', JSON.stringify(missingTemplates.map(_ref3 => {
        let {
          slug
        } = _ref3;
        return slug;
      })));
      return fetch(ajaxurl, {
        method: 'POST',
        body: formData
      }).then(r => r.json()).then(_ref4 => {
        let {
          data: {
            message = '',
            success = []
          } = {}
        } = _ref4;

        if (success.length) {
          setMissingTemplates([...missingTemplates.filter(_ref5 => {
            let {
              slug
            } = _ref5;
            return !success.includes(slug);
          })]);
        }

        handleNotice(message);
      });
    },
    disabled: loading
  }, loading ? '' : __('Install Templates', 'wca-woocommerce')))));
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (MissingTemplates);

/***/ }),

/***/ "./src/js/admin/components/index.js":
/*!******************************************!*\
  !*** ./src/js/admin/components/index.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "MissingTemplates": () => (/* reexport safe */ _MissingTemplates__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _MissingTemplates__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MissingTemplates */ "./src/js/admin/components/MissingTemplates.js");


/***/ }),

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
/*!*******************************!*\
  !*** ./src/js/admin/index.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components */ "./src/js/admin/components/index.js");


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
    RangeControl,
    ToggleControl,
    Card,
    CardHeader,
    CardBody,
    Dashicon,
    Spinner,
    Button
  },
  element: {
    useState
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

  const handleNotice = function () {
    let message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
    setLoading(false);

    if (!message) {
      message = __('Settings saved.', 'wca-woocommerce');
    }

    return createNotice('success', message);
  };

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components__WEBPACK_IMPORTED_MODULE_1__.MissingTemplates, {
    loading,
    setLoading,
    handleNotice
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Card, {
    className: "border shadow-none"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardHeader, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    className: "text-uppercase fw-medium m-0"
  }, __('Optimization', 'wca-woocommerce'))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardBody, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, __('Remove legacy CSS?', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(DropdownMenu, {
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
    help: sprintf(__('Default WooCommerce style will be %s.', 'wca-woocommerce'), !formData['remove_style'] ? __('loaded', 'wca-woocommerce') : __('removed', 'wca-woocommerce')),
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
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Card, {
    className: "border border-top-0 shadow-none"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardHeader, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    className: "text-uppercase fw-medium m-0"
  }, __('Functionality', 'wca-woocommerce'))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CardBody, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, __('Enable product price extras?', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(DropdownMenu, {
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
    }, __('A new field has been introduced in the product administration page for both normal and variation products.', 'wca-woocommerce'))))),
    help: __('Enhance the Product Price block by integrating a tooltip that showcases the recommended price set by the producer.', 'wca-woocommerce'),
    checked: formData['product_price_extra'],
    onChange: value => setFormData({ ...formData,
      product_price_extra: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: __('Enable product rating extras?', 'wca-woocommerce'),
    help: __('Enhance the Product Rating block by incorporating enhanced and visually captivating rating information.', 'wca-woocommerce'),
    checked: formData['product_rating_extra'],
    onChange: value => setFormData({ ...formData,
      product_rating_extra: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ToggleControl, {
    label: __('Enable customer account extras?', 'wca-woocommerce'),
    help: __('Enhance the Customer Account block by adding a dropdown with WooCommerce\'s account page endpoints.', 'wca-woocommerce'),
    checked: formData['customer_account_extra'],
    onChange: value => setFormData({ ...formData,
      customer_account_extra: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(RangeControl, {
    label: __('Product gallery columns', 'wca-woocommerce'),
    value: formData['product_gallery_cols'],
    onChange: value => setFormData({ ...formData,
      product_gallery_cols: value
    }),
    min: 3,
    max: 8
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
      }, () => handleNotice());
    },
    disabled: loading
  }, loading ? '' : __('Save', 'wecodeart')));
};
})();

/******/ })()
;
//# sourceMappingURL=admin.js.map