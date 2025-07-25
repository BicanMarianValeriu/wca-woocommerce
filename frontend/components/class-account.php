<?php
/**
 * The frontend-specific functionality of the plugin.
 *
 * @link       https://www.wecodeart.com/
 * @since      1.0.0
 *
 * @package    WCA\EXT\WOO
 * @subpackage WCA\EXT\WOO\Frontend\Components\Account
 */

namespace WCA\EXT\WOO\Frontend\Components;

use WCA\EXT\WOO\Frontend\Components\Base;

/**
 * Account Styles
 */
class Account extends Base {
    /**
     * Component blocks.
     *
     * @return 	array
     */
	public static function blocks(): array {
		if( is_account_page() ) {
			// Global
			return [];
		}

		return [
			'wocommerce/account' // Non-existent
		];
	}

    /**
	 * Component styles.
	 *
	 * @return 	string
	 */
	public static function styles(): string {
		return '
			.woocommerce-js :where(.form-row-first,.form-row-last,.form-row-wide) {
				margin: 0;
				grid-column: auto/span 2;
			}
			@media (min-width: 768px) {
				.woocommerce-js :where(.form-row-first,.form-row-last) {
					grid-column: auto/span 1;
				}
			}
			
			.woocommerce-MyAccount-navigation-link.is-active a,
			.woocommerce-MyAccount-navigation-link:hover a {
				background-color: var(--wp--preset--color--accent);
			}
			.woocommerce-MyAccount-navigation-link a {
				position: relative;
				display: block;
				padding: 0.5rem 0.75rem;
				color: inherit;
				text-decoration: none;
				background-color: transparent;
				border: 1px solid var(--wp--preset--color--accent);
				margin-top: -1px;
			}
			.woocommerce-MyAccount-navigation-link a:last-child {
				border-bottom-right-radius: inherit;
				border-bottom-left-radius: inherit;
			}
			.woocommerce-MyAccount-navigation-link a:first-child {
				border-top-left-radius: inherit;
				border-top-right-radius: inherit;
			}
			.woocommerce-MyAccount-navigation-link a::before {
				content: "";
				display: inline-block;
				margin-right: 0.5em;
				height: 1em;
				min-width: 1em;
				vertical-align: -0.125em;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
				filter: brightness(0);
			}
			.woocommerce-MyAccount-navigation-link--dashboard a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="white" d="M411.56 173.94l-97.09 119.94c-8.09-3.69-17-5.88-26.47-5.88-35.35 0-64 28.65-64 64s28.65 64 64 64 64-28.65 64-64c0-14.26-4.82-27.3-12.71-37.94l97.14-120c5.56-6.86 4.5-16.94-2.38-22.5-6.89-5.54-16.93-4.5-22.49 2.38zM288 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-352C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm221.5 416l-442.8.68C44 409.75 32 365.26 32 320 32 178.84 146.84 64 288 64s256 114.84 256 256c0 45.26-12 89.75-34.5 128z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--orders a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="white" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zm-22.6 22.7c2.1 2.1 3.5 4.6 4.2 7.4H256V32.5c2.8.7 5.3 2.1 7.4 4.2l83.9 83.9zM336 480H48c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h176v104c0 13.3 10.7 24 24 24h104v304c0 8.8-7.2 16-16 16zm-48-244v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm0 64v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm0 64v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--downloads a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="white" d="M452 432c0 11-9 20-20 20s-20-9-20-20 9-20 20-20 20 9 20 20zm-84-20c-11 0-20 9-20 20s9 20 20 20 20-9 20-20-9-20-20-20zm144-48v104c0 24.3-19.7 44-44 44H44c-24.3 0-44-19.7-44-44V364c0-24.3 19.7-44 44-44h99.4L87 263.6c-25.2-25.2-7.3-68.3 28.3-68.3H168V40c0-22.1 17.9-40 40-40h96c22.1 0 40 17.9 40 40v155.3h52.7c35.6 0 53.4 43.1 28.3 68.3L368.6 320H468c24.3 0 44 19.7 44 44zm-261.7 17.7c3.1 3.1 8.2 3.1 11.3 0L402.3 241c5-5 1.5-13.7-5.7-13.7H312V40c0-4.4-3.6-8-8-8h-96c-4.4 0-8 3.6-8 8v187.3h-84.7c-7.1 0-10.7 8.6-5.7 13.7l140.7 140.7zM480 364c0-6.6-5.4-12-12-12H336.6l-52.3 52.3c-15.6 15.6-41 15.6-56.6 0L175.4 352H44c-6.6 0-12 5.4-12 12v104c0 6.6 5.4 12 12 12h424c6.6 0 12-5.4 12-12V364z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--edit-address a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="white" d="M512 32H64C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm32 384c0 17.6-14.4 32-32 32H64c-17.6 0-32-14.4-32-32V96c0-17.6 14.4-32 32-32h448c17.6 0 32 14.4 32 32v320zm-72-128H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0-64H360c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM208 288c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm46.8 144c-19.5 0-24.4 7-46.8 7s-27.3-7-46.8-7c-21.2 0-41.8 9.4-53.8 27.4C100.2 342.1 96 355 96 368.9V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-7 2.1-13.8 6-19.6 5.6-8.3 15.8-13.2 27.3-13.2 12.4 0 20.8 7 46.8 7 25.9 0 34.3-7 46.8-7 11.5 0 21.7 5 27.3 13.2 3.9 5.8 6 12.6 6 19.6V392c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-23.1c0-13.9-4.2-26.8-11.4-37.5-12.3-18-32.9-27.4-54-27.4z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--edit-account a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="white" d="M313.6 288c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--customer-logout a::before {
				background-image: url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="white" d="M160 217.1c0-8.8 7.2-16 16-16h144v-93.9c0-7.1 8.6-10.7 13.6-5.7l141.6 143.1c6.3 6.3 6.3 16.4 0 22.7L333.6 410.4c-5 5-13.6 1.5-13.6-5.7v-93.9H176c-8.8 0-16-7.2-16-16v-77.7m-32 0v77.7c0 26.5 21.5 48 48 48h112v61.9c0 35.5 43 53.5 68.2 28.3l141.7-143c18.8-18.8 18.8-49.2 0-68L356.2 78.9c-25.1-25.1-68.2-7.3-68.2 28.3v61.9H176c-26.5 0-48 21.6-48 48zM0 112v288c0 26.5 21.5 48 48 48h132c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H48c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16h132c6.6 0 12-5.4 12-12v-8c0-6.6-5.4-12-12-12H48C21.5 64 0 85.5 0 112z"></path></svg>\');
			}
			.woocommerce-MyAccount-navigation-link--backinstock a::before {
				background-image: url(\'data:image/svg+xml;utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 307 246"%3E%3Cpath d="M197 3.6c-14.5 3.9-24.5 15.1-26.9 30.4-.7 4.1-1.1 33-1.1 78.2v71.7l-5.2 1.6c-2.9.8-39 10.7-80.2 21.9C38.3 219.9 8 228.6 6.8 229.7c-2.8 2.5-2.1 8 1.3 10.6l2.7 1.9 93.3-25.2c51.4-13.9 93.8-25.3 94.3-25.4.5 0 1.4 3.1 2.1 7 3.8 21.8 21.6 39.1 43.7 42.6 31.3 4.8 59.8-19.9 59.8-51.7 0-31.8-28.5-56.5-59.7-51.7-17.3 2.7-32.4 14-40 29.8l-3.8 7.8-8.3 2.2-8.3 2.3.3-73.2c.3-72.8.3-73.2 2.5-77.2 2.7-5.1 5.7-7.9 11.3-10.4 4.3-2 6.3-2.1 52.6-2.1 47.2 0 48.2 0 50.8-2.1 3.6-2.8 3.6-8 0-10.8-2.6-2.1-3.6-2.1-50.8-2-39 0-49.1.3-53.6 1.5zm70.4 151.7c7.1 3.3 15 11.1 18.4 18.5 2.4 5 2.7 6.9 2.7 15.7 0 8.8-.3 10.7-2.7 15.7-3.4 7.4-11.2 15.2-18.6 18.6-4.9 2.3-7 2.7-15.2 2.7-8.8 0-10.1-.3-16.2-3.3-8.3-4.1-15.8-12-18.9-20-3.1-7.9-3.1-19.5 0-27.4 3.9-9.9 13.6-18.9 24.4-22.4 6.5-2.2 19.2-1.2 26.1 1.9z"/%3E%3Cpath d="M61.9 71.5c-20.7 5.6-38.5 10.7-39.5 11.3-1 .6-3 2.2-4.3 3.5-4.6 5-4.2 8.1 6.8 48.8 5.6 20.6 10.4 38.1 10.7 39 .2.8 1.8 2.9 3.4 4.6 5.6 5.7 6.8 5.6 49.2-5.7 21-5.6 39.5-10.8 41-11.6 4.1-2.1 6.8-7.1 6.8-12.3 0-5.9-19.4-78.5-22-82.1-2.3-3.3-7.7-6-11.7-5.9-1.5 0-19.7 4.7-40.4 10.4zm50.2 40.8c5.9 22.6 9.1 36.4 8.5 36.6-4.7 1.9-71.2 18.8-71.7 18.3-.7-.7-18.9-69.3-18.9-71.1 0-1 4.9-2.7 11-3.7l3.6-.6 1.8 7.9c3.5 14.9 5.5 20 8.7 22.7 4 3.4 6.6 3.3 21.7-.8 18.8-5.1 19.6-6.5 14.5-27.1-1.8-7.6-3-14.2-2.6-14.6.7-.7 10.5-3.6 12.8-3.8.6-.1 5.3 16.2 10.6 36.2zM75.6 92.6c3.9 14.8 4.4 12.9-3.7 14.9-3.8 1-7.2 1.5-7.5 1.2-.6-.6-5.3-18.5-5.4-20.3 0-1 11.4-4.4 13.5-4 .6.2 1.9 3.8 3.1 8.2z"/%3E%3C/svg%3E\');
			}
			.woocommerce-MyAccount-navigation ul {
				display: flex;
				flex-direction: column;
			}
			
			.woocommerce-OrderUpdate__meta {
				position: absolute;
				right: 0;
				bottom: 100%;
				margin-bottom: 0;
				font-size: 80%;
			}
			.woocommerce-OrderUpdate__description p {
				margin-bottom: 0.5rem;
			}
			.woocommerce-OrderUpdate__description p:last-child {
				margin-bottom: 0;
			}
			
			.woocommerce-password-strength {
				margin-top: 0.5rem;
				font-weight: bold;
				font-style: italic;
			}
			.woocommerce-password-strength.short,
			.woocommerce-password-strength.bad {
				color: var(--wp--preset--color--danger);
			}
			.woocommerce-password-strength.good {
				color: var(--wp--preset--color--warning);
			}
			.woocommerce-password-strength.strong {
				color: var(--wp--preset--color--success);
			}
			
			#billing_state_field label,
			#billing_country_field label {
				margin-bottom: 0.5rem;
			}
        ';
	}
}
