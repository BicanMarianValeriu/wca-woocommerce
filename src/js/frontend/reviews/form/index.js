import { useForm } from 'react-hook-form';
import SuggestTitle from './SuggestTitle';
import Notification from './Notification';
import RatingInput from './../shared/RatingInput';

const {
	i18n: { __ },
	hooks: { doAction },
	element: { useState },
} = wp;

export default ({ rating, setRating, queryArgs, setQueryArgs, userData = false, options }) => {
	const { product: { ID: productId }, terms, note, requestUrl } = options;

	const [loading, setLoading] = useState(false);
	const [message, setMessage] = useState(false);

	const { handleSubmit, register, errors } = useForm();

	const onClick = (value, e) => {
		const formElement = document.forms['wca-woo-addreview'];
		formElement.elements.rating.value = value;

		const starsBtns = Array.prototype.slice.call(formElement.querySelectorAll('.woocommerce-Reviews__star'));
		for (let i = 0; i < starsBtns.length; i++) starsBtns[i].classList.remove('active');
		e.currentTarget.className = 'active';

		setRating(value);
	};

	const onSubmit = async (values, e) => {
		if (loading) {
			return;
		}

		const formData = new FormData();
		formData.append('action', 'review');
		formData.append('product_id', productId);

		Object.keys(values).map(k => formData.append(k, values[k]));

		if (userData) {
			Object.keys(userData).map(k => formData.append(k, userData[k]));
		}

		setLoading(true);

		try {
			const r = await fetch(requestUrl, {
				method: 'POST',
				body: formData,
			});

			const { message } = await r.json();

			setMessage(message);
		} finally {
			setLoading(false);
			// Reset Rating
			setTimeout(() => setRating(false), 3000);
			// Scroll to notification
			e.target.querySelector('#review-success').scrollIntoView({ behavior: 'smooth', block: 'end' });
			// Reset Reviews
			e.target.reset();
			setQueryArgs({ ...queryArgs });
		}
	};

	return (
		<div className="woocommerce-Reviews__respond">
			<div className="grid">
				{note && <div className="span-12 span-lg-4 start-lg-9">
					<Notification {...{ userData, note, options }} />
				</div>}
				<div className="span-12 span-lg-7 order-lg-first">
					<form className="woocommerce-Reviews__respond-form" name="wca-woo-addreview" onSubmit={handleSubmit(onSubmit)}>
						{doAction('wecodeart.woocommerce.reviews.newReview.top', register, errors, options)}
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-3">
								<RatingInput {...{ rating, setRating, onClick, register: register({ validate: value => value !== 0 }) }} />
								<input type="hidden" name="rating" value={rating} ref={register({
									required: __('This cannot be empty!', 'wca-woocommerce'),
									minLength: 0,
									maxLength: 5,
								})} />
							</div>
						</div>
						{!userData && <div className="woocommerce-Reviews__respond-field grid">
							<div className="mb-3 span-12 span-md-6">
								<label className="mb-0 fw-700" for="reviewer">{__('Name', 'wca-woocommerce')}:</label>
								<input className="form-control" type="text" name="reviewer" id="reviewer" ref={register({
									required: __('What is your name?', 'wca-woocommerce'),
									validate: value => value !== 'admin' || __('Nice Try', 'wca-woocommerce'),
								})} placeholder={__('Name', 'wca-woocommerce')} />
								{errors.reviewer && <em class="invalid-feedback d-block">{errors.reviewer.message}</em>}
							</div>
							<div className="mb-3 span-12 span-md-6">
								<label className="mb-0 fw-700" for="reviewer_email">{__('Email', 'wca-woocommerce')}:</label>
								<input className="form-control" type="email" name="reviewer_email" id="reviewer_email" ref={register({
									required: __('What is your email address?', 'wca-woocommerce'),
									pattern: {
										value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
										message: __('Invalid email address.', 'wca-woocommerce')
									}
								})} placeholder={__('Email', 'wca-woocommerce')} />
								{errors.reviewer_email && <em class="invalid-feedback d-block">{errors.reviewer_email.message}</em>}
							</div>
						</div>}
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-3">
								<label className="mb-0 fw-700" for="review_title">{__('Review title (optional)', 'wca-woocommerce')}:</label>
								<input className="form-control" type="text" name="title" id="review_title" ref={register}
									placeholder={__('Use a suggestion or write your own title', 'wca-woocommerce')} />
							</div>
							<div className="mb-3">
								<SuggestTitle rating={rating} />
							</div>
						</div>
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-3">
								<label className="mb-0 fw-700" for="review">{__('Review', 'wca-woocommerce')}:</label>
								<textarea className="form-control" id="review" name="review" rows="7" required="" ref={register({
									required: __('This cannot be empty!', 'wca-woocommerce'),
									minLength: 20
								})} placeholder={__('Describe your experience with the product', 'wca-woocommerce')} ></textarea>
								{errors.review && <em class="invalid-feedback d-block">{
									errors.review.type === 'minLength' ? __('Please be more descriptive.', 'wca-woocommerce') : errors.review.message
								}</em>}
							</div>
						</div>
						{doAction('wecodeart.woocommerce.reviews.newReview.bottom', register, errors, options)}
						{terms && <div className="woocommerce-Reviews__respond-field woocommerce-Reviews__respond-field--terms">
							<div className="mb-3">
								<p className="has-small-font-size has-cyan-bluish-gray-color" dangerouslySetInnerHTML={{ __html: terms }} />
							</div>
						</div>}
						<div className="woocommerce-Reviews__respond-field">
							<button type="submit" className="wp-element-button has-primary-background-color py-1" {...{ disabled: loading === true }}>{
								__('Add Review', 'wca-woocommerce')
							}</button>
							<span className="mx-1"></span>
							<a href="javascript:void(0);" onClick={() => setRating(false)} className="wp-element-link">{
								__('Cancel', 'wca-woocommerce')
							}</a>
							{message && <div id="review-success" className="rounded has-accent-background-color p-3 mt-3">{message}</div>}
						</div>
					</form >
				</div>
			</div>
		</div>
	);
};