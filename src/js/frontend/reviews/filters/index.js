import { useForm } from 'react-hook-form';
import ResultsNote from './ResultsNote';
import Icon from './../shared/Icon';

const {
	i18n: { __, _n, sprintf },
	hooks: { applyFilters }
} = wp;

const SORTING_OPTIONS = applyFilters('wecodeart.woocommerce.reviews.sorting', {
	'': __('Recent', 'wca-woo-reviews'),
	'rating': __('Rating', 'wca-woo-reviews'),
	'likes': __('Popularity', 'wca-woo-reviews'),
});

export default ({ queryArgs, setQueryArgs, loading, meta: { totalResults }, options, breakpoint }) => {
	const {
		product: {
			ID: product_id,
			counts,
		},
		actions = [],
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

	const getLabel = (v) => sprintf(_n('%s star reviews', '%s stars reviews', v, 'wca-woo-reviews'), v);

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

	if (actions?.like === false) {
		delete SORTING_OPTIONS.likes;
	}

	return (
		<form className="woocommerce-Reviews__filters" onSubmit={handleSubmit(onSubmit)} name="wca-woo-filters" style={style}>
			<div className="has-border my-spacer" />
			<div className="grid">
				<div className="span-12 span-sm-6 span-lg-4">
					<div className="input-group input-group-sm">
						<label class="input-group-text" for="filter-orderby">{__('Sort:', 'wca-woo-reviews')}</label>
						<select className="form-select" id="filter-orderby" name="orderby" onChange={onChange} ref={register}>
							{Object.keys(SORTING_OPTIONS).map(k => <option value={k}>{SORTING_OPTIONS[k]}</option>)}
						</select>
					</div>
				</div>
				<div className="span-12 span-sm-6 span-lg-4">
					<div className="input-group input-group-sm">
						<label class="input-group-text" for="filter-stars">{__('Filter:', 'wca-woo-reviews')}</label>
						<select className="form-select" id="filter-stars" name="rating" onChange={onChange} ref={register}>
							<option value="">{__('All reviews', 'wca-woo-reviews')}</option>
							{Array(5).fill().reverse().map((_, i) => {
								const value = 5 - i;
								return (<option {...{ disabled: amount[value] === 0, value }}>{getLabel(value)}</option>);
							})}
						</select>
					</div>
				</div>
				<div className="span-12 span-sm-12 span-lg-4" style={{ display: 'flex', alignItems: 'center' }}>
					{verified && <div className="input-group input-group-sm" style={{ width: 'auto', marginRight: 15 }}>
						<input className="hidden" type="checkbox" name="verified" id="filter-verified" onChange={onChange} ref={register} />
						<label className="wp-element-button has-accent-background-color" for="filter-verified">
							<Icon icon="verified" />
							<span style={{ marginLeft: 10, display: breakpoint === 'mobile' ? 'none' : 'inline-block' }}>{__('Verified owner', 'wca-woo-reviews')}</span>
						</label>
					</div>}
					<div className="input-group input-group-sm">
						<input {...{
							type: 'search',
							name: 'search',
							className: 'form-control',
							placeholder: __('Search in reviews', 'wca-woo-reviews'),
							ref: register,
							onBlur({ target: { value } }) {
								if (value === '' && queryArgs.search !== undefined) {
									delete queryArgs.search;
									setQueryArgs({ ...queryArgs });
								}
							}
						}} />
						<button {...{
							className: 'wp-element-button wp-block-search__button has-accent-background-color',
							style: { lineHeight: 1 },
							type: 'submit',
						}}>
							<span className="screen-reader-text sr-text sr-only">{__('Search in reviews', 'wca-woo-reviews')}</span>
							<span className="woocommerce-Reviews__icon woocommerce-Reviews__icon--search" />
						</button>
					</div>
				</div>
			</div>
			<div className="has-border my-spacer" />
			{!loading && hasFilters ? <ResultsNote totalResults={totalResults} onReset={onReset} /> : null}
		</form>
	);
};