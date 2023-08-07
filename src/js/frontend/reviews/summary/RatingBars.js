const {
	i18n: { _n, sprintf }
} = wp;

export default ({ amount = {
	1: 0,
	2: 0,
	3: 0,
	4: 0,
	5: 0,
}, total = 0, queryArgs, setQueryArgs }) => {

	const onClick = (e) => {
		e.preventDefault();
		const filterForms = document.forms['wca-woo-filters'];
		const clickedValue = e.currentTarget.dataset.value;
		const fieldElement = filterForms.elements.rating;

		if (clickedValue !== fieldElement.value) {
			fieldElement.value = clickedValue;
			setQueryArgs({ ...queryArgs, rating: clickedValue });
		}
	};

	return (
		<div className="woocommerce-Reviews__summary-bars" style={{ display: 'table', width: '100%' }}>
			{Array(5).fill().reverse().map((_, i) => {
				const value = 5 - i;
				const count = amount[value];
				const calc  = count ? count / total * 100 : 0;
				const width = calc.toString() + '%';
				const label = sprintf(_n('%s star', '%s stars', value, 'wca-woo-reviews'), value);

				const cellStyle = {
					display: 'table-cell',
					paddingTop: 8,
					paddingBottom: 8,
					whiteSpace: 'nowrap',
					lineHeight: 1
				};

				return (
					<a {...{
						key: i,
						href: parseInt(count) ? 'javascript:void(0);' : null,
						onClick: parseInt(count) !== 0 ? onClick : null,
						style: { display: 'table-row', backgroundColor: 'transparent' },
						'data-value': value,
					}}>
						<span style={cellStyle}>{label}</span>
						<span style={{ ...cellStyle, padding: 8, width: '100%' }}>
							<div className="has-accent-background-color" style={{ width: '100%', borderRadius: 50, overflow: 'hidden' }}>
								<div className="has-primary-background-color" role="progressbar" style={{ width, minHeight: 12 }}></div>
							</div>
						</span>
						<span style={cellStyle}>({count})</span>
					</a>
				);
			})}
		</div>
	);
};