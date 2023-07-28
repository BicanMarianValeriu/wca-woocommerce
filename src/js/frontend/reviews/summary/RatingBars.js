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
			setQueryArgs({...queryArgs, rating: clickedValue })
		}
	};

	return (
		<div className="woocommerce-Reviews__summary-bars d-table" style={{ width: '100%' }}>
			{Array(5).fill().reverse().map((_, i) => {
				const value = 5 - i;
				const count = amount[value];
				const width = (count / total * 100).toString() + '%';
				const label = sprintf(_n('%s star', '%s stars', value, 'wca-woocommerce'), value);

				let props = {
					key: i,
					href: parseInt(count) ? 'javascript:void(0);' : null,
					onClick: parseInt(count) !== 0 ? onClick : null,
					'data-value': value,
				};

				return (
					<a className="d-table-row" {...props}>
						<span className="d-table-cell align-middle py-1">{label}</span>
						<span className="d-table-cell align-middle py-1 px-1" style={{ width: '100%' }}>
							<div className="rounded-pill has-accent-background-color" style={{ width: '100%', overflow: 'hidden' }}>
								<div className="has-primary-background-color" role="progressbar" style={{ width, minHeight: 12 }}></div>
							</div>
						</span>
						<span className="d-table-cell align-middle py-1">({count})</span>
					</a>
				);
			})}
		</div>
	);
};