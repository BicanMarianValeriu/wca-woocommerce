/**
 * @package: 	WeCodeArt WOO Reviews
 * @author: 	BicanMarianValeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */
import './../../../scss/reviews.scss';

const {
	hooks: { doAction },
	element: { render },
} = wp;

const { container = '#reviews' } = wpBlockWooReviews || {};
import( /* webpackChunkName: "App" */ './App').then(({ App }) => {
	doAction('wecodeart.woocommerce.reviews.loaded', wpBlockWooReviews);
	render(<App {...wpBlockWooReviews} />, document.querySelector(container));
});