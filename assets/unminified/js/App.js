"use strict";
(globalThis["webpackChunkwca_woocommerce"] = globalThis["webpackChunkwca_woocommerce"] || []).push([["App"],{

/***/ "./src/js/reviews/App.js":
/*!*******************************!*\
  !*** ./src/js/reviews/App.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   App: () => (/* binding */ App)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _summary__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./summary */ "./src/js/reviews/summary/index.js");
/* harmony import */ var _filters__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./filters */ "./src/js/reviews/filters/index.js");
/* harmony import */ var _listing_reviews__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./listing/reviews */ "./src/js/reviews/listing/reviews/index.js");
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./hooks */ "./src/js/reviews/hooks.js");
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./functions */ "./src/js/reviews/functions.js");
/* harmony import */ var react_use__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-use */ "./node_modules/react-use/esm/factory/createBreakpoint.js");








const {
  element: {
    useState,
    useEffect,
    lazy,
    Suspense
  }
} = wp;
const LeaveAReview = lazy(() => __webpack_require__.e(/*! import() | ReviewForm */ "ReviewForm").then(__webpack_require__.bind(__webpack_require__, /*! ./form */ "./src/js/reviews/form/index.js")));
const useBreakpoint = (0,react_use__WEBPACK_IMPORTED_MODULE_7__["default"])({
  mobile: 0,
  laptop: 992
});
const App = options => {
  const {
    headline = false,
    container = '#reviews',
    product: {
      ID: product_id,
      total
    },
    requestUrl,
    actions
  } = options;

  // State
  const [scroll, setScroll] = useState(false);
  const [rating, setRating] = useState(false);
  const [userData, setUserData] = useState(false);
  const [likedReviews, setLikedReviews] = useState([]);
  const [queryArgs, setQueryArgs] = useState({
    product_id,
    action: 'query'
  });

  // Load requested comments by filters
  const {
    loading,
    data: reviews,
    meta
  } = (0,_hooks__WEBPACK_IMPORTED_MODULE_5__.useApiFetch)({
    queryArgs
  });

  // Set User
  useEffect(() => {
    if (userData) return;
    (async () => {
      const formData = new FormData();
      formData.append('action', 'user');
      try {
        const r = await fetch(requestUrl, {
          method: 'POST',
          body: formData
        });
        const {
          token,
          status,
          liked
        } = await r.json();
        if (status) {
          const [reviewer, reviewer_email] = atob(token).split(':');
          setUserData({
            reviewer,
            reviewer_email,
            liked
          });
          setLikedReviews(liked);
        }
      } catch (e) {
        console.warn(e);
      }
    })();
  }, [userData]);

  // Scroll to Comments if rating
  useEffect(() => {
    if (scroll) {
      const scrollEl = document.querySelector(container);
      (0,_functions__WEBPACK_IMPORTED_MODULE_6__.scrollToElement)(scrollEl);
    }
    setScroll(true);
  }, [rating]);
  const breakpoint = useBreakpoint();
  const defaultProps = {
    options,
    rating,
    setRating,
    queryArgs,
    setQueryArgs,
    userData,
    breakpoint
  };
  const filtersProps = {
    options,
    loading,
    meta,
    queryArgs,
    setQueryArgs,
    breakpoint
  };
  const listingProps = {
    ...filtersProps,
    reviews,
    likedReviews,
    setLikedReviews,
    userData,
    actions
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, headline && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("h2", {
    className: "woocommerce-Reviews__headline"
  }, headline), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "has-border my-spacer"
  })), typeof rating === 'number' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(Suspense, {
    fallback: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", null, "Loading...")
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(LeaveAReview, defaultProps)), typeof rating === 'boolean' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_summary__WEBPACK_IMPORTED_MODULE_2__["default"], (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, defaultProps, {
    meta
  })), total > 0 && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_filters__WEBPACK_IMPORTED_MODULE_3__["default"], filtersProps), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_listing_reviews__WEBPACK_IMPORTED_MODULE_4__["default"], listingProps)));
};


/***/ }),

/***/ "./src/js/reviews/filters/ResultsNote.js":
/*!***********************************************!*\
  !*** ./src/js/reviews/filters/ResultsNote.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const {
  i18n: {
    __,
    _n,
    sprintf
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  totalResults = false,
  onReset
}) => {
  return totalResults !== false && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "has-accent-background-color",
    style: {
      padding: '1rem',
      borderRadius: '.25rem'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, sprintf(_n('We found %s result for your filters.', 'We found %s results for your filters.', totalResults, 'wca-woocommerce'), totalResults)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, " \xA0 "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: "javascript:void(0);",
    onClick: onReset
  }, __('Remove filters', 'wca-woocommerce'))));
});

/***/ }),

/***/ "./src/js/reviews/filters/index.js":
/*!*****************************************!*\
  !*** ./src/js/reviews/filters/index.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_hook_form__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-hook-form */ "./node_modules/react-hook-form/dist/index.esm.mjs");
/* harmony import */ var _ResultsNote__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ResultsNote */ "./src/js/reviews/filters/ResultsNote.js");
/* harmony import */ var _shared_Icon__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../shared/Icon */ "./src/js/reviews/shared/Icon.js");





const {
  i18n: {
    __,
    _n,
    sprintf
  },
  hooks: {
    applyFilters
  }
} = wp;
const SORTING_OPTIONS = applyFilters('wecodeart.woocommerce.reviews.sorting', {
  '': __('Recent', 'wca-woocommerce'),
  'rating': __('Rating', 'wca-woocommerce'),
  'likes': __('Popularity', 'wca-woocommerce')
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  queryArgs,
  setQueryArgs,
  loading,
  meta: {
    totalResults
  },
  options,
  breakpoint
}) => {
  const {
    product: {
      ID: product_id,
      counts
    },
    actions = [],
    verified
  } = options;
  let amount = {
    5: 0,
    4: 0,
    3: 0,
    2: 0,
    1: 0
  };
  amount = {
    ...amount,
    ...counts
  };
  const getLabel = v => sprintf(_n('%s star reviews', '%s stars reviews', v, 'wca-woocommerce'), v);
  const {
    handleSubmit,
    register,
    reset: resetForm
  } = (0,react_hook_form__WEBPACK_IMPORTED_MODULE_4__.useForm)({
    mode: 'onSubmit'
  });
  const onSubmit = values => {
    const result = {};
    for (const [k, v] of Object.entries(values)) {
      if (v !== '' && v !== false) result[k] = v;
    }
    setQueryArgs({
      product_id,
      ...result
    });
  };
  const onChange = () => setTimeout(handleSubmit(onSubmit), 20);
  const onReset = () => {
    resetForm();
    return onChange();
  };
  const style = {};
  if (loading) {
    style.pointerEvents = 'none';
    style.opacity = .65;
  }
  const includedIn = x => ['rating', 'verified', 'search'].includes(x);
  const hasFilters = Object.keys(queryArgs).map(includedIn).filter(Boolean).pop();
  if (actions?.like === false) {
    delete SORTING_OPTIONS.likes;
  }
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("form", {
    className: "woocommerce-Reviews__filters",
    onSubmit: handleSubmit(onSubmit),
    name: "wca-woo-filters",
    style: style
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "has-border my-spacer"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "grid"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-sm-6 span-lg-4"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "input-group input-group-sm"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    class: "input-group-text",
    for: "filter-orderby"
  }, __('Sort:', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("select", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-select",
    id: "filter-orderby"
  }, register('orderby', {
    onChange
  })), Object.keys(SORTING_OPTIONS).map(k => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("option", {
    value: k
  }, SORTING_OPTIONS[k]))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-sm-6 span-lg-4"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "input-group input-group-sm"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    class: "input-group-text",
    for: "filter-stars"
  }, __('Filter:', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("select", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-select",
    id: "filter-stars"
  }, register('rating', {
    onChange
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("option", {
    value: ""
  }, __('All reviews', 'wca-woocommerce')), Array(5).fill().reverse().map((_, i) => {
    const value = 5 - i;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("option", {
      disabled: amount[value] === 0,
      value
    }, getLabel(value));
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-sm-12 span-lg-4",
    style: {
      display: 'flex',
      alignItems: 'center'
    }
  }, verified && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "input-group input-group-sm",
    style: {
      width: 'auto',
      marginRight: 15
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "hidden",
    type: "checkbox",
    id: "filter-verified"
  }, register('verified', {
    onChange
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("label", {
    className: "wp-element-button has-accent-background-color",
    for: "filter-verified"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_shared_Icon__WEBPACK_IMPORTED_MODULE_3__["default"], {
    icon: "verified"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
    style: {
      marginLeft: 10,
      display: breakpoint === 'mobile' ? 'none' : 'inline-block'
    }
  }, __('Verified owner', 'wca-woocommerce')))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "input-group input-group-sm"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("input", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    type: "search",
    placeholder: __('Search in reviews', 'wca-woocommerce')
  }, register('search', {
    onBlur({
      target: {
        value
      }
    }) {
      if (value === '' && queryArgs.search !== undefined) {
        delete queryArgs.search;
        setQueryArgs({
          ...queryArgs
        });
      }
    }
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("button", {
    className: 'wp-element-button wp-block-search__button has-accent-background-color',
    style: {
      lineHeight: 1
    },
    type: 'submit'
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
    className: "screen-reader-text sr-text sr-only"
  }, __('Search in reviews', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
    className: "woocommerce-Reviews__icon woocommerce-Reviews__icon--search"
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "has-border my-spacer"
  }), !loading && hasFilters ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_ResultsNote__WEBPACK_IMPORTED_MODULE_2__["default"], {
    totalResults: totalResults,
    onReset: onReset
  }) : null);
});

/***/ }),

/***/ "./src/js/reviews/functions.js":
/*!*************************************!*\
  !*** ./src/js/reviews/functions.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   formatDate: () => (/* binding */ formatDate),
/* harmony export */   generateAvatarDataURL: () => (/* binding */ generateAvatarDataURL),
/* harmony export */   getInitials: () => (/* binding */ getInitials),
/* harmony export */   renderToString: () => (/* binding */ renderToString),
/* harmony export */   scrollToElement: () => (/* binding */ scrollToElement)
/* harmony export */ });
const formatDate = date => {
  const event = new Date(date);
  const options = {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  };
  return event.toLocaleDateString(undefined, options);
};
const scrollToElement = element => {
  if (element) {
    const headerEl = document.querySelector('.wp-site-header.sticky-top');
    const elementPosition = window.scrollY + element.getBoundingClientRect().top - 10;
    const scrollPosition = elementPosition - (headerEl ? headerEl.clientHeight : 0);
    window.scrollTo({
      top: scrollPosition,
      behavior: 'smooth'
    });
  }
};
const getInitials = name => {
  if (!name) {
    return 'AN';
  }
  const names = name.trim().split(' ');
  const initials = names.map(n => n[0].toUpperCase());
  return initials.join('');
};
const generateAvatarDataURL = (initials, size = 100, bgColor = '#007bff') => {
  const canvas = document.createElement('canvas');
  canvas.width = size;
  canvas.height = size;
  const ctx = canvas.getContext('2d');

  // Set background color
  ctx.fillStyle = bgColor;
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  // Set text style
  ctx.font = `${size / 2.5}px Arial`;
  ctx.fillStyle = '#ffffff'; // White text color

  // Calculate text metrics to center it on the canvas
  const textMetrics = ctx.measureText(initials);
  const x = (canvas.width - textMetrics.width) / 2;
  const y = (canvas.height + size / 4) / 2.5 + size / 4 - textMetrics.actualBoundingBoxAscent / 2.5;

  // Draw initials on the canvas
  ctx.fillText(initials, x, y);

  // Convert canvas to data URL
  const dataURL = canvas.toDataURL();
  return dataURL;
};
const renderToString = (string = '', variables = {}) => {
  const destruct = (obj, v) => v.split(/\.|\|/).reduce((v, k) => v?.[k], obj); // Multiple
  const rxp = /{{([^}]+)}}/g;
  let match;
  while (match = rxp.exec(string)) {
    const expression = match[1];
    const value = destruct(variables, expression.trim());
    if (value === undefined) continue;
    string = string.replace(new RegExp(`{{${expression}}}`, 'g'), value);
  }
  return string;
};


/***/ }),

/***/ "./src/js/reviews/hooks.js":
/*!*********************************!*\
  !*** ./src/js/reviews/hooks.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   useApiFetch: () => (/* binding */ useApiFetch),
/* harmony export */   useHover: () => (/* binding */ useHover)
/* harmony export */ });
const {
  element: {
    useEffect,
    useState,
    useRef,
    useReducer
  }
} = wp;
const {
  requestUrl,
  product: {
    total
  }
} = wpBlockWooReviews;

// Actions
const ACTIONS = {
  MAKE_REQUEST: 'make-request',
  SET_META: 'set-meta',
  GET_REVIEWS: 'get-reviews',
  GET_COMMENTS: 'get-comments',
  ERROR: 'error'
};

// Reducer
function reducer(state, action) {
  const {
    type,
    payload
  } = action;
  switch (type) {
    case ACTIONS.MAKE_REQUEST:
      return {
        ...state,
        loading: true,
        data: [],
        meta: {}
      };
    case ACTIONS.SET_META:
      const {
        meta
      } = payload;
      return {
        ...state,
        meta
      };
    case ACTIONS.GET_REVIEWS:
    case ACTIONS.GET_COMMENTS:
      const {
        data
      } = payload;
      return {
        ...state,
        loading: false,
        data
      };
    case ACTIONS.ERROR:
      const {
        error
      } = payload;
      return {
        ...state,
        loading: false,
        data: [],
        error
      };
    default:
      return state;
  }
}

/**
 * Function that fetches data using apiFetch, and updates the status.
 *
 * @param {string} path Query path.
 */
function useApiFetch({
  path = requestUrl,
  queryArgs = {},
  action = 'GET_REVIEWS'
}, hasReviews = total) {
  const [state, dispatch] = useReducer(reducer, {
    data: [],
    meta: {},
    loading: false,
    error: false
  });
  const formData = new FormData();
  formData.append('action', 'query');
  Object.keys(queryArgs).map(k => formData.append(k, queryArgs[k]));
  useEffect(() => {
    if (hasReviews === 0) return;
    dispatch({
      type: ACTIONS.MAKE_REQUEST
    });
    fetch(path, {
      method: 'POST',
      body: formData,
      parse: true
    }).then(r => r.json()).then(({
      meta,
      data
    }) => {
      dispatch({
        type: ACTIONS.SET_META,
        payload: {
          meta
        }
      });
      dispatch({
        type: ACTIONS[action],
        payload: {
          data
        }
      });
    }).catch(error => {
      dispatch({
        type: ACTIONS.ERROR,
        payload: {
          error
        }
      });
    }).finally(() => {});
  }, [queryArgs, total]);
  return state;
}

/**
 * Function that listens for hover.
 */
function useHover() {
  const [value, setValue] = useState(false);
  const ref = useRef(null);
  const handleMouseOver = e => setValue(e.target);
  const handleMouseOut = () => setValue(false);
  useEffect(() => {
    const node = ref.current;
    if (node) {
      // Add event listeners for mouse events
      node.addEventListener('mouseover', handleMouseOver);
      node.addEventListener('mouseout', handleMouseOut);

      // Add event listeners for touch events
      node.addEventListener('touchstart', handleMouseOver);
      node.addEventListener('touchend', handleMouseOut);
      return () => {
        // Remove event listeners for mouse events
        node.removeEventListener('mouseover', handleMouseOver);
        node.removeEventListener('mouseout', handleMouseOut);

        // Remove event listeners for touch events
        node.removeEventListener('touchstart', handleMouseOver);
        node.removeEventListener('touchend', handleMouseOut);
      };
    }
  }, [ref.current]);
  return [ref, value];
}


/***/ }),

/***/ "./src/js/reviews/listing/comments/AddComment.js":
/*!*******************************************************!*\
  !*** ./src/js/reviews/listing/comments/AddComment.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_hook_form__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-hook-form */ "./node_modules/react-hook-form/dist/index.esm.mjs");



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
  addComment,
  setAddComment,
  productId,
  requestUrl
}) => {
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState(false);
  const {
    handleSubmit,
    register,
    formState: {
      errors
    }
  } = (0,react_hook_form__WEBPACK_IMPORTED_MODULE_2__.useForm)({
    mode: 'onSubmit',
    defaultValues: {
      comment: ''
    }
  });
  const onSubmit = async values => {
    if (loading) {
      return;
    }
    const formData = new FormData();
    formData.append('action', 'comment');
    formData.append('product_id', productId);
    formData.append('parent', addComment);
    Object.keys(values).map(k => formData.append(k, values[k]));
    setLoading(true);
    try {
      const r = await fetch(requestUrl, {
        method: 'POST',
        body: formData
      });
      const {
        message
      } = await r.json();
      return setMessage(message);
    } finally {
      setLoading(false);
      setTimeout(() => setAddComment(false), 5000);
    }
  };
  console.log(errors);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, message ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "has-accent-background-color my-spacer",
    style: {
      padding: '1rem',
      borderRadius: '.25rem'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("p", null, message)) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("form", {
    className: "woocommerce-Reviews__comment",
    onSubmit: handleSubmit(onSubmit),
    name: "wca-woo-comment"
  }, doAction('wecodeart.woocommerce.reviews.newComment.top', register, errors, productId), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "position-relative my-spacer"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("textarea", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: "form-control",
    id: "comment",
    rows: "7",
    placeholder: __('Your comment', 'wca-woocommerce')
  }, register('comment', {
    required: __('This cannot be empty!', 'wca-woocommerce'),
    minLength: 20
  }))), errors.comment && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    class: "invalid-feedback",
    style: {
      display: 'block'
    }
  }, errors.comment.type === 'minLength' ? __('Comment is too short.', 'wca-woocommerce') : errors.comment.message)), doAction('wecodeart.woocommerce.reviews.newComment.bottom', register, errors, productId), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("button", {
    type: 'submit',
    className: 'wp-element-button has-primary-background-color',
    disabled: loading === true || errors.comment === false || errors.comment
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", null, loading ? __('Submitting...', 'wca-woocommerce') : __('Add Comment', 'wca-woocommerce')))));
});

/***/ }),

/***/ "./src/js/reviews/listing/preloaders/ReviewPreloader.js":
/*!**************************************************************!*\
  !*** ./src/js/reviews/listing/preloaders/ReviewPreloader.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (`<svg
	role="img"
	width="1024"
	height="150"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 150"
	preserveAspectRatio="none"
	style="width:100%;height:auto;"
>
	<title id="loading-aria">Loading...</title>
	<rect
		x="0"
		y="0"
		width="100%"
		height="100%"
		clip-path="url(#clip-path)"
		style='fill: url("#fill");'
	></rect>
	<defs>
		<clipPath id="clip-path">
			<circle cx="25" cy="40" r="25"></circle>
			<rect x="0" y="100" rx="3" ry="3" width="150" height="8"></rect>
			<rect x="0" y="115" rx="3" ry="3" width="75" height="6"></rect>
			<rect x="265" y="15" rx="3" ry="3" width="400" height="10"></rect>
			<rect x="265" y="35" rx="3" ry="3" width="75" height="8"></rect>
			<rect x="355" y="35" rx="3" ry="3" width="130" height="8"></rect>
			<rect x="265" y="65" rx="3" ry="3" width="750" height="6"></rect>
			<rect x="265" y="80" rx="3" ry="3" width="680" height="6"></rect>
			<rect x="265" y="95" rx="3" ry="3" width="630" height="6"></rect>
			<rect x="265" y="110" rx="3" ry="3" width="130" height="6"></rect>
		</clipPath>
		<linearGradient id="fill">
			<stop
				offset="0.599964"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-2; -2; 1"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="1.59996"
				stop-color="#ecebeb"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-1; -1; 2"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="2.59996"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="0; 0; 3"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
		</linearGradient>
	</defs>
</svg>`);

/***/ }),

/***/ "./src/js/reviews/listing/preloaders/ReviewPreloaderMobile.js":
/*!********************************************************************!*\
  !*** ./src/js/reviews/listing/preloaders/ReviewPreloaderMobile.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (`<svg
	role="img"
	width="1024"
	height="460"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 450"
	preserveAspectRatio="none"
	style="width:100%;height:auto;"
>
	<title id="loading-aria">Loading...</title>
	<rect
		x="0"
		y="0"
		width="100%"
		height="100%"
		clip-path="url(#clip-path)"
		style='fill: url("#fill");'
	></rect>
	<defs>
		<clipPath id="clip-path">
			<circle cx="100" cy="110" r="100"></circle>
			<rect x="265" y="50" rx="3" ry="3" width="380" height="25"></rect>
			<rect x="265" y="100" rx="3" ry="3" width="150" height="20"></rect>
			<rect x="0" y="240" rx="3" ry="3" width="500" height="20"></rect>
			<rect x="0" y="270" rx="3" ry="3" width="220" height="20"></rect>
			<rect x="0" y="320" rx="3" ry="3" width="980" height="20"></rect>
			<rect x="0" y="350" rx="3" ry="3" width="880" height="20"></rect>
			<rect x="0" y="400" rx="3" ry="3" width="400" height="20"></rect>
		</clipPath>
		<linearGradient id="fill">
			<stop
				offset="0.599964"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-2; -2; 1"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="1.59996"
				stop-color="#ecebeb"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-1; -1; 2"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="2.59996"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="0; 0; 3"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
		</linearGradient>
	</defs>
</svg>`);

/***/ }),

/***/ "./src/js/reviews/listing/reviews/Pagination.js":
/*!******************************************************!*\
  !*** ./src/js/reviews/listing/reviews/Pagination.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../functions */ "./src/js/reviews/functions.js");


const {
  i18n: {
    __
  },
  element: {
    useEffect,
    useState
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  loading,
  queryArgs,
  setQueryArgs,
  totalPages: total
}) => {
  const {
    page = 1
  } = queryArgs;
  const [scroll, setScroll] = useState(false);
  const setPage = p => setQueryArgs({
    ...queryArgs,
    page: Math.min(Math.max(p, 1), total)
  });
  useEffect(() => {
    if (scroll) {
      const scrollEl = document.forms['wca-woo-filters'];
      (0,_functions__WEBPACK_IMPORTED_MODULE_1__.scrollToElement)(scrollEl);
    }
    setScroll(true);
  }, [page]);
  const ReaderText = ({
    text
  }) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    class: "screen-reader-text"
  }, text);
  const renderAdjacent = (prev = false) => {
    const goToPage = prev ? page - 1 : page + 1;
    const isPrevDisabled = [prev === true && page === 1 ? 'disabled' : ''];
    const isNextDisabled = [prev === false && page === parseFloat(total) ? 'disabled' : ''];
    const classNames = ['woocommerce-Reviews__pagination-item', 'woocommerce-Reviews__pagination-item--' + (prev ? 'prev' : 'next'), ...isPrevDisabled, ...isNextDisabled].filter(Boolean);
    const isDisabled = prev === true && page === 1 || prev === false && page === parseFloat(total);
    const props = {
      className: 'woocommerce-Reviews__pagination-link',
      href: !isDisabled ? 'javascript:void(0);' : null,
      onClick: !isDisabled ? () => setPage(goToPage) : null
    };
    const Inner = () => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      "aria-hidden": "true",
      dangerouslySetInnerHTML: {
        __html: prev ? '&laquo;' : '&raquo;'
      }
    });
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
      className: classNames.join(' ')
    }, isDisabled ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", props, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Inner, null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ReaderText, {
      text: __('Next page', 'wca-woocommerce')
    })) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", props, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Inner, null), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ReaderText, {
      text: __('Previous page', 'wca-woocommerce')
    })));
  };
  const generateDots = () => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    className: "woocommerce-Reviews__pagination-item woocommerce-Reviews__pagination-item--dots"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "woocommerce-Reviews__pagination-link"
  }, "...", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ReaderText, {
    text: __('dots', 'wca-woocommerce')
  })));
  const generateLink = p => {
    const isCurrent = parseFloat(p) === page;
    const classNames = ['woocommerce-Reviews__pagination-link', ...[isCurrent ? 'has-primary-background-color' : '']].filter(Boolean);
    const props = {
      className: classNames.join(' '),
      href: !isCurrent ? 'javascript:void(0);' : null,
      onClick: !isCurrent ? () => setPage(p) : null,
      'aria-current': isCurrent ? 'page' : null
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
      className: ['woocommerce-Reviews__pagination-item', ...[isCurrent ? 'woocommerce-Reviews__pagination-item--current' : '']].filter(Boolean).join(' ')
    }, isCurrent ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", props, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ReaderText, {
      text: __('Page', 'wca-woocommerce')
    }), " ", p) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", props, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(ReaderText, {
      text: __('Page', 'wca-woocommerce')
    }), " ", p));
  };
  const generateLinks = () => {
    let d = 2,
      range = [];
    for (let i = Math.max(2, page - d); i <= Math.min(total - 1, page + d); i++) range.push(generateLink(i));
    if (page + d < total - 1) range.push(generateDots());
    if (page - d > 2) range.unshift(generateDots());
    range.unshift(generateLink(1));
    range.push(generateLink(total));
    return range;
  };
  const style = {};
  if (loading) {
    style.pointerEvents = 'none';
    style.opacity = .65;
  }
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("nav", {
    className: "woocommerce-Reviews__pagination",
    "aria-label": __('Reviews pagination', 'wca-woocommerce')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    className: "woocommerce-Reviews__pagination-list",
    style: style
  }, renderAdjacent(true), generateLinks(), renderAdjacent()));
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/ReviewItem.js":
/*!******************************************************!*\
  !*** ./src/js/reviews/listing/reviews/ReviewItem.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./actions */ "./src/js/reviews/listing/reviews/actions/index.js");
/* harmony import */ var _shared_StarRating__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../shared/StarRating */ "./src/js/reviews/shared/StarRating.js");
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../functions */ "./src/js/reviews/functions.js");
/* harmony import */ var _shared_Icon__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../shared/Icon */ "./src/js/reviews/shared/Icon.js");






const {
  i18n: {
    __,
    sprintf
  },
  hooks: {
    applyFilters
  },
  element: {
    useState
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  review,
  options,
  userData = false,
  addComment,
  setAddComment,
  onAddComment,
  likedReviews,
  setLikedReviews
}) => {
  const {
    id: reviewId,
    content,
    title = '',
    date,
    rating,
    replies,
    verified,
    author: {
      name: authorName,
      avatar: authorAvatar = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89B8AAskB44g04okAAAAASUVORK5CYII='
    }
  } = review;
  const {
    actions = {
      like: true,
      comment: true
    },
    avatar
  } = options;
  const defaultProps = {
    review,
    options,
    userData
  };
  const [comments, setComments] = useState([]);
  const [loading, setLoading] = useState(false);
  const defaultActions = [{
    key: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Like.key, null),
    Component: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Like.Component, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, defaultProps, {
      likedReviews,
      setLikedReviews
    }))
  }, {
    key: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Replies.key, null),
    Component: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Replies.Component, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, defaultProps, {
      loading,
      setLoading,
      comments,
      setComments
    })),
    After: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Replies.After, {
      loading,
      comments: loading ? Array(replies.length).fill() : comments,
      avatar
    })
  }, {
    key: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Comment.key, null),
    Component: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Comment.Component, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, defaultProps, {
      onAddComment
    })),
    After: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_actions__WEBPACK_IMPORTED_MODULE_2__.Comment.After, (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, defaultProps, {
      addComment,
      setAddComment
    }))
  }];
  const enabledActions = Object.keys(actions).filter(k => actions[k] === true);
  let reviewActions = applyFilters('wecodeart.woocommerce.reviews.actions', defaultActions, review, options, userData);

  // Filter the defaultActions array based on enabledActions
  reviewActions = reviewActions.filter(({
    key: {
      type
    }
  }) => {
    if (type === 'comments' && enabledActions.includes('comment')) {
      return true;
    }
    return enabledActions.includes(type);
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__item has-border",
    id: `review-${reviewId}`,
    key: reviewId
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "grid",
    style: {
      paddingTop: '1rem',
      paddingBottom: '1rem'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-md-2 span-lg-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "grid",
    style: {
      alignItems: 'center'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-3 span-sm-2 span-md-12"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("img", {
    width: 65,
    src: avatar === 'initials' ? (0,_functions__WEBPACK_IMPORTED_MODULE_4__.generateAvatarDataURL)((0,_functions__WEBPACK_IMPORTED_MODULE_4__.getInitials)(authorName), 150) : authorAvatar,
    alt: sprintf(__("%s's Avatar", 'wca-woocommerce'), authorName)
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-9 span-sm-10 span-md-12"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("strong", {
    style: {
      display: 'block'
    }
  }, authorName), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    className: "has-small-font-size has-cyan-bluish-gray-color"
  }, (0,_functions__WEBPACK_IMPORTED_MODULE_4__.formatDate)(date))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-md-10 span-lg-9 is-layout-flow"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__item-meta has-small-font-size"
  }, title && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("h5", {
    className: "woocommerce-Reviews__item-title"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("strong", null, title)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_shared_StarRating__WEBPACK_IMPORTED_MODULE_3__["default"], {
    rating: rating,
    className: "has-small-font-size"
  }), verified && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", {
    className: "woocommerce-Reviews__item-verified"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_shared_Icon__WEBPACK_IMPORTED_MODULE_5__["default"], {
    icon: "verified"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("em", {
    className: "has-cyan-bluish-gray-color"
  }, __('Verified Purchase', 'wca-woocommerce')))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__item-content",
    dangerouslySetInnerHTML: {
      __html: content
    }
  }), reviewActions.length > 0 && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__item-actions"
  }, reviewActions.map(({
    Component = null
  }) => Component)), reviewActions.reverse().map(({
    After = null
  }) => After)))));
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/actions/Action.js":
/*!**********************************************************!*\
  !*** ./src/js/reviews/listing/reviews/actions/Action.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shared_Icon__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../shared/Icon */ "./src/js/reviews/shared/Icon.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  icon = false,
  label,
  children,
  ...rest
}) => {
  rest = {
    className: 'wp-element-button has-background has-black-color has-small-font-size',
    ...rest
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", rest, icon && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_Icon__WEBPACK_IMPORTED_MODULE_1__["default"], {
    icon: icon
  }), label && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "wp-element-button__label"
  }, label), children);
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/actions/Comment.js":
/*!***********************************************************!*\
  !*** ./src/js/reviews/listing/reviews/actions/Comment.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Action__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Action */ "./src/js/reviews/listing/reviews/actions/Action.js");
/* harmony import */ var _comments_AddComment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../comments/AddComment */ "./src/js/reviews/listing/comments/AddComment.js");



const {
  i18n: {
    __
  }
} = wp;
const Component = ({
  review,
  userData,
  onAddComment
}) => {
  if (userData) {
    const {
      id: reviewId
    } = review;
    const onClick = () => onAddComment(reviewId);
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Action__WEBPACK_IMPORTED_MODULE_1__["default"], {
      label: __('Add Comment', 'wca-woocommerce'),
      icon: 'comment',
      onClick
    });
  }
  return null;
};
const After = ({
  review,
  options,
  addComment,
  setAddComment
}) => {
  const {
    id: reviewId
  } = review;
  const {
    product: {
      ID: productId
    },
    requestUrl
  } = options;
  if (addComment === reviewId) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_comments_AddComment__WEBPACK_IMPORTED_MODULE_2__["default"], {
      addComment,
      setAddComment,
      productId,
      requestUrl
    });
  }
  return null;
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  key: 'comment',
  Component,
  After
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/actions/Like.js":
/*!********************************************************!*\
  !*** ./src/js/reviews/listing/reviews/actions/Like.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Action__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Action */ "./src/js/reviews/listing/reviews/actions/Action.js");


const {
  element: {
    useState
  }
} = wp;
const Component = ({
  review,
  options,
  likedReviews,
  setLikedReviews,
  userData
}) => {
  const {
    id: reviewId,
    likes: hasLikes
  } = review;
  const {
    requestUrl
  } = options;
  const isReviewLiked = likedReviews.includes(parseInt(reviewId));
  const [likes, setLikes] = useState(hasLikes);
  const [liking, setLiking] = useState(false);
  let actionProps = {
    icon: isReviewLiked ? 'liked' : 'like',
    disabled: liking === true
  };
  if (userData) {
    const onClick = async () => {
      if (liking) return;
      setLiking(true);
      const formData = new FormData();
      formData.append('action', 'like');
      formData.append('review_id', reviewId);
      try {
        const r = await fetch(requestUrl, {
          method: 'POST',
          body: formData
        });
        const {
          likes
        } = await r.json();
        setLikes(likes);
        const newLiked = isReviewLiked ? likedReviews.filter(i => parseInt(i) !== parseInt(reviewId)) : [...likedReviews, reviewId];
        setLikedReviews(newLiked);
      } finally {
        setLiking(false);
      }
    };
    actionProps = {
      ...actionProps,
      onClick
    };
  }
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Action__WEBPACK_IMPORTED_MODULE_1__["default"], actionProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "count"
  }, "(", likes, ")"));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  key: 'like',
  Component
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/actions/Replies.js":
/*!***********************************************************!*\
  !*** ./src/js/reviews/listing/reviews/actions/Replies.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Action__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Action */ "./src/js/reviews/listing/reviews/actions/Action.js");
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../functions */ "./src/js/reviews/functions.js");



const {
  i18n: {
    __
  },
  element: {
    useState,
    useEffect,
    lazy,
    Suspense
  }
} = wp;
const CommentsList = lazy(() => __webpack_require__.e(/*! import() | CommentList */ "CommentList").then(__webpack_require__.bind(__webpack_require__, /*! ../../comments */ "./src/js/reviews/listing/comments/index.js")));
const Component = ({
  review,
  options,
  comments,
  setComments,
  loading,
  setLoading
}) => {
  const {
    replies = [],
    id: reviewId
  } = review;
  const {
    requestUrl
  } = options;
  const [scroll, setScroll] = useState(false);
  useEffect(() => {
    if (scroll) {
      const containerEl = document.querySelector(`#review-${reviewId}`);
      (0,_functions__WEBPACK_IMPORTED_MODULE_2__.scrollToElement)(containerEl);
    }
    setScroll(true);
  }, [comments]);
  if (replies.length) {
    const onClick = async e => {
      if (loading) {
        return;
      }
      if (comments.length) {
        const container = e.currentTarget.parentNode.parentNode.querySelector('.woocommerce-Reviews__listing--comments');
        if (container) {
          container.style.display = container?.style?.display === 'none' ? 'block' : 'none';
          return;
        }
      }
      const formData = new FormData();
      formData.append('action', 'query');
      formData.append('include', replies);
      setLoading(true);
      try {
        const r = await fetch(requestUrl, {
          method: 'POST',
          body: formData
        });
        const {
          data
        } = await r.json();
        return setComments(data);
      } catch (e) {
        console.warn(e);
        setComments([]);
      } finally {
        setLoading(false);
      }
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Action__WEBPACK_IMPORTED_MODULE_1__["default"], {
      label: __('View Comments', 'wca-woocommerce'),
      icon: 'comments',
      onClick
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "count"
    }, " (", replies.length, ") "));
  }
};
const After = ({
  loading,
  comments,
  avatar
}) => {
  if (comments.length) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(Suspense, {
      fallback: (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, "Loading...")
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(CommentsList, {
      comments,
      loading,
      avatar
    }));
  }
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  key: 'comments',
  Component,
  After
});

/***/ }),

/***/ "./src/js/reviews/listing/reviews/actions/index.js":
/*!*********************************************************!*\
  !*** ./src/js/reviews/listing/reviews/actions/index.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Comment: () => (/* reexport safe */ _Comment__WEBPACK_IMPORTED_MODULE_1__["default"]),
/* harmony export */   Like: () => (/* reexport safe */ _Like__WEBPACK_IMPORTED_MODULE_0__["default"]),
/* harmony export */   Replies: () => (/* reexport safe */ _Replies__WEBPACK_IMPORTED_MODULE_2__["default"])
/* harmony export */ });
/* harmony import */ var _Like__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Like */ "./src/js/reviews/listing/reviews/actions/Like.js");
/* harmony import */ var _Comment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Comment */ "./src/js/reviews/listing/reviews/actions/Comment.js");
/* harmony import */ var _Replies__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Replies */ "./src/js/reviews/listing/reviews/actions/Replies.js");




/***/ }),

/***/ "./src/js/reviews/listing/reviews/index.js":
/*!*************************************************!*\
  !*** ./src/js/reviews/listing/reviews/index.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _ReviewItem__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ReviewItem */ "./src/js/reviews/listing/reviews/ReviewItem.js");
/* harmony import */ var _Pagination__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./Pagination */ "./src/js/reviews/listing/reviews/Pagination.js");
/* harmony import */ var _preloaders_ReviewPreloader__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../preloaders/ReviewPreloader */ "./src/js/reviews/listing/preloaders/ReviewPreloader.js");
/* harmony import */ var _preloaders_ReviewPreloaderMobile__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../preloaders/ReviewPreloaderMobile */ "./src/js/reviews/listing/preloaders/ReviewPreloaderMobile.js");
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../functions */ "./src/js/reviews/functions.js");







const {
  url: {
    isValidFragment
  },
  element: {
    useEffect,
    useState
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  loading,
  reviews = [],
  likedReviews = [],
  setLikedReviews,
  meta,
  queryArgs,
  setQueryArgs,
  userData,
  options,
  breakpoint
}) => {
  const {
    amount
  } = options;
  const {
    hash
  } = window.location;
  const rId = isValidFragment(hash) && hash.split('-').pop();
  const [addComment, setAddComment] = useState(false);
  const onAddComment = id => addComment !== id ? setAddComment(id) : setAddComment(false);
  useEffect(() => {
    if (loading) return;
    const scrollEl = document.getElementById(`review-${rId}`);
    (0,_functions__WEBPACK_IMPORTED_MODULE_6__.scrollToElement)(scrollEl);
  }, [loading, rId]);
  const {
    totalPages
  } = meta;
  const preloader = breakpoint === 'mobile' ? _preloaders_ReviewPreloaderMobile__WEBPACK_IMPORTED_MODULE_5__["default"] : _preloaders_ReviewPreloader__WEBPACK_IMPORTED_MODULE_4__["default"];
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__listing is-layout-flow"
  }, loading && Array(parseInt(amount)).fill().map((_, i) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    key: i,
    dangerouslySetInnerHTML: {
      __html: preloader
    }
  })), !loading && reviews.map(review => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_ReviewItem__WEBPACK_IMPORTED_MODULE_2__["default"], {
    review,
    likedReviews,
    setLikedReviews,
    userData,
    addComment,
    onAddComment,
    setAddComment,
    options
  }))), totalPages > 1 && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_Pagination__WEBPACK_IMPORTED_MODULE_3__["default"], (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, meta, {
    loading,
    queryArgs,
    setQueryArgs
  })));
});

/***/ }),

/***/ "./src/js/reviews/shared/Icon.js":
/*!***************************************!*\
  !*** ./src/js/reviews/shared/Icon.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  icon = 'default',
  ...rest
}) => {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({
    className: `woocommerce-Reviews__icon woocommerce-Reviews__icon--${icon}`,
    role: "img"
  }, rest));
});

/***/ }),

/***/ "./src/js/reviews/shared/RatingInput.js":
/*!**********************************************!*\
  !*** ./src/js/reviews/shared/RatingInput.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../hooks */ "./src/js/reviews/hooks.js");
/* harmony import */ var _Icon__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Icon */ "./src/js/reviews/shared/Icon.js");



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
const RATING_LABELS = applyFilters('wecodeart.woocommerce.reviews.rating.labels', {
  1: __('Not recommended', 'wca-woocommerce'),
  2: __('Weak', 'wca-woocommerce'),
  3: __('Acceptable', 'wca-woocommerce'),
  4: __('Good', 'wca-woocommerce'),
  5: __('Excelent', 'wca-woocommerce')
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  rating = 0,
  onClick,
  children
}) => {
  const [refHover, isHovered] = (0,_hooks__WEBPACK_IMPORTED_MODULE_1__.useHover)();
  const [ratingLabel, setRatingLabel] = useState('');
  const hoverLabel = isHovered && isHovered.closest('[aria-label]')?.getAttribute('aria-label');
  useEffect(() => {
    if (rating) {
      setRatingLabel(RATING_LABELS[rating]);
    }
  }, [rating]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__rating woocommerce-Reviews__rating--input"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__rating-range",
    ref: refHover
  }, Object.entries(RATING_LABELS).reverse().map(item => {
    const [star, label] = item;
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: ['has-background', parseInt(star) === parseInt(rating) ? 'active' : ''].filter(Boolean).join(' '),
      type: 'button',
      onClick: e => onClick(parseFloat(star), e),
      'aria-label': label
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Icon__WEBPACK_IMPORTED_MODULE_2__["default"], {
      icon: "rating"
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "screen-reader-text"
    }, label));
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", {
    className: "woocommerce-Reviews__rating-hover"
  }, hoverLabel || ratingLabel || __('Your rating', 'wca-woocommerce')), children));
});

/***/ }),

/***/ "./src/js/reviews/shared/StarRating.js":
/*!*********************************************!*\
  !*** ./src/js/reviews/shared/StarRating.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _Icon__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Icon */ "./src/js/reviews/shared/Icon.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  rating = 0.0,
  percent = false,
  className = 'has-medium-font-size'
}) => {
  const generateStars = a => [5, 4, 3, 2, 1].map(i => {
    const className = ['has-background', parseInt(a) === i ? 'active' : ''].filter(Boolean).join(' ');
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
      className: className,
      key: i
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_Icon__WEBPACK_IMPORTED_MODULE_1__["default"], {
      icon: "rating"
    }));
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `woocommerce-Reviews__rating ${className}`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__rating-range"
  }, generateStars(!percent && rating)), percent && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: 'woocommerce-Reviews__rating-overlay',
    style: {
      width: (rating / 5 * 100).toString() + '%',
      overflow: 'hidden'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__rating-range"
  }, generateStars(percent))));
});

/***/ }),

/***/ "./src/js/reviews/summary/AddReview.js":
/*!*********************************************!*\
  !*** ./src/js/reviews/summary/AddReview.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shared_RatingInput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../shared/RatingInput */ "./src/js/reviews/shared/RatingInput.js");


const {
  i18n: {
    __,
    sprintf
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  setRating,
  userData: {
    reviewer = false
  },
  options = {}
}) => {
  const {
    product: {
      verify = false
    }
  } = options;
  const showMessage = reviewer === false && verify;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-new"
  }, showMessage ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "woocommerce-Reviews__summary-message",
    dangerouslySetInnerHTML: {
      __html: verify
    }
  })) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "has-normal-font-size",
    style: {
      marginBottom: 10
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, reviewer ? sprintf(__('Hey %s. Welcome back!', 'wca-woocommerce'), reviewer) : __('Do you own or used the product?', 'wca-woocommerce'))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "has-small-font-size has-cyan-bluish-gray-color",
    style: {
      marginBottom: 10
    }
  }, __('Tell your opinion by giving it a rating', 'wca-woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_RatingInput__WEBPACK_IMPORTED_MODULE_1__["default"], {
    onClick: setRating,
    style: {
      marginBottom: 10
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "wp-element-button has-primary-background-color has-small-font-size",
    onClick: () => setRating(5)
  }, __('Add a review', 'wca-woocommerce'))));
});

/***/ }),

/***/ "./src/js/reviews/summary/RatingBars.js":
/*!**********************************************!*\
  !*** ./src/js/reviews/summary/RatingBars.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const {
  i18n: {
    _n,
    sprintf
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  amount = {
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0
  },
  total = 0,
  queryArgs,
  setQueryArgs
}) => {
  const onClick = e => {
    e.preventDefault();
    const filterForms = document.forms['wca-woo-filters'];
    const clickedValue = e.currentTarget.dataset.value;
    const fieldElement = filterForms.elements.rating;
    if (clickedValue !== fieldElement.value) {
      fieldElement.value = clickedValue;
      setQueryArgs({
        ...queryArgs,
        rating: clickedValue
      });
    }
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-bars",
    style: {
      display: 'table',
      width: '100%'
    }
  }, Array(5).fill().reverse().map((_, i) => {
    const value = 5 - i;
    const count = amount[value];
    const calc = count ? count / total * 100 : 0;
    const width = calc.toString() + '%';
    const label = sprintf(_n('%s star', '%s stars', value, 'wca-woocommerce'), value);
    const cellStyle = {
      display: 'table-cell',
      paddingTop: 8,
      paddingBottom: 8,
      whiteSpace: 'nowrap',
      lineHeight: 1
    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      key: i,
      href: parseInt(count) ? 'javascript:void(0);' : null,
      onClick: parseInt(count) !== 0 ? onClick : null,
      style: {
        display: 'table-row',
        backgroundColor: 'transparent'
      },
      'data-value': value
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: cellStyle
    }, label), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: {
        ...cellStyle,
        padding: 8,
        width: '100%'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "has-accent-background-color",
      style: {
        width: '100%',
        borderRadius: 50,
        overflow: 'hidden'
      }
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "has-primary-background-color",
      role: "progressbar",
      style: {
        width,
        minHeight: 12
      }
    }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      style: cellStyle
    }, "(", count, ")"));
  }));
});

/***/ }),

/***/ "./src/js/reviews/summary/RatingData.js":
/*!**********************************************!*\
  !*** ./src/js/reviews/summary/RatingData.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shared_StarRating__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../shared/StarRating */ "./src/js/reviews/shared/StarRating.js");


const {
  i18n: {
    _n,
    sprintf
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  average = 0.0,
  total = 0
}) => {
  const labelElement = _n('%s review', '%s reviews', total, 'wca-woocommerce');
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-info is-layout-flow",
    style: {
      textAlign: 'center'
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    style: {
      lineHeight: 1,
      fontWeight: 700
    }
  }, parseFloat(average).toFixed(2)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_StarRating__WEBPACK_IMPORTED_MODULE_1__["default"], {
    rating: average,
    percent: 5
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "has-small-font-size has-cyan-bluish-gray-color"
  }, sprintf(labelElement, total)));
});

/***/ }),

/***/ "./src/js/reviews/summary/RatingStats.js":
/*!***********************************************!*\
  !*** ./src/js/reviews/summary/RatingStats.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _shared_Icon__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../shared/Icon */ "./src/js/reviews/shared/Icon.js");


const {
  i18n: {
    __
  },
  element: {
    useRef,
    useEffect
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  average = 0.0,
  verified = 0,
  verifiedBadge
}) => {
  var _verifiedRef$current;
  const verifiedRef = useRef();

  // Update once and maintain it.
  useEffect(() => {
    verifiedRef.current = verified;
  }, [verified]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-stats"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-stats__1"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_Icon__WEBPACK_IMPORTED_MODULE_1__["default"], {
    icon: "recommend",
    style: {
      marginRight: 15
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "has-black-color"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, parseInt(average / 5 * 100) + '%')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "has-small-font-size has-cyan-bluish-gray-color"
  }, __('of the clients recommend the product', 'wca-woocommerce'))), verifiedBadge && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "my-spacer has-border"
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__summary-stats__2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_shared_Icon__WEBPACK_IMPORTED_MODULE_1__["default"], {
    icon: "verified",
    style: {
      marginRight: 15
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "has-black-color"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (_verifiedRef$current = verifiedRef.current) !== null && _verifiedRef$current !== void 0 ? _verifiedRef$current : verified), "\xA0\xA0"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "has-small-font-size has-cyan-bluish-gray-color"
  }, __('of the reviews are verified purchases', 'wca-woocommerce')))));
});

/***/ }),

/***/ "./src/js/reviews/summary/index.js":
/*!*****************************************!*\
  !*** ./src/js/reviews/summary/index.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/helpers/extends */ "./node_modules/@babel/runtime/helpers/esm/extends.js");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _AddReview__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./AddReview */ "./src/js/reviews/summary/AddReview.js");
/* harmony import */ var _RatingData__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./RatingData */ "./src/js/reviews/summary/RatingData.js");
/* harmony import */ var _RatingBars__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./RatingBars */ "./src/js/reviews/summary/RatingBars.js");
/* harmony import */ var _RatingStats__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./RatingStats */ "./src/js/reviews/summary/RatingStats.js");






/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (({
  options,
  rating,
  setRating,
  queryArgs,
  setQueryArgs,
  userData,
  meta,
  breakpoint
}) => {
  let amount = {
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0
  };
  const {
    product: {
      average,
      total,
      counts
    },
    verified: verifiedBadge
  } = options;
  const {
    verified
  } = meta;
  amount = {
    ...amount,
    ...counts
  };
  const dataProps = {
    amount,
    average,
    total
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "woocommerce-Reviews__summary"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "grid"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-sm-6 span-lg-2"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_RatingData__WEBPACK_IMPORTED_MODULE_3__["default"], dataProps)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-sm-6 span-lg-3 start-lg-7"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_RatingStats__WEBPACK_IMPORTED_MODULE_5__["default"], {
    average,
    verified,
    verifiedBadge
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-lg-3 start-lg-10"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_AddReview__WEBPACK_IMPORTED_MODULE_2__["default"], {
    rating,
    setRating,
    userData,
    options
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", {
    className: "span-12 span-lg-4 start-lg-3",
    style: {
      gridRowStart: breakpoint === 'mobile' ? 'initial' : 1
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_1__.createElement)(_RatingBars__WEBPACK_IMPORTED_MODULE_4__["default"], (0,_babel_runtime_helpers_extends__WEBPACK_IMPORTED_MODULE_0__["default"])({}, dataProps, {
    queryArgs,
    setQueryArgs
  })))));
});

/***/ })

}]);
//# sourceMappingURL=App.js.map