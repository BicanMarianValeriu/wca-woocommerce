import { scrollToElement } from '../../functions';

const {
	i18n: { __ },
	element: { useEffect, useState },
} = wp;

export default ({ loading, queryArgs, setQueryArgs, totalPages: total }) => {
	const { page = 1 } = queryArgs;
	const [scroll, setScroll] = useState(false);
	const setPage = (p) => setQueryArgs({ ...queryArgs, page: Math.min(Math.max(p, 1), total) });

	useEffect(() => {
		if (scroll) {
			const scrollEl = document.forms['wca-woo-filters'];
			scrollToElement(scrollEl);
		}
		setScroll(true);
	}, [page]);

	const ReaderText = ({ text }) => <span class="screen-reader-text">{text}</span>;

	const renderAdjacent = (prev = false) => {
		const goToPage = prev ? page - 1 : page + 1;
		const isPrevDisabled = [prev === true && page === 1 ? 'disabled' : ''];
		const isNextDisabled = [prev === false && page === parseFloat(total) ? 'disabled' : ''];
		const classNames = [
			'woocommerce-Reviews__pagination-item',
			'woocommerce-Reviews__pagination-item--' + (prev ? 'prev' : 'next'),
			...isPrevDisabled,
			...isNextDisabled
		].filter(Boolean);

		const isDisabled = prev === true && page === 1 || prev === false && page === parseFloat(total);

		const props = {
			className: 'woocommerce-Reviews__pagination-link',
			href: !isDisabled ? 'javascript:void(0);' : null,
			onClick: !isDisabled ? () => setPage(goToPage) : null,
		}

		const Inner = () => <span aria-hidden="true" dangerouslySetInnerHTML={{ __html: prev ? '&laquo;' : '&raquo;' }}></span>;

		return (
			<li className={classNames.join(' ')}>{
				isDisabled ?
					<span {...props}><Inner /> <ReaderText text={__('Next page', 'wca-woocommerce')} /></span>
					:
					<a {...props}><Inner /> <ReaderText text={__('Previous page', 'wca-woocommerce')} /></a>
			}</li>
		);
	};

	const generateDots = () => <li className="woocommerce-Reviews__pagination-item woocommerce-Reviews__pagination-item--dots">
		<span className="woocommerce-Reviews__pagination-link">...<ReaderText text={__('dots', 'wca-woocommerce')} /></span>
	</li>;

	const generateLink = (p) => {
		const isCurrent = parseFloat(p) === page;

		const classNames = [
			'woocommerce-Reviews__pagination-link',
			...[isCurrent ? 'has-primary-background-color' : ''],
		].filter(Boolean);

		const props = {
			className: classNames.join(' '),
			href: !isCurrent ? 'javascript:void(0);' : null,
			onClick: !isCurrent ? () => setPage(p) : null,
			'aria-current': isCurrent ? 'page' : null
		};

		return (
			<li className={[
				'woocommerce-Reviews__pagination-item',
				...[isCurrent ? 'woocommerce-Reviews__pagination-item--current' : '']
			].filter(Boolean).join(' ')}>{
					isCurrent ?
						<span {...props}><ReaderText text={__('Page', 'wca-woocommerce')} /> {p}</span>
						:
						<a {...props}><ReaderText text={__('Page', 'wca-woocommerce')} /> {p}</a>
				}</li>
		);
	};

	const generateLinks = () => {
		let d = 2, range = [];

		for (let i = Math.max(2, page - d); i <= Math.min(total - 1, page + d); i++) range.push(generateLink(i));
		if (page + d < total - 1) range.push(generateDots());
		if (page - d > 2) range.unshift(generateDots());
		range.unshift(generateLink(1));
		range.push(generateLink(total));

		return range;
	};

	const style = {};

	if (loading) {
		style.pointerEvents = 'none';
		style.opacity = .65;
	}

	return (
		<nav className="woocommerce-Reviews__pagination" aria-label={__('Reviews pagination', 'wca-woocommerce')}>
			<ul className="woocommerce-Reviews__pagination-list" style={style}>
				{renderAdjacent(true)}
				{generateLinks()}
				{renderAdjacent()}
			</ul>
		</nav>
	);
};