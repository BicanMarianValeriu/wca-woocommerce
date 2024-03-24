import { renderToString as _render } from '../functions';

const { Template = { renderToString: _render } } = window.wecodeart || {};

export default ({ userData = {}, note, options }) => {
	const { product: { title: productTitle } } = options;
	const { reviewer: userName = 'visitor' } = userData;

	return (note && <div {...{
		className: 'woocommerce-Reviews__respond-note',
		dangerouslySetInnerHTML: { __html: Template.renderToString(note, { userName, productTitle }) },
	}} />);
};