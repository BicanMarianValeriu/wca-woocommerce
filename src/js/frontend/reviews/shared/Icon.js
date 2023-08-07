export default ({ icon = 'default', ...rest }) => {
	return (
		<span className={`woocommerce-Reviews__icon woocommerce-Reviews__icon--${icon}`} role="img" {...rest} />
	);
};