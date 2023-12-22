import AddReview from './AddReview';
import RatingData from './RatingData';
import RatingBars from './RatingBars';
import RatingStats from './RatingStats';

export default ({ options, rating, setRating, queryArgs, setQueryArgs, userData, meta, breakpoint }) => {
	let amount = {
		1: 0,
		2: 0,
		3: 0,
		4: 0,
		5: 0,
	};

	const { product: { average, total, counts }, verified: verifiedBadge } = options;
	const { verified } = meta;

	amount = { ...amount, ...counts };

	const dataProps = { amount, average, total };

	return (
		<div className="woocommerce-Reviews__summary">
			<div className="grid">
				<div className="span-12 span-sm-6 span-lg-2">
					<RatingData {...dataProps} />
				</div>
				<div className="span-12 span-sm-6 span-lg-3 start-lg-7">
					<RatingStats {...{ average, verified, verifiedBadge }} />
				</div>
				<div className="span-12 span-lg-3 start-lg-10">
					<AddReview {...{ rating, setRating, userData, options }} />
				</div>
				<div className="span-12 span-lg-4 start-lg-3" style={{ gridRowStart: breakpoint === 'mobile' ? 'initial' : 1 }}>
					<RatingBars {...{ ...dataProps, queryArgs, setQueryArgs }} />
				</div>
			</div>
		</div>
	);
};