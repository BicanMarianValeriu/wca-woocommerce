export default ({ userData = {}, note, options }) => {
	const { Template } = wecodeart;
	const { product: { title: productTitle } } = options;
	const { reviewer: userName = 'visitor' } = userData;

	return (note && <div {...{
		className: 'woocommerce-Reviews__respond-note',
		dangerouslySetInnerHTML: { __html: Template.renderToString(note, { userName, productTitle }) },
	}} />);
};