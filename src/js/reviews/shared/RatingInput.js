import { useHover } from '../hooks';
import Icon from './Icon';

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

export default ({ rating = 0, onClick, children }) => {
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
			<div className="woocommerce-Reviews__rating woocommerce-Reviews__rating--input">
				<div className="woocommerce-Reviews__rating-range" ref={refHover}>
					{Object.entries(RATING_LABELS).reverse().map(item => {
						const [star, label] = item;
						return (
							<button {...{
								className: ['has-background', parseInt(star) === parseInt(rating) ? 'active' : ''].filter(Boolean).join(' '),
								type: 'button',
								onClick: (e) => onClick(parseFloat(star), e),
								'aria-label': label
							}}>
								<Icon icon="rating" />
								<span className="screen-reader-text">{label}</span>
							</button>
						);
					})}
				</div>
				<strong className="woocommerce-Reviews__rating-hover">{hoverLabel || ratingLabel || __('Your rating', 'wca-woocommerce')}</strong>
				{children}
			</div>
		</>
	);
};