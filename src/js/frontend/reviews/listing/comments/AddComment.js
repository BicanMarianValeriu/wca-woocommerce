import { useForm } from 'react-hook-form';

const {
	i18n: { __ },
	hooks: { doAction },
	element: { useState }
} = wp;

export default ({ addComment, setAddComment, productId, requestUrl }) => {
	const { handleSubmit, register, errors = false } = useForm();
	const [loading, setLoading] = useState(false);
	const [message, setMessage] = useState(false);

	const onSubmit = async (values) => {
		if (loading) {
			return;
		}

		const formData = new FormData();
		formData.append('action', 'comment');
		formData.append('product_id', productId);
		formData.append('parent', addComment);

		Object.keys(values).map(k => formData.append(k, values[k]));

		setLoading(true);

		try {
			const r = await fetch(requestUrl, {
				method: 'POST',
				body: formData,
			});

			const { message } = await r.json();
			
			return setMessage(message);
		} finally {
			setLoading(false);
			setTimeout(() => setAddComment(false), 5000);
		}
	};

	return (
		<>
			{message ?
				<div className="has-accent-background-color rounded p-3 my-3"><p className="mt-0">{message}</p></div>
				:
				<form className="woocommerce-Reviews__comment" onSubmit={handleSubmit(onSubmit)} name="wca-woo-comment">
					{doAction('wecodeart.woocommerce.reviews.newComment.top', register, errors, productId)}
					<div className="position-relative my-3">
						<textarea className="form-control" id="comment" name="comment" rows="7" required="" ref={register({
							required: __('This cannot be empty!', 'wca-woocommerce'),
							minLength: 20
						})} placeholder={__('Your comment', 'wca-woocommerce')}></textarea>
						{errors.comment && <em class="invalid-feedback d-block">{
							errors.comment.type === 'minLength' ? __('Comment is too short.', 'wca-woocommerce') : errors.comment.message
						}</em>}
					</div>
					{doAction('wecodeart.woocommerce.reviews.newComment.bottom', register, errors, productId)}
					<button {...{
						type: 'submit',
						className: 'wp-element-button has-primary-background-color py-1',
						disabled: loading === true || errors.comment === false || errors.comment
					}}>
						<span>{loading ? __('Submitting...', 'wca-woocommerce') : __('Add Comment', 'wca-woocommerce')}</span>
					</button>
				</form>
			}
		</>
	);
};