import CommentItem from './CommentItem';
import Preloader from '../preloaders/CommentPreloader';

export default ({ loading, comments, avatar }) => {
	return (
		<div className="woocommerce-Reviews__listing woocommerce-Reviews__listing--comments is-layout-flow">
			{loading && comments.map((_, i) => <div className="my-spacer" key={i} dangerouslySetInnerHTML={{ __html: Preloader }} />)}
			{!loading && comments.map((item) => <CommentItem {...{ ...item, avatar }} />)}
		</div>
	);
};