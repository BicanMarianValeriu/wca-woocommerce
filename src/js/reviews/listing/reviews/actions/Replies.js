import Action from './Action';
import { scrollToElement } from '../../../functions';

const {
    i18n: { __ },
    element: { useState, useEffect, lazy, Suspense },
} = wp;

const CommentsList = lazy(() => import(/* webpackChunkName: 'CommentList' */ '../../comments'));

const Component = ({ review, options, comments, setComments, loading, setLoading }) => {
    const { replies = [], id: reviewId } = review;
    const { requestUrl } = options;

    const [scroll, setScroll] = useState(false);

    useEffect(() => {
        if (scroll) {
            const containerEl = document.querySelector(`#review-${reviewId}`);
            scrollToElement(containerEl);
        }
        setScroll(true);
    }, [comments]);

    if (replies.length) {
        const onClick = async (e) => {
            if (loading) {
                return;
            }

            if (comments.length) {
                const container = e.currentTarget.parentNode.parentNode.querySelector('.woocommerce-Reviews__listing--comments');
                if (container) {
                    container.style.display = container?.style?.display === 'none' ? 'block' : 'none';
                    return;
                }
            }

            const formData = new FormData();
            formData.append('action', 'query');
            formData.append('include', replies);

            setLoading(true);

            try {
                const r = await fetch(requestUrl, {
                    method: 'POST',
                    body: formData,
                });

                const { data } = await r.json();

                return setComments(data);
            } catch(e) {
                console.warn(e);
                setComments([]);
            } finally {
                setLoading(false);
            }
        };

        return (
            <Action {...{ label: __('View Comments', 'wca-woocommerce'), icon: 'comments', onClick }}>
                <span className="count"> ({replies.length}) </span>
            </Action>
        );
    }
};

const After = ({ loading, comments, avatar }) => {
    if (comments.length) {
        return (
            <Suspense fallback={<div>Loading...</div>}>
                <CommentsList {...{ comments, loading, avatar }} />
            </Suspense>
        );
    }
};

export default {
    key: 'comments',
    Component,
    After
};