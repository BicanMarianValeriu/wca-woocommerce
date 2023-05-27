/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */

import './../../scss/index.scss';

export default (function (wecodeart) {
	wecodeart.routes = {
		...wecodeart.routes,
		woocommerceJs: {
			complete: () => {
				const handleButtonClick = (input, action) => {
					const value = parseInt(input.value, 10) || 0;
					const min = parseInt(input.getAttribute('min'), 10) || 0;
					const max = parseInt(input.getAttribute('max'), 10) || 99999;
			
					input.value = (action === '-' && value > min) ? value - 1 : (action === '+' && value < max) ? value + 1 : value;
					input.dispatchEvent(new Event('change'));
				};
			
				document.querySelectorAll('.quantity.wc-block-components-quantity-selector:not([hasQtyInit])').forEach((item) => {
					item.hasQtyInit = true;
					const input = item.querySelector('.wc-block-components-quantity-selector__input');
			
					item.querySelectorAll('.wc-block-components-quantity-selector__button').forEach((el) => {
						el.addEventListener('click', () => handleButtonClick(input, el.value));
					});
				});
			}
		}
	};
}).apply(this, [window.wecodeart]);