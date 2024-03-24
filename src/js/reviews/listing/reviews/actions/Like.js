import Action from './Action';

const { element: { useState } } = wp;

const Component = ({ review, options, likedReviews, setLikedReviews, userData }) => {
    const { id: reviewId, likes: hasLikes } = review;
    const { requestUrl } = options;

    const isReviewLiked = likedReviews.includes(parseInt(reviewId));
    const [likes, setLikes] = useState(hasLikes);
    const [liking, setLiking] = useState(false);

    let actionProps = {
        icon: isReviewLiked ? 'liked' : 'like',
        disabled: liking === true,
    };

    if (userData) {
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
                const newLiked = isReviewLiked ? likedReviews.filter(i => parseInt(i) !== parseInt(reviewId)) : [...likedReviews, reviewId];
                setLikedReviews(newLiked);
            } finally {
                setLiking(false);
            }
        };

        actionProps = { ...actionProps, onClick };
    }

    return (
        <Action {...actionProps} >
            <span className="count">({likes})</span>
        </Action>
    );
};

export default {
    key: 'like',
    Component,
};