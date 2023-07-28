"use strict";
(globalThis["webpackChunkwca_woocommerce"] = globalThis["webpackChunkwca_woocommerce"] || []).push([["CommentList"],{

/***/ "./src/js/frontend/reviews/listing/comments/CommentItem.js":
/*!*****************************************************************!*\
  !*** ./src/js/frontend/reviews/listing/comments/CommentItem.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../functions */ "./src/js/frontend/reviews/functions.js");


const {
  i18n: {
    __,
    sprintf
  }
} = wp;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ref => {
  let {
    id,
    content,
    date,
    author: {
      name: authorName,
      avatar: authorAvatar = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89B8AAskB44g04okAAAAASUVORK5CYII='
    }
  } = _ref;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__item woocommerce-Reviews__item--comment has-accent-background-color rounded",
    id: `comment-${id}`,
    key: id
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "grid p-3"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "span-2 span-md-1"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    className: 'has-accent-border-color shadow rounded-circle my-1',
    width: 50,
    src: authorAvatar,
    alt: sprintf(__("%s's Avatar", 'wca-woo-reviews'), authorAvatar)
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "span-10 span-lg-11"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__item-meta"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, authorName), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    class: "mx-1"
  }, "-"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("em", {
    class: "has-cyan-bluish-gray-color has-small-font-size"
  }, (0,_functions__WEBPACK_IMPORTED_MODULE_1__.formatDate)(date))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__item-content",
    dangerouslySetInnerHTML: {
      __html: content
    }
  }))));
});

/***/ }),

/***/ "./src/js/frontend/reviews/listing/comments/CommentsList.js":
/*!******************************************************************!*\
  !*** ./src/js/frontend/reviews/listing/comments/CommentsList.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _CommentItem__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CommentItem */ "./src/js/frontend/reviews/listing/comments/CommentItem.js");
/* harmony import */ var _preloaders_CommentPreloader__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./../preloaders/CommentPreloader */ "./src/js/frontend/reviews/listing/preloaders/CommentPreloader.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ref => {
  let {
    loading,
    comments
  } = _ref;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "woocommerce-Reviews__listing woocommerce-Reviews__listing--comments is-layout-flow"
  }, loading && comments.map((_, i) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "my-3",
    key: i,
    dangerouslySetInnerHTML: {
      __html: _preloaders_CommentPreloader__WEBPACK_IMPORTED_MODULE_2__["default"]
    }
  })), !loading && comments.map(item => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CommentItem__WEBPACK_IMPORTED_MODULE_1__["default"], item)));
});

/***/ }),

/***/ "./src/js/frontend/reviews/listing/preloaders/CommentPreloader.js":
/*!************************************************************************!*\
  !*** ./src/js/frontend/reviews/listing/preloaders/CommentPreloader.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (`<svg
	role="img"
	width="1024"
	height="100"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 100"
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
		<circle cx="35" cy="55" r="30"></circle>
		<rect x="95" y="30" rx="3" ry="3" width="150" height="8"></rect>
		<rect x="260" y="31" rx="3" ry="3" width="75" height="6"></rect>
		<rect x="95" y="50" rx="3" ry="3" width="920" height="6"></rect>
		<rect x="95" y="60" rx="3" ry="3" width="880" height="6"></rect>
		<rect x="95" y="70" rx="3" ry="3" width="700" height="6"></rect>
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

/***/ })

}]);
//# sourceMappingURL=CommentList.js.map