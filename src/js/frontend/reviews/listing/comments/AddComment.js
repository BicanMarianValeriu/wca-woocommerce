import { useForm } from 'react-hook-form';

const {
	i18n: { __ },
	hooks: { doAction },
	element: { useState }
} = wp;

export default ({ addComment, setAddComment, productId, requestUrl }) => {
	const [loading, setLoading] = useState(false);
	const [message, setMessage] = useState(false);
	const { handleSubmit, register, formState: { errors } } = useForm({
		mode: 'onSubmit',
		defaultValues: {
			comment: ''
		}
	});

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

	console.log(errors);

	return (
		<>
			{message ?
				<div className="has-accent-background-color my-spacer" style={{ padding: '1rem', borderRadius: '.25rem' }}>
					<p>{message}</p>
				</div>
				:
				<form className="woocommerce-Reviews__comment" onSubmit={handleSubmit(onSubmit)} name="wca-woo-comment">
					{doAction('wecodeart.woocommerce.reviews.newComment.top', register, errors, productId)}
					<div className="position-relative my-spacer">
						<textarea className="form-control" id="comment" rows="7" placeholder={__('Your comment', 'wca-woocommerce')}
							{...register('comment', {
								required: __('This cannot be empty!', 'wca-woocommerce'),
								minLength: 20
							})}
						/>
						{errors.comment && <em class="invalid-feedback" style={{ display: 'block' }}>{
							errors.comment.type === 'minLength' ? __('Comment is too short.', 'wca-woocommerce') : errors.comment.message
						}</em>}
					</div>
					{doAction('wecodeart.woocommerce.reviews.newComment.bottom', register, errors, productId)}
					<button {...{
						type: 'submit',
						className: 'wp-element-button has-primary-background-color',
						disabled: loading === true || errors.comment === false || errors.comment
					}}>
						<span>{loading ? __('Submitting...', 'wca-woocommerce') : __('Add Comment', 'wca-woocommerce')}</span>
					</button>
				</form>
			}
		</>
	);
};