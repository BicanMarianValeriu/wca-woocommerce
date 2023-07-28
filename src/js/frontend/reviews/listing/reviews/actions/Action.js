export default ({ icon = false, label = 'Label', children, ...rest }) => {
	rest = { className: 'wp-element-button wp-block-button__link has-black-color has-small-font-size fw-400 me-2', ...rest };
	
	return (
		<button {...rest}>
			{icon && <span className={`woocommerce-Reviews__icon woocommerce-Reviews__icon--${icon} me-1`} />}
			<span>{label}</span>
			{children}
		</button>
	);
};