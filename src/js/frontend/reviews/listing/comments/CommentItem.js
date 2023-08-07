import { formatDate, generateAvatarDataURL, getInitials } from '../../functions';

const {
	i18n: { __, sprintf }
} = wp;

export default ({
	id,
	content,
	date,
	author: {
		name: authorName,
		avatar: authorAvatar,
	},
	avatar,
}) => {

	return (
		<div className="woocommerce-Reviews__item woocommerce-Reviews__item--comment has-accent-background-color" id={`comment-${id}`} key={id}>
			<div className="grid" style={{ padding: '1rem' }}>
				<div className="span-3 span-sm-2 span-lg-1">
					<img {...{
						width: 50,
						src: avatar === 'initials' ? generateAvatarDataURL(getInitials(authorName)) : authorAvatar,
						alt: sprintf(__("%s's Avatar", 'wca-woo-reviews'), authorName)
					}} />
				</div>
				<div className="span-9 span-sm-10 span-lg-11">
					<div className="woocommerce-Reviews__item-meta">
						<strong>{authorName}</strong>
						<span> - </span>
						<em class="has-cyan-bluish-gray-color small">{formatDate(date)}</em>
					</div>
					<div className="woocommerce-Reviews__item-content" dangerouslySetInnerHTML={{ __html: content }} />
				</div>
			</div>
		</div>
	);
};