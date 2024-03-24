import Icon from './Icon';

export default ({ rating = 0.0, percent = false, className = 'has-medium-font-size' }) => {
	const generateStars = (a) => [5, 4, 3, 2, 1].map((i) => {
		const className = [
			'has-background',
			parseInt(a) === i ? 'active' : ''
		].filter(Boolean).join(' ');

		return (
			<button className={className} key={i}>
				<Icon icon="rating" />
			</button>
		);
	});

	return (
		<div className={`woocommerce-Reviews__rating ${className}`}>
			<div className="woocommerce-Reviews__rating-range">{generateStars(!percent && rating)}</div>
			{percent && <div {...{
				className: 'woocommerce-Reviews__rating-overlay',
				style: {
					width: ((rating / 5) * 100).toString() + '%',
					overflow: 'hidden'
				}
			}}><div className="woocommerce-Reviews__rating-range">{generateStars(percent)}</div></div>}
		</div>
	);
};