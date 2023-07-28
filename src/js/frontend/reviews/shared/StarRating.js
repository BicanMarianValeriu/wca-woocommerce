export default ({ rating = 0.0, percent = false, className = 'has-medium-font-size' }) => {
	const generateStars = (a) => [5, 4, 3, 2, 1].map((i) => {
		const className = ['woocommerce-Reviews__icon', 'woocommerce-Reviews__icon--rating', parseInt(a) === i ? 'active' : ''].filter(Boolean).join(' ');

		return (<div key={i} className={className} role="icon" />);
	});

	return (
		<div className={['woocommerce-Reviews__rating', 'd-inline-block', 'align-middle', className].join(' ')}>
			<div className="woocommerce-Reviews__rating-range">{generateStars(!percent && rating)}</div>
			{percent && <div {...{
				className: 'woocommerce-Reviews__rating-overlay has-warning-color',
				style: {
					width: ((rating / 5) * 100).toString() + '%',
					overflow: 'hidden'
				}
			}}><div className="woocommerce-Reviews__rating-range">{generateStars(percent)}</div></div>}
		</div>
	);
};