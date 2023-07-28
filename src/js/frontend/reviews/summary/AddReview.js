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
		<div className="woocommerce-Reviews__summary-new has-text-align-center has-text-align-sm-left">{showMessage ?
			<>
				<p className="woocommerce-Reviews__summary-message">{verify}</p>
			</> :
			<>
				<p className="mb-1 fw-700">{
					reviewer ?
						sprintf(__('Hey %s. Welcome back!', 'wca-woocommerce'), reviewer)
						: __('Do you own or used the product?', 'wca-woocommerce')
				}</p>
				<p className="mb-1 has-small-font-size has-cyan-bluish-gray-color">{
					__('Tell your opinion by giving it a rating', 'wca-woocommerce')
				}</p>
				<RatingInput onClick={setRating} className="justify-content-center justify-content-sm-start mb-2" />
				<button onClick={() => setRating(5)} className="wp-element-button has-primary-background-color has-small-font-size py-1">{
					__('Add a review', 'wca-woocommerce')
				}</button>
			</>
		}</div >
	);
};