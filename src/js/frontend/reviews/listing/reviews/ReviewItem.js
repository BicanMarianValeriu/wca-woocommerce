import { Like, Comment, Replies } from './actions';
import StarRating from '../../shared/StarRating';
import { formatDate, generateAvatarDataURL, getInitials } from './../../functions';
import Icon from '../../shared/Icon';

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

	const { actions = { like: true, comment: true }, avatar } = options;

	const defaultProps = { review, options, userData };
	const [comments, setComments] = useState([]);
	const [loading, setLoading] = useState(false);

	const defaultActions = [
		{
			key: <Like.key />,
			Component: <Like.Component {...defaultProps} />
		},
		{
			key: <Replies.key />,
			Component: <Replies.Component {...{ ...defaultProps, loading, setLoading, comments, setComments }} />,
			After: <Replies.After {...{ loading, comments: loading ? Array(replies.length).fill() : comments, avatar }} />
		},
		{
			key: <Comment.key />,
			Component: <Comment.Component {...{ ...defaultProps, onAddComment }} />,
			After: <Comment.After {...{ ...defaultProps, addComment, setAddComment }} />
		}
	];

	const enabledActions = Object.keys(actions).filter((k) => actions[k] === true);

	let reviewActions = applyFilters('wecodeart.woocommerce.reviews.actions', defaultActions, review, options, userData);

	// Filter the defaultActions array based on enabledActions
	reviewActions = reviewActions.filter(({ key: { type } }) => {
		if (type === 'comments' && enabledActions.includes('comment')) {
			return true;
		}

		return enabledActions.includes(type);
	});

	return (
		<div className="woocommerce-Reviews__item has-border" id={`review-${reviewId}`} key={reviewId}>
			<div className="grid" style={{ paddingTop: '1rem', paddingBottom: '1rem' }}>
				<div className="span-12 span-md-2 span-lg-3">
					<div className="grid" style={{ alignItems: 'center' }}>
						<div className="span-3 span-sm-2 span-md-12">
							<img {...{
								width: 65,
								src: avatar === 'initials' ? generateAvatarDataURL(getInitials(authorName), 150) : authorAvatar,
								alt: sprintf(__("%s's Avatar", 'wca-woocommerce'), authorName)
							}} />
						</div>
						<div className="span-9 span-sm-10 span-md-12">
							<strong style={{ display: 'block' }}>{authorName}</strong>
							<em className="has-small-font-size has-cyan-bluish-gray-color">{formatDate(date)}</em>
						</div>
					</div>
				</div>
				<div className="span-12 span-md-10 span-lg-9 is-layout-flow">
					<div className="woocommerce-Reviews__item-meta has-small-font-size">
						{title && <h5 className="woocommerce-Reviews__item-title"><strong>{title}</strong></h5>}
						<StarRating rating={rating} className="has-small-font-size" />
						{verified && <span className="woocommerce-Reviews__item-verified">
							<Icon icon="verified" />
							<em className="has-cyan-bluish-gray-color">{__('Verified Purchase', 'wca-woocommerce')}</em>
						</span>}
					</div>
					<div className="woocommerce-Reviews__item-content" dangerouslySetInnerHTML={{ __html: content }} />
					{reviewActions.length > 0 && <>
						<div className="woocommerce-Reviews__item-actions">{
							reviewActions.map(({ Component = null }) => Component)}
						</div>
						{reviewActions.reverse().map(({ After = null }) => After)}
					</>}
				</div>
			</div>
		</div>
	);
};