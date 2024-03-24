import CommentItem from './CommentItem';
import Preloader from './../preloaders/CommentPreloader';

export default ({ loading, comments }) => {
	return (
		<div className="woocommerce-Reviews__listing woocommerce-Reviews__listing--comments is-layout-flow">
			{loading && comments.map((_, i) => <div className="my-3" key={i} dangerouslySetInnerHTML={{ __html: Preloader }} />)}
			{!loading && comments.map((item) => <CommentItem {...item} />)}
		</div>
	);
};