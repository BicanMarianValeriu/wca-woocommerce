import { useForm } from 'react-hook-form';
import SuggestTitle from './SuggestTitle';
import Notification from './Notification';
import RatingInput from '../shared/RatingInput';

const {
	i18n: { __ },
	hooks: { doAction },
	element: { useState },
} = wp;

export default ({ rating, setRating, queryArgs, setQueryArgs, userData = false, options, breakpoint }) => {
	const { product: { ID: productId }, terms, note, requestUrl } = options;

	const [loading, setLoading] = useState(false);
	const [message, setMessage] = useState(false);

	const { handleSubmit, register, reset: resetForm, formState: { errors }, setValue } = useForm({
		mode: 'onSubmit',
	});

	const setTitle = (value) => setValue('title', value);

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
		} catch (e) {
			console.warn(e);
			setMessage(e);
		} finally {
			setLoading(false);
			// Reset Rating
			setTimeout(() => setRating(false), 3000);
			// Reset Reviews
			resetForm();
			setQueryArgs({ ...queryArgs });
		}
	};

	return (
		<div className="woocommerce-Reviews__respond">
			<div className="grid">
				{note && <div className="span-12 span-lg-4 start-lg-9">
					<Notification {...{ userData, note, options }} />
				</div>}
				<div className="span-12 span-lg-7" style={{ gridRow: breakpoint === 'mobile' ? 'initial' : 1 }}>
					<form className="woocommerce-Reviews__respond-form" name="wca-woo-addreview" onSubmit={handleSubmit(onSubmit)}>
						{doAction('wecodeart.woocommerce.reviews.newReview.top', register, errors, options)}
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-spacer">
								<RatingInput {...{ rating, onClick: setRating }}>
									<input type="hidden" name="rating" value={rating}
										{...register('rating', {
											validate: value => value !== 0,
											minLength: 1,
											maxLength: 5
										})}
									/>
								</RatingInput>
							</div>
						</div>
						{!userData && <div className="woocommerce-Reviews__respond-field grid">
							<div className="mb-spacer span-12 span-md-6">
								<label for="reviewer">{__('Name', 'wca-woocommerce')}:</label>
								<input className="form-control" type="text" id="reviewer" placeholder={__('Name', 'wca-woocommerce')}
									{...register('reviewer', {
										required: __('What is your name?', 'wca-woocommerce'),
										validate: value => value !== 'admin' || __('Nice Try', 'wca-woocommerce'),
									})}
								/>
								{errors.reviewer && <em class="invalid-feedback" style={{ display: 'block' }}>{errors.reviewer.message}</em>}
							</div>
							<div className="mb-spacer span-12 span-md-6">
								<label for="reviewer_email">{__('Email', 'wca-woocommerce')}:</label>
								<input className="form-control" type="email" id="reviewer_email" placeholder={__('Email', 'wca-woocommerce')}
									{...register('reviewer_email', {
										required: __('What is your email address?', 'wca-woocommerce'),
										pattern: {
											value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
											message: __('Invalid email address.', 'wca-woocommerce')
										}
									})}
								/>
								{errors.reviewer_email && <em class="invalid-feedback" style={{ display: 'block' }}>{errors.reviewer_email.message}</em>}
							</div>
						</div>}
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-spacer">
								<label for="review_title">{__('Review title (optional)', 'wca-woocommerce')}:</label>
								<input className="form-control" type="text" id="review_title" placeholder={__('Use a suggestion or write your own title', 'wca-woocommerce')} {...register('title')} />
							</div>
							<div className="mb-spacer">
								<SuggestTitle rating={rating} setTitle={setTitle} />
							</div>
						</div>
						<div className="woocommerce-Reviews__respond-field">
							<div className="mb-spacer">
								<label for="review">{__('Review', 'wca-woocommerce')}:</label>
								<textarea className="form-control" id="review" rows="7" required="" placeholder={__('Describe your experience with the product', 'wca-woocommerce')}
									{...register('review', {
										required: __('This cannot be empty!', 'wca-woocommerce'),
										minLength: 20
									})}
								/>
								{errors.review && <em class="invalid-feedback" style={{ display: 'block' }}>{
									errors.review.type === 'minLength' ? __('Please be more descriptive.', 'wca-woocommerce') : errors.review.message
								}</em>}
							</div>
						</div>
						{doAction('wecodeart.woocommerce.reviews.newReview.bottom', register, errors, options)}
						{terms && <div className="woocommerce-Reviews__respond-field woocommerce-Reviews__respond-field--terms">
							<div className="mb-spacer">
								<p className="has-small-font-size has-cyan-bluish-gray-color" dangerouslySetInnerHTML={{ __html: terms }} />
							</div>
						</div>}
						<div className="woocommerce-Reviews__respond-field">
							<button type="submit" className="wp-element-button has-primary-background-color" {...{ disabled: loading === true }}>{
								__('Add Review', 'wca-woocommerce')
							}</button>
							<span> &nbsp; </span>
							<a href="javascript:void(0);" onClick={() => setRating(false)} className="wp-element-link">{
								__('Cancel', 'wca-woocommerce')
							}</a>
							{message && <div className="has-accent-background-color" style={{ padding: '1rem', marginTop: '1rem', borderRadius: '.25rem' }}>{message}</div>}
						</div>
					</form >
				</div>
			</div>
		</div>
	);
};