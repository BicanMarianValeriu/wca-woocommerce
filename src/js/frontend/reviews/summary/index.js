import AddReview from './AddReview';
import RatingData from './RatingData';
import RatingBars from './RatingBars';
import RatingStats from './RatingStats';

export default ({ options, rating, setRating, queryArgs, setQueryArgs, userData, meta }) => {
	let amount = {
		1: 0,
		2: 0,
		3: 0,
		4: 0,
		5: 0,
	};

	const { product: { average, total, counts, allow }, verified: verifiedBadge } = options;
	const { verified } = meta;

	amount = { ...amount, ...counts };

	const dataProps = { amount, average, total };

	return (
		<div className="woocommerce-Reviews__summary">
			<div className="wp-block-columns grid">
				<div {...{ className: `span-12 span-sm-6 span-lg-${allow ? 2 : 4}` }}>
					<RatingData {...dataProps} />
				</div>
				{allow && <div className="span-12 span-sm-6 span-lg-3 order-lg-last">
					<AddReview {...{ rating, setRating, userData, options }} />
				</div>}
				<div {...{ className: `span-12 span-lg-${allow ? 4 : 6}` }}>
					<RatingBars {...{ ...dataProps, queryArgs, setQueryArgs }} />
				</div>
				<div className="span-12 span-lg-3 align-self-center">
					<RatingStats {...{ average, verified, verifiedBadge }} />
				</div>
			</div>
		</div>
	);
};