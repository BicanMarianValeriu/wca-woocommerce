import { useHover } from '../hooks';

const {
	i18n: { __ },
	hooks: { applyFilters },
	element: { useEffect, useState },
} = wp;

const RATING_LABELS = applyFilters('wecodeart.woocommerce.reviews.rating.labels', {
	1: __('Not recommended', 'wca-woocommerce'),
	2: __('Weak', 'wca-woocommerce'),
	3: __('Acceptable', 'wca-woocommerce'),
	4: __('Good', 'wca-woocommerce'),
	5: __('Excelent', 'wca-woocommerce'),
});

export default ({ rating = 0, onClick, children, className = 'justify-content-start' }) => {
	const [refHover, isHovered] = useHover();
	const [ratingLabel, setRatingLabel] = useState('');

	const hoverLabel = isHovered && isHovered.closest('[aria-label]')?.getAttribute('aria-label');

	useEffect(() => {
		if (rating) {
			setRatingLabel(RATING_LABELS[rating]);
		}
	}, [rating]);

	return (
		<>
			<div className={`woocommerce-Reviews__rating-input d-flex align-items-center ${className}`}>
				<div className="woocommerce-Reviews__rating-input__stars me-2">
					<div className="d-flex flex-row-reverse" ref={refHover}>
						{Object.entries(RATING_LABELS).reverse().map(item => {
							const [star, label] = item;
							const classNames = ['woocommerce-Reviews__icon', 'woocommerce-Reviews__icon--rating', parseInt(star) === parseInt(rating) ? 'active' : ''];
							return (
								<button {...{
									className: classNames.filter(Boolean).join(' '),
									type: 'button',
									onClick: (e) => onClick(parseFloat(star), e),
									'aria-label': label
								}}><span className="screen-reader-text">{label}</span></button>
							);
						})}
					</div>
					{children}
				</div>
				<div className="woocommerce-Reviews__rating-input__hover fw-700">{hoverLabel || ratingLabel || __('Your rating', 'wca-woocommerce')}</div>
			</div>
		</>
	);
};