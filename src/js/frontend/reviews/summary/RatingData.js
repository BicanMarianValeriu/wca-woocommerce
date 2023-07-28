import StarRating from './../shared/StarRating';

const {
	i18n: { _n, sprintf }
} = wp;

export default ({ average = 0.0, total = 0 }) => {

	const labelElement = _n('%s review', '%s reviews', total, 'wca-woocommerce');

	return (
		<div className="woocommerce-Reviews__summary-info is-layout-flow has-text-align-center">
			<h3 className="display-4 fw-700" style={{ lineHeight: 1 }}>{parseFloat(average).toFixed(2)}</h3>
			<StarRating rating={average} percent={5} />
			<p className="has-small-font-size has-cyan-bluish-gray-color">{sprintf(labelElement, total)}</p>
		</div>
	);
};