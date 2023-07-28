import Summary from './summary';
import Filters from './filters';
import Listing from './listing';
import { useApiFetch } from './hooks';
import { scrollToElement } from './functions';

const { element: { useState, useEffect, lazy, Suspense } } = wp;

const LeaveAReview = lazy(() => import(/* webpackChunkName: 'ReviewForm' */ './form'));

const App = (options) => {
	const {
		headline = false,
		container = '#reviews',
		product: { ID: product_id, total },
		query,
		requestUrl,
	} = options;

	// State
	const [scroll, setScroll] = useState(false);
	const [rating, setRating] = useState(false);
	const [userData, setUserData] = useState(false);
	const [queryArgs, setQueryArgs] = useState({ product_id, ...query, action: 'query' });

	// Load requested comments by filters
	const { loading, data: reviews, meta } = useApiFetch({ queryArgs });

	// Set User
	useEffect(() => {
		if (userData) return;

		(async () => {
			const formData = new FormData();
			formData.append('action', 'user');

			try {
				const r = await fetch(requestUrl, {
					method: 'POST',
					body: formData,
				});

				const { token, status } = await r.json();

				if (status) {
					const [reviewer, reviewer_email] = atob(token).split(':');
					setUserData({ reviewer, reviewer_email });
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
			scrollToElement(scrollEl);
		}
		setScroll(true);
	}, [rating, scroll]);

	const defaultProps = { options, rating, setRating, queryArgs, setQueryArgs, userData };
	const filtersProps = { options, loading, meta, queryArgs, setQueryArgs };
	const listingProps = { ...filtersProps, reviews, userData };

	return (
		<>
			{headline && <>
				<h2 className="woocommerce-Reviews__headline">{headline}</h2>
				<div className="border-bottom my-3" />
			</>}
			{typeof rating === 'number' && <Suspense fallback={<div>Loading...</div>}>
				<LeaveAReview {...defaultProps} />
			</Suspense>}
			{typeof rating === 'boolean' && <Summary {...{ ...defaultProps, meta }} />}
			{total > 0 && <>
				<Filters {...filtersProps} />
				<Listing {...listingProps} />
			</>}
		</>
	);
};

export { App };