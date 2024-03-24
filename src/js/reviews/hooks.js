const { element: { useEffect, useState, useRef, useReducer } } = wp;
const { requestUrl, product: { total } } = wpBlockWooReviews;

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
	const { type, payload } = action;

	switch (type) {
		case ACTIONS.MAKE_REQUEST:
			return { ...state, loading: true, data: [], meta: {} };

		case ACTIONS.SET_META:
			const { meta } = payload;

			return { ...state, meta };

		case ACTIONS.GET_REVIEWS:
		case ACTIONS.GET_COMMENTS:
			const { data } = payload;

			return { ...state, loading: false, data };

		case ACTIONS.ERROR:
			const { error } = payload;

			return { ...state, loading: false, data: [], error };

		default: return state;
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
		error: false,
	});

	const formData = new FormData();
	formData.append('action', 'query');
	Object.keys(queryArgs).map(k => formData.append(k, queryArgs[k]));

	useEffect(() => {
		if (hasReviews === 0) return;

		dispatch({ type: ACTIONS.MAKE_REQUEST });

		fetch(path, {
			method: 'POST',
			body: formData,
			parse: true,
		}).then(r => r.json()).then(({ meta, data }) => {

			dispatch({ type: ACTIONS.SET_META, payload: { meta } });

			dispatch({ type: ACTIONS[action], payload: { data } });

		}).catch((error) => {

			dispatch({ type: ACTIONS.ERROR, payload: { error } });

		}).finally(() => {

		});
	}, [queryArgs, total]);

	return state;
}

/**
 * Function that listens for hover.
 */
function useHover() {
	const [value, setValue] = useState(false);

	const ref = useRef(null);

	const handleMouseOver = (e) => setValue(e.target);
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

export { useHover, useApiFetch };