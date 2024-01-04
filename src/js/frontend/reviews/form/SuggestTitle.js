const {
	i18n: { __ },
	hooks: { applyFilters },
	element: { useEffect, useState },
} = wp;

const RATING_SUGGESTIONS = applyFilters('wecodeart.woocommerce.reviews.rating.suggestions', {
	1: [__('Not recommended', 'wca-woocommerce'), __('Very weak', 'wca-woocommerce'), __('Not happy', 'wca-woocommerce')],
	2: [__('Weak', 'wca-woocommerce'), __('I don\'t like it', 'wca-woocommerce'), __('Disappointing', 'wca-woocommerce')],
	3: [__('Decent', 'wca-woocommerce'), __('Acceptable', 'wca-woocommerce'), __('Ok', 'wca-woocommerce')],
	4: [__('Happy', 'wca-woocommerce'), __('I like it', 'wca-woocommerce'), __('Is worth it', 'wca-woocommerce'), __('Good', 'wca-woocommerce')],
	5: [__('Excelent', 'wca-woocommerce'), __('Very satisfied', 'wca-woocommerce'), __('Recommended', 'wca-woocommerce'), __('Cool', 'wca-woocommerce')],
});

export default ({ rating: star = 5, setTitle }) => {

	const [current, setCurrent] = useState(RATING_SUGGESTIONS[star]);

	useEffect(() => setCurrent(RATING_SUGGESTIONS[star]), [star]);

	const onClick = (e) => {
		const value = e.currentTarget.textContent;
		setTitle(value);
		document.forms['wca-woo-addreview'].elements['title'].value = value;
	};

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