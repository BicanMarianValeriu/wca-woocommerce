import { Like, Comment, Replies } from './actions';
import StarRating from '../../shared/StarRating';
import { formatDate } from './../../functions';

const {
	i18n: { __, sprintf },
	hooks: { applyFilters },
	element: { useState },
} = wp;

export default ({ review, options, userData = false, addComment, setAddComment, onAddComment }) => {
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
			avatar: authorAvatar = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89B8AAskB44g04okAAAAASUVORK5CYII=',
		},
	} = review;

	const defaultProps = { review, options, userData };
	const [comments, setComments] = useState([]);
	const [loading, setLoading] = useState(false);

	const reviewActions = applyFilters('wecodeart.woocommerce.reviews.actions', [
		{
			key: <Like.key />,
			Component: <Like.Component {...defaultProps} />
		},
		{
			key: <Replies.key />,
			Component: <Replies.Component {...{ ...defaultProps, loading, setLoading, comments, setComments }} />,
			After: <Replies.After {...{ ...defaultProps, addComment, setAddComment, loading, comments: loading ? Array(replies.length).fill() : comments }} />
		},
		{
			key: <Comment.key />,
			Component: <Comment.Component {...{ ...defaultProps, onAddComment }} />,
			After: <Comment.After {...{ ...defaultProps, addComment, setAddComment }} />
		}
	], review, options, userData);

	return (
		<div className="woocommerce-Reviews__item border-bottom" id={`review-${reviewId}`} key={reviewId}>
			<div className="grid py-3">
				<div className="span-12 span-md-4 span-lg-3">
					<div className="wp-block-columns is-not-stacked-on-mobile align-items-center g-3">
						<div className="wp-block-column col-auto col-md-12">
							<img {...{
								className: 'has-accent-border-color rounded-circle shadow mt-1',
								src: authorAvatar,
								width: 65,
								alt: sprintf(__("%s's Avatar", 'wca-woocommerce'), authorAvatar)
							}} />
						</div>
						<div className="wp-block-column col-auto col-md-12">
							<p className="my-0"><strong>{authorName}</strong></p>
							<p className="has-small-font-size has-cyan-bluish-gray-color my-0">{formatDate(date)}</p>
						</div>
					</div>
				</div>
				<div className="span-12 span-md-8 span-lg-9 is-layout-flow">
					<div className="woocommerce-Reviews__item-meta has-small-font-size">
						{title && <h5 className="woocommerce-Reviews__item-title fw-700 mb-1">{title}</h5>}
						<StarRating rating={rating} className="has-small-font-size" />
						{verified && <span className="woocommerce-Reviews__item-verified d-inline-block align-middle ms-3">
							<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--verified me-1" />
							<span className="has-cyan-bluish-gray-color">{__('Verified Purchase', 'wca-woocommerce')}</span>
						</span>}
					</div>
					<div className="woocommerce-Reviews__item-content" dangerouslySetInnerHTML={{ __html: content }} />
					{reviewActions.length > 0 && <>
						<div className="woocommerce-Reviews__item-actions wp-block-button is-style-link">{
							reviewActions.map(({ Component = null }) => Component)}
						</div>
						{reviewActions.reverse().map(({ After = null }) => After)}
					</>}
				</div>
			</div>
		</div>
	);
};