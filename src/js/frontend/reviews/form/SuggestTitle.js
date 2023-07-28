const {
	i18n: { __ },
	hooks: { applyFilters },
	element: { useEffect, useState },
} = wp;

const RATING_SUGGESTIONS = applyFilters('wecodeart.wecodeart.woocommerce.reviews.rating.suggestions', {
	1: [__('Not recommended', 'wca-woocommerce'), __('Very weak', 'wca-woocommerce'), __('Not happy', 'wca-woocommerce')],
	2: [__('Weak', 'wca-woocommerce'), __('I don\'t like it', 'wca-woocommerce'), __('Disappointing', 'wca-woocommerce')],
	3: [__('Decent', 'wca-woocommerce'), __('Acceptable', 'wca-woocommerce'), __('Ok', 'wca-woocommerce')],
	4: [__('Happy', 'wca-woocommerce'), __('I like it', 'wca-woocommerce'), __('Is worth it', 'wca-woocommerce'), __('Good', 'wca-woocommerce')],
	5: [__('Excelent', 'wca-woocommerce'), __('Very satisfied', 'wca-woocommerce'), __('Recommended', 'wca-woocommerce'), __('Cool', 'wca-woocommerce')],
});

export default ({ rating: star = 5 }) => {

	const [current, setCurrent] = useState(RATING_SUGGESTIONS[star]);

	useEffect(() => setCurrent(RATING_SUGGESTIONS[star]), [star]);

	const onClick = (e) => document.forms['wca-woo-addreview'].elements['title'].value = e.currentTarget.textContent;

	const Button = ({ key, label }) => {
		const props = { type: 'button', className: 'wp-element-button has-accent-background-color has-black-color rounded-pill me-2', key, onClick };
		return (<button {...props}>{label}</button>);
	};

	return ( 
		<div className="woocommerce-Reviews__suggestions d-flex flex-wrap align-items-center">
			{current.map((x, y) => <Button key={y} label={x} />)}
		</div> 
	);
};