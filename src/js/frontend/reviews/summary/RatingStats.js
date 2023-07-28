const {
	i18n: { __ },
	element: { useRef, useEffect }
} = wp;

export default ({ average = 0.0, verified = 0, verifiedBadge }) => {
	const verifiedRef = useRef();

	// Update once and maintain it.
	useEffect(() => {
		verifiedRef.current = verified;
	}, [verified]);

	return (
		<div className="woocommerce-Reviews__summary-stats has-text-align-center">
			<div className="woocommerce-Reviews__summary-stats__1">
				<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--recommend me-2" role="icon" />
				<span className="has-black-color"><strong>{parseInt(((average / 5) * 100)) + '%'}</strong></span>
				<div className="has-small-font-size has-cyan-bluish-gray-color">{__('of the clients recommend the product', 'wca-woocommerce')}</div>
			</div>
			{verifiedBadge && <>
				<div className="my-3 border-bottom" />
				<div className="woocommerce-Reviews__summary-stats__2">
					<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--verified me-2" role="icon" />
					<span className="has-black-color"><strong>{verifiedRef.current ?? verified}</strong>&nbsp;&nbsp;</span>
					<div className="has-small-font-size has-cyan-bluish-gray-color">{__('of the reviews are verified purchase', 'wca-woocommerce')}</div>
				</div>
			</>}
		</div>
	);
};