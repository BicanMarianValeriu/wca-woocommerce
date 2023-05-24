/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */

import './../scss/index.scss';

export default (function (wecodeart) {

	wecodeart.routes = {
		...wecodeart.routes,
		woocommerceJs: {
			complete: () => {
				const forms = document.querySelectorAll('.wpcf7-form');
				[...forms].map(el => el.addEventListener('change', () => el.classList.add('was-validated')));
			}
		}
	};
}).apply(this, [window.wecodeart]);