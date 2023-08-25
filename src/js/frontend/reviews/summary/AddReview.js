import RatingInput from './../shared/RatingInput';

const {
	i18n: { __, sprintf },
} = wp;

export default ({ setRating, userData: { reviewer = false }, options = {} }) => {
	const {
		product: {
			verify = false
		}
	} = options;

	const showMessage = reviewer === false && verify;

	return (
		<div className="woocommerce-Reviews__summary-new">{showMessage ?
			<>
				<p className="woocommerce-Reviews__summary-message" dangerouslySetInnerHTML={{ __html: verify }} />
			</> :
			<>
				<p className="has-normal-font-size" style={{ marginBottom: 10 }}><strong>{
					reviewer ?
						sprintf(__('Hey %s. Welcome back!', 'wca-woocommerce'), reviewer)
						: __('Do you own or used the product?', 'wca-woocommerce')
				}</strong></p>
				<p className="has-small-font-size has-cyan-bluish-gray-color" style={{ marginBottom: 10 }}>{
					__('Tell your opinion by giving it a rating', 'wca-woocommerce')
				}</p>
				<RatingInput onClick={setRating} style={{ marginBottom: 10 }} />
				<button className="wp-element-button has-primary-background-color has-small-font-size" onClick={() => setRating(5)}>{
					__('Add a review', 'wca-woocommerce')
				}</button>
			</>
		}</div >
	);
};