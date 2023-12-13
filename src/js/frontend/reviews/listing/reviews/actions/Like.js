import Action from './Action';

const { element: { useState } } = wp;

const Component = ({ review, options, userData }) => {
    const { id: reviewId, likes: hasLikes } = review;
    const { requestUrl } = options;

    const { liked = [] } = userData;
    const isReviewLiked = liked.includes(reviewId);
    const [likes, setLikes] = useState(hasLikes);
    const [liking, setLiking] = useState(false);

    const onClick = async () => {
        if (liking) return;

        setLiking(true);

        const formData = new FormData();
        formData.append('action', 'like');
        formData.append('review_id', reviewId);

        try {
            const r = await fetch(requestUrl, {
                method: 'POST',
                body: formData,
            });

            const { likes } = await r.json();

            setLikes(likes);
        } finally {
            setLiking(false);
        }
    };

    return (
        <Action {...{ icon: isReviewLiked ? 'liked' : 'like', disabled: liking === true, onClick }} >
            <span className="count">({likes})</span>
        </Action>
    );
};

export default {
    key: 'like',
    Component,
};