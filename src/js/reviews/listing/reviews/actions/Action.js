import Icon from '../../../shared/Icon';

export default ({ icon = false, label, children, ...rest }) => {
	rest = { className: 'wp-element-button has-background has-black-color has-small-font-size', ...rest };
	
	return (
		<button {...rest}>
			{icon && <Icon icon={icon} />}
			{label && <span className="wp-element-button__label">{label}</span>}
			{children}
		</button>
	);
};