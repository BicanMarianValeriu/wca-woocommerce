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

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ref => {
  let {
    userData = {},
    note,
    options
  } = _ref;
  const {
    Template
  } = wecodeart;
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
const RATING_SUGGESTIONS = applyFilters('wecodeart.wecodeart.woocommerce.reviews.rating.suggestions', {
  1: [__('Not recommended', 'wca-woocommerce'), __('Very weak', 'wca-woocommerce'), __('Not happy', 'wca-woocommerce')],
  2: [__('Weak', 'wca-woocommerce'), __('I don\'t like it', 'wca-woocommerce'), __('Disappointing', 'wca-woocommerce')],
  3: [__('Decent', 'wca-woocommerce'), __('Acceptable', 'wca-woocommerce'), __('Ok', 'wca-woocommerce')],
  4: [__('Happy', 'wca-woocommerce'), __('I like it', 'wca-woocommerce'), __('Is worth it', 'wca-woocommerce'), __('Good', 'wca-woocommerce')],
  5: [__('Excelent', 'wca-woocommerce'), __('Very satisfied', 'wca-woocommerce'), __('Recommended', 'wca-woocommerce'), __('Cool', 'wca-woocommerce')]
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ref => {
  let {
    rating: star = 5
  } = _ref;
  const [current, setCurrent] = useState(RATING_SUGGESTIONS[star]);
  useEffect(() => setCurrent(RATING_SUGGESTIONS[star]), [star]);

  const onClick = e => document.forms['wca-woo-addreview'].elements['title'].value = e.currentTarget.textContent;

  const Button = _ref2 => {
    let {
      key,
      label
    } = _ref2;
    const props = {
      type: 'button',
      className: 'wp-element-button has-accent-background-color has-black-color rounded-pill me-2',
      key,
      onClick
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", props, label);
  };

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__suggestions d-flex flex-wrap align-items-center"
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
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_hook_form__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-hook-form */ "./node_modules/react-hook-form/dist/index.esm.js");
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ref => {
  let {
    rating,
    setRating,
    queryArgs,
    setQueryArgs,
    userData = false,
    options
  } = _ref;
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
    errors
  } = (0,react_hook_form__WEBPACK_IMPORTED_MODULE_1__.useForm)();

  const onClick = (value, e) => {
    const formElement = document.forms['wca-woo-addreview'];
    formElement.elements.rating.value = value;
    const starsBtns = Array.prototype.slice.call(formElement.querySelectorAll('.woocommerce-Reviews__star'));

    for (let i = 0; i < starsBtns.length; i++) starsBtns[i].classList.remove('active');

    e.currentTarget.className = 'active';
    setRating(value);
  };

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
    } finally {
      setLoading(false); // Reset Rating

      setTimeout(() => setRating(false), 3000); // Scroll to notification

      e.target.querySelector('#review-success').scrollIntoView({
        behavior: 'smooth',
        block: 'end'
      }); // Reset Reviews

      e.target.reset();
      setQueryArgs({ ...queryArgs
      });
    }
  };

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "grid"
  }, note && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "span-12 span-lg-4 start-lg-9"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Notification__WEBPACK_IMPORTED_MODULE_3__["default"], {
    userData,
    note,
    options
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "span-12 span-lg-7 order-lg-first"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    className: "woocommerce-Reviews__respond-form",
    name: "wca-woo-addreview",
    onSubmit: handleSubmit(onSubmit)
  }, doAction('wecodeart.woocommerce.reviews.newReview.top', register, errors, options), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_RatingInput__WEBPACK_IMPORTED_MODULE_4__["default"], {
    rating,
    setRating,
    onClick,
    register: register({
      validate: value => value !== 0
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "hidden",
    name: "rating",
    value: rating,
    ref: register({
      required: __('This cannot be empty!', 'wca-woocommerce'),
      minLength: 0,
      maxLength: 5
    })
  }))), !userData && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field grid"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3 span-12 span-md-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "mb-0 fw-700",
    for: "reviewer"
  }, __('Name', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "form-control",
    type: "text",
    name: "reviewer",
    id: "reviewer",
    ref: register({
      required: __('What is your name?', 'wca-woocommerce'),
      validate: value => value !== 'admin' || __('Nice Try', 'wca-woocommerce')
    }),
    placeholder: __('Name', 'wca-woocommerce')
  }), errors.reviewer && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("em", {
    class: "invalid-feedback d-block"
  }, errors.reviewer.message)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3 span-12 span-md-6"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "mb-0 fw-700",
    for: "reviewer_email"
  }, __('Email', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "form-control",
    type: "email",
    name: "reviewer_email",
    id: "reviewer_email",
    ref: register({
      required: __('What is your email address?', 'wca-woocommerce'),
      pattern: {
        value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
        message: __('Invalid email address.', 'wca-woocommerce')
      }
    }),
    placeholder: __('Email', 'wca-woocommerce')
  }), errors.reviewer_email && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("em", {
    class: "invalid-feedback d-block"
  }, errors.reviewer_email.message))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "mb-0 fw-700",
    for: "review_title"
  }, __('Review title (optional)', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    className: "form-control",
    type: "text",
    name: "title",
    id: "review_title",
    ref: register,
    placeholder: __('Use a suggestion or write your own title', 'wca-woocommerce')
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_SuggestTitle__WEBPACK_IMPORTED_MODULE_2__["default"], {
    rating: rating
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    className: "mb-0 fw-700",
    for: "review"
  }, __('Review', 'wca-woocommerce'), ":"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    className: "form-control",
    id: "review",
    name: "review",
    rows: "7",
    required: "",
    ref: register({
      required: __('This cannot be empty!', 'wca-woocommerce'),
      minLength: 20
    }),
    placeholder: __('Describe your experience with the product', 'wca-woocommerce')
  }), errors.review && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("em", {
    class: "invalid-feedback d-block"
  }, errors.review.type === 'minLength' ? __('Please be more descriptive.', 'wca-woocommerce') : errors.review.message))), doAction('wecodeart.woocommerce.reviews.newReview.bottom', register, errors, options), terms && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field woocommerce-Reviews__respond-field--terms"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "mb-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "has-small-font-size has-cyan-bluish-gray-color",
    dangerouslySetInnerHTML: {
      __html: terms
    }
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__respond-field"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "submit",
    className: "wp-element-button has-primary-background-color py-1",
    disabled: loading === true
  }, __('Add Review', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "mx-1"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: "javascript:void(0);",
    onClick: () => setRating(false),
    className: "wp-element-link"
  }, __('Cancel', 'wca-woocommerce')), message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    id: "review-success",
    className: "rounded has-accent-background-color p-3 mt-3"
  }, message))))));
});

/***/ })

}]);
//# sourceMappingURL=ReviewForm.js.map