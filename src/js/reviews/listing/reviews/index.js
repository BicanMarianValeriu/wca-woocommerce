import ReviewItem from './ReviewItem';
import Pagination from './Pagination';
import Preloader from '../preloaders/ReviewPreloader';
import PreloaderMobile from '../preloaders/ReviewPreloaderMobile';
import { scrollToElement } from '../../functions';

const {
	url: { isValidFragment },
	element: { useEffect, useState },
} = wp;

export default ({ loading, reviews = [], likedReviews = [], setLikedReviews, meta, queryArgs, setQueryArgs, userData, options, breakpoint }) => {
	const { amount } = options;

	const { hash } = window.location;
	const rId = isValidFragment(hash) && hash.split('-').pop();
	const [addComment, setAddComment] = useState(false);

	const onAddComment = (id) => (addComment !== id) ? setAddComment(id) : setAddComment(false);

	useEffect(() => {
		if (loading) return;
		const scrollEl = document.getElementById(`review-${rId}`);
		scrollToElement(scrollEl);
	}, [loading, rId]);

	const { totalPages } = meta;
	const preloader = breakpoint === 'mobile' ? PreloaderMobile : Preloader;

	return (
		<>
			<div className="woocommerce-Reviews__listing is-layout-flow">
				{loading && Array(parseInt(amount)).fill().map((_, i) => <div key={i} dangerouslySetInnerHTML={{ __html: preloader }} />)}
				{!loading && reviews.map((review) => <ReviewItem {...{
					review,
					likedReviews,
					setLikedReviews,
					userData,
					addComment,
					onAddComment,
					setAddComment,
					options
				}} />)}
			</div>
			{totalPages > 1 && <Pagination {...{ ...meta, loading, queryArgs, setQueryArgs }} />}
		</>
	);
};