"use strict";
(globalThis["webpackChunkwca_woocommerce"] = globalThis["webpackChunkwca_woocommerce"] || []).push([["ReviewForm"],{

/***/ "./src/js/frontend/reviews/form/Notification.js":
/*!******************************************************!*\
  !*** ./src/js/frontend/reviews/form/Notification.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./../functions */ "./src/js/frontend/reviews/functions.js");


const {
  Template = {
    renderToString: _functions__WEBPACK_IMPORTED_MODULE_1__.renderToString
  }
} = window.wecodeart || {};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  userData = {},
  note,
  options
}) => {
  const {
    product: {
      title: productTitle
    }
  } = options;
  const {
    reviewer: userName = 'visitor'
  } = userData;
  return note && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: 'woocommerce-Reviews__respond-note',
    dangerouslySetInnerHTML: {
      __html: Template.renderToString(note, {
        userName,
        productTitle
      })
    }
  });
});

/***/ }),

/***/ "./src/js/frontend/reviews/form/SuggestTitle.js":
/*!******************************************************!*\
  !*** ./src/js/frontend/reviews/form/SuggestTitle.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const {
  i18n: {
    __
  },
  hooks: {
    applyFilters
  },
  element: {
    useEffect,
    useState
  }
} = wp;
const RATING_SUGGESTIONS = applyFilters('wecodeart.woocommerce.reviews.rating.suggestions', {
  1: [__('Not recommended', 'wca-woocommerce'), __('Very weak', 'wca-woocommerce'), __('Not happy', 'wca-woocommerce')],
  2: [__('Weak', 'wca-woocommerce'), __('I don\'t like it', 'wca-woocommerce'), __('Disappointing', 'wca-woocommerce')],
  3: [__('Decent', 'wca-woocommerce'), __('Acceptable', 'wca-woocommerce'), __('Ok', 'wca-woocommerce')],
  4: [__('Happy', 'wca-woocommerce'), __('I like it', 'wca-woocommerce'), __('Is worth it', 'wca-woocommerce'), __('Good', 'wca-woocommerce')],
  5: [__('Excelent', 'wca-woocommerce'), __('Very satisfied', 'wca-woocommerce'), __('Recommended', 'wca-woocommerce'), __('Cool', 'wca-woocommerce')]
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  rating: star = 5,
  setTitle
}) => {
  const [current, setCurrent] = useState(RATING_SUGGESTIONS[star]);
  useEffect(() => setCurrent(RATING_SUGGESTIONS[star]), [star]);
  const onClick = e => {
    const value = e.currentTarget.textContent;
    setTitle(value);
    document.forms['wca-woo-addreview'].elements['title'].value = value;
  };
  const Button = ({
    key,
    label
  }) => {
    const props = {
      type: 'button',
      className: 'wp-element-button has-accent-background-color has-black-color',
      key,
      onClick
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", props, label);
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__suggestions",
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      alignItems: 'center',
      gap: '.5rem'
    }
  }, current.map((x, y) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Button, {
    key: y,
    label: x
  })));
});

/***/ }),

/***/ "./src/js/frontend/reviews/form/index.js":
/*!***********************************************!*\
  !*** ./src/js/frontend/reviews/form/index.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_hook_form__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-hook-form */ "./node_modules/react-hook-form/dist/index.esm.mjs");
/* harmony import */ var _SuggestTitle__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./SuggestTitle */ "./src/js/frontend/reviews/form/SuggestTitle.js");
/* harmony import */ var _Notification__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Notification */ "./src/js/frontend/reviews/form/Notification.js");
/* harmony import */ var _shared_RatingInput__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./../shared/RatingInput */ "./src/js/frontend/reviews/shared/RatingInput.js");






const {
  i18n: {
    __
  },
  hooks: {
    doAction
  },
  element: {
    useState
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  rating,
  setRating,
  queryArgs,
  setQueryArgs,
  userData = false,
  options,
  breakpoint
}) => {
  const {
    product: {
      ID: productId
    },
    terms,
    note,
    requestUrl
  } = options;
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState(false);
  const {
    handleSubmit,
    register,
    reset: resetForm,
    formState: {
      errors
    },
    setValue
  } = (0,react_hook_form__WEBPACK_IMPORTED_MODULE_5__.useForm)({
    mode: 'onSubmit'
  });
  const setTitle = value => setValue('title', value);
  const onSubmit = async (values, e) => {
    if (loading) {
      return;
    }
    const formData = new FormData();
    formData.append('action', 'review');
    formData.append('product_id', productId);
    Object.keys(values).map(k => formData.append(k, values[k]));
    if (userData) {
      Object.keys(userData).map(k => formData.append(k, userData[k]));
    }
    setLoading(true);
    try {
      const r = await fetch(requestUrl, {
        method: 'POST',
        body: formData
      });
      const {
        message
      } = await r.json();
      setMessage(message);
    } catch (e) {
      console.warn(e);
      setMessage(e);
    } finally {
      setLoading(false);
      // Reset Rating
      setTimeout(() => setRating(false), 3000);
      // Reset Reviews
      resetForm();
      setQueryArgs({
        ...queryArgs
      });
    }
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "grid"
  }, note && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-lg-4 start-lg-9"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_Notification__WEBPACK_IMPORTED_MODULE_3__["default"], {
    userData,
    note,
    options
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-lg-7",
    style: {
      gridRow: breakpoint === 'mobile' ? 'initial' : 1
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("form", {
    className: "woocommerce-Reviews__respond-form",
    name: "wca-woo-addreview",
    onSubmit: handleSubmit(onSubmit)
  }, doAction('wecodeart.woocommerce.reviews.newReview.top', register, errors, options), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_shared_RatingInput__WEBPACK_IMPORTED_MODULE_4__["default"], {
    rating,
    onClick: setRating
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    type: "hidden",
    name: "rating",
    value: rating
  }, register('rating', {
    validate: value => value !== 0,
    minLength: 1,
    maxLength: 5
  })))))), !userData && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field grid"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer span-12 span-md-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    for: "reviewer"
  }, __('Name', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    type: "text",
    id: "reviewer",
    placeholder: __('Name', 'wca-woocommerce')
  }, register('reviewer', {
    required: __('What is your name?', 'wca-woocommerce'),
    validate: value => value !== 'admin' || __('Nice Try', 'wca-woocommerce')
  }))), errors.reviewer && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    class: "invalid-feedback",
    style: {
      display: 'block'
    }
  }, errors.reviewer.message)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer span-12 span-md-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    for: "reviewer_email"
  }, __('Email', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    type: "email",
    id: "reviewer_email",
    placeholder: __('Email', 'wca-woocommerce')
  }, register('reviewer_email', {
    required: __('What is your email address?', 'wca-woocommerce'),
    pattern: {
      value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
      message: __('Invalid email address.', 'wca-woocommerce')
    }
  }))), errors.reviewer_email && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    class: "invalid-feedback",
    style: {
      display: 'block'
    }
  }, errors.reviewer_email.message))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    for: "review_title"
  }, __('Review title (optional)', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    type: "text",
    id: "review_title",
    placeholder: __('Use a suggestion or write your own title', 'wca-woocommerce')
  }, register('title')))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_SuggestTitle__WEBPACK_IMPORTED_MODULE_2__["default"], {
    rating: rating,
    setTitle: setTitle
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    for: "review"
  }, __('Review', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("textarea", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    id: "review",
    rows: "7",
    required: "",
    placeholder: __('Describe your experience with the product', 'wca-woocommerce')
  }, register('review', {
    required: __('This cannot be empty!', 'wca-woocommerce'),
    minLength: 20
  }))), errors.review && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    class: "invalid-feedback",
    style: {
      display: 'block'
    }
  }, errors.review.type === 'minLength' ? __('Please be more descriptive.', 'wca-woocommerce') : errors.review.message))), doAction('wecodeart.woocommerce.reviews.newReview.bottom', register, errors, options), terms && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field woocommerce-Reviews__respond-field--terms"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "mb-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("p", {
    className: "has-small-font-size has-cyan-bluish-gray-color",
    dangerouslySetInnerHTML: {
      __html: terms
    }
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("button", {
    type: "submit",
    className: "wp-element-button has-primary-background-color",
    disabled: loading === true
  }, __('Add Review', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", null, " \xA0 "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", {
    href: "javascript:void(0);",
    onClick: () => setRating(false),
    className: "wp-element-link"
  }, __('Cancel', 'wca-woocommerce')), message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "has-accent-background-color",
    style: {
      padding: '1rem',
      marginTop: '1rem',
      borderRadius: '.25rem'
    }
  }, message))))));
});

/***/ })

}]);
//# sourceMappingURL=ReviewForm.js.map