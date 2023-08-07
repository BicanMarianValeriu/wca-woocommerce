const {
	i18n: { __ },
	hooks: { applyFilters },
	element: { useEffect, useState },
} = wp;

const RATING_SUGGESTIONS = applyFilters('wecodeart.woocommerce.reviews.rating.suggestions', {
	1: [__('Not recommended', 'wca-woo-reviews'), __('Very weak', 'wca-woo-reviews'), __('Not happy', 'wca-woo-reviews')],
	2: [__('Weak', 'wca-woo-reviews'), __('I don\'t like it', 'wca-woo-reviews'), __('Disappointing', 'wca-woo-reviews')],
	3: [__('Decent', 'wca-woo-reviews'), __('Acceptable', 'wca-woo-reviews'), __('Ok', 'wca-woo-reviews')],
	4: [__('Happy', 'wca-woo-reviews'), __('I like it', 'wca-woo-reviews'), __('Is worth it', 'wca-woo-reviews'), __('Good', 'wca-woo-reviews')],
	5: [__('Excelent', 'wca-woo-reviews'), __('Very satisfied', 'wca-woo-reviews'), __('Recommended', 'wca-woo-reviews'), __('Cool', 'wca-woo-reviews')],
});

export default ({ rating: star = 5 }) => {

	const [current, setCurrent] = useState(RATING_SUGGESTIONS[star]);

	useEffect(() => setCurrent(RATING_SUGGESTIONS[star]), [star]);

	const onClick = (e) => document.forms['wca-woo-addreview'].elements['title'].value = e.currentTarget.textContent;

	const Button = ({ key, label }) => {
		const props = { type: 'button', className: 'wp-element-button has-accent-background-color has-black-color', key, onClick };
		return (<button {...props}>{label}</button>);
	};

	return (
		<div className="woocommerce-Reviews__suggestions" style={{ display: 'flex', flexWrap: 'wrap', alignItems: 'center', gap: '.5rem' }}>
			{current.map((x, y) => <Button key={y} label={x} />)}
		</div>
	);
};