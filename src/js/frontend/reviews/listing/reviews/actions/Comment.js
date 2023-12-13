import Action from './Action';
import AddComment from '../../comments/AddComment';

const {
    i18n: { __ },
} = wp;

const Component = ({ review, userData, onAddComment }) => {
    if (userData) {
        const { id: reviewId } = review;
        const onClick = () => onAddComment(reviewId);

        return (<Action {...{ label: __('Add Comment', 'wca-woocommerce'), icon: 'comment', onClick }} />);
    }

    return null;
};

const After = ({ review, options, addComment, setAddComment  }) => {
    const { id: reviewId } = review;
    const { product: { ID: productId }, requestUrl } = options;

    if (addComment === reviewId) {
        return (<AddComment {...{ addComment, setAddComment, productId, requestUrl }} />);
    }

    return null;
};

export default {
    key: 'comment',
    Component,
    After
};