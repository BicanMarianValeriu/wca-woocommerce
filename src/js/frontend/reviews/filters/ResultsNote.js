const {
	i18n: { __, _n, sprintf }
} = wp;

export default ({ totalResults = false, onReset }) => {
	return (totalResults !== false &&
		<>
			<div className="has-accent-background-color rounded p-3 my-3">
				<span>{sprintf(
					_n('We found %s result for your filters.', 'We found %s results for your filters.', totalResults, 'wca-woocommerce'),
					totalResults
				)}</span>
				<span>&nbsp;</span>
				<a href="javascript:void(0);" onClick={onReset}>{__('Remove filters', 'wca-woocommerce')}</a>
			</div>
		</>
	);
};