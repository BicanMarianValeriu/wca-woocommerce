import { useForm } from 'react-hook-form';
import ResultsNote from './ResultsNote';

const {
	i18n: { __, _n, sprintf }
} = wp;

export default ({ queryArgs, setQueryArgs, loading, meta: { totalResults }, options }) => {
	const {
		product: {
			ID: product_id,
			counts,
		},
		verified,
	} = options;

	let amount = {
		5: 0,
		4: 0,
		3: 0,
		2: 0,
		1: 0,
	};

	amount = { ...amount, ...counts };

	const getLabel = (v) => sprintf(_n('%s star reviews', '%s stars reviews', v, 'wca-woocommerce'), v);

	const { handleSubmit, register } = useForm({ mode: 'onSubmit' });

	const onSubmit = (values) => {
		const result = {};

		for (const [k, v] of Object.entries(values)) {
			if (v !== '' && v !== false) result[k] = v;
		}

		setQueryArgs({ product_id, ...result });
	};

	const onChange = () => setTimeout(handleSubmit(onSubmit), 20);

	const onReset = () => {
		document.forms['wca-woo-filters'].reset();

		return onChange();
	};

	const style = {};

	if (loading) {
		style.pointerEvents = 'none';
		style.opacity = .65;
	}

	const includedIn = (x) => ['rating', 'verified', 'search'].includes(x);
	const hasFilters = Object.keys(queryArgs).map(includedIn).filter(Boolean).pop();

	return (
		<form className="woocommerce-Reviews__filters" onSubmit={handleSubmit(onSubmit)} name="wca-woo-filters" style={style}>
			<div className="border-bottom my-3" />
			<div className="wp-block-columns is-not-stacked-on-mobile align-items-center g-3">
				<div className="wp-block-column col-12 col-sm col-lg-3 input-group input-group-sm">
					<label class="input-group-text" for="orderby">{__('Sort:', 'wca-woocommerce')}</label>
					<select className="form-select" id="orderby" name="orderby" onChange={onChange} ref={register}>
						<option value="">{__('Recent', 'woocommerce')}</option>
						<option value="rating">{__('Rating', 'wca-woocommerce')}</option>
						<option value="likes">{__('Popularity', 'wca-woocommerce')}</option>
					</select>
				</div>
				<div className="wp-block-column col-12 col-sm col-lg-3 input-group input-group-sm">
					<label class="input-group-text" for="stars">{__('Filter:', 'wca-woocommerce')}</label>
					<select className="form-select" id="stars" name="rating" onChange={onChange} ref={register}>
						<option value="">{__('All reviews', 'wca-woocommerce')}</option>
						{Array(5).fill().reverse().map((_, i) => {
							const value = 5 - i;
							return (<option {...{ disabled: amount[value] === 0, value }}>{getLabel(value)}</option>);
						})}
					</select>
				</div>
				{verified && <div className="wp-block-column col-auto input-group input-group-sm">
					<input className="js-filter-purchase" type="checkbox" name="verified" id="verified" onChange={onChange} ref={register} />
					<label className="wp-element-button has-accent-background-color" for="verified">
						<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--verified me-lg-3" />
						<span className="d-none d-lg-inline-block">{__('Verified owner', 'wca-woocommerce')}</span>
					</label>
				</div>}
				<div className="wp-block-column col-auto col-sm-12 col-lg flex-grow-1 input-group input-group-sm">
					<input {...{
						type: 'search',
						name: 'search',
						className: 'form-control',
						placeholder: __('Search in reviews', 'wca-woocommerce'),
						ref: register,
						onBlur({ target: { value } }) {
							if (value === '' && queryArgs.search !== undefined) {
								delete queryArgs.search;
								setQueryArgs({ ...queryArgs });
							}
						}
					}} />
					<button {...{
						className: 'wp-element-button has-accent-background-color',
						style: { lineHeight: 1 },
						type: 'submit',
					}}>
						<span className="screen-reader-text">{__('Search', 'wca-woocommerce')}</span>
						<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--search" />
					</button>
				</div>
			</div>
			<div className="border-bottom my-3" />
			{!loading && hasFilters ? <ResultsNote totalResults={totalResults} onReset={onReset} /> : null}
		</form>
	);
};