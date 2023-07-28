import { formatDate } from '../../functions';

const {
	i18n: { __, sprintf }
} = wp;

export default ({
	id,
	content,
	date,
	author: {
		name: authorName,
		avatar: authorAvatar = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89B8AAskB44g04okAAAAASUVORK5CYII=',
	}
}) => {

	return (
		<div className="woocommerce-Reviews__item woocommerce-Reviews__item--comment has-accent-background-color rounded" id={`comment-${id}`} key={id}>
			<div className="grid p-3">
				<div className="span-2 span-md-1">
					<img {...{
						className: 'has-accent-border-color shadow rounded-circle my-1',
						width: 50,
						src: authorAvatar,
						alt: sprintf(__("%s's Avatar", 'wca-woo-reviews'), authorAvatar)
					}} />
				</div>
				<div className="span-10 span-lg-11">
					<div className="woocommerce-Reviews__item-meta">
						<strong>{authorName}</strong>
						<span class="mx-1">-</span>
						<em class="has-cyan-bluish-gray-color has-small-font-size">{formatDate(date)}</em>
					</div>
					<div className="woocommerce-Reviews__item-content" dangerouslySetInnerHTML={{ __html: content }} />
				</div>
			</div>
		</div>
	);
};