<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wecodeart( 'styles' )->Utilities->load( [
	'align-self-center',
	'text-uppercase',
	'opacity-50',
	'rounded',
	'fw-700',
	'mb-3',
	'mb-0',
	'mt-0',
	'p-3',
	'p-md-5',
	'span-6',
	'span-md-3',
	'span-lg-2',
	'span-lg-4'
] );

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="grid" id="customer_login" style="--wp--columns: 6;--wp--style--block-gap: 2rem;">

	<div class="span-6 span-md-3 span-lg-2">

<?php endif; ?>

		<div class="has-success-background-color p-3 p-md-5 rounded">
			<span class="has-small-font-size has-white-color text-uppercase opacity-50"><?php esc_html_e( 'Already a member?', 'woocommerce' ); ?></span>
			<h2 class="has-white-color fw-700 mt-0"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

			<?php

			woocommerce_login_form( [
				'redirect' => false,
				'hidden'   => false,
			] );

			?>
		</div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="span-6 span-md-3 span-lg-4 align-self-center">
		<span class="has-small-font-size has-primary-color text-uppercase"><?php esc_html_e( 'New User?', 'woocommerce' ); ?></span>

		<h3 class="fw-700 mt-0"><?php esc_html_e( 'Don`t have an account? Register Now!', 'woocommerce' ); ?></h3>
		
		<form method="post" class="woocommerce-form woocommerce-form-register register needs-validation" <?php do_action( 'woocommerce_register_form_tag' ); ?> novalidate>
			
			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
			<div class="woocommerce-form-row woocommerce-form-row--wide mb-3"><?php

				wecodeart_input( 'floating', [
					'type'	=> 'text',
					'label' => esc_html__( 'Username', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
					'attrs' => [
						'id'			=> 'reg_username',
						'name'			=> 'username',
						'autocomplete'	=> 'username',
						'value'			=> ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : '',
						'placeholder'	=> ' ',
						'required'		=> 'required'
					]
				] );
				
			?></div>
			<?php endif; ?>
			
			<div class="woocommerce-form-row woocommerce-form-row--wide mb-3"><?php
			
				wecodeart_input( 'floating', [
					'type'	=> 'text',
					'label' => esc_html__( 'Email address', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
					'attrs' => [
						'id'			=> 'reg_email',
						'name'			=> 'email',
						'autocomplete'	=> 'email',
						'value'			=> ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : '',
						'placeholder'	=> ' ',
						'required'		=> 'required'
					]
				] );
				
			?></div>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
			<div class="woocommerce-form-row woocommerce-form-row--wide mb-3"><?php
			
				wecodeart_input( 'floating', [
					'type'	=> 'text',
					'label' => esc_html__( 'Password', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
					'attrs' => [
						'id'			=> 'reg_password',
						'name'			=> 'password',
						'autocomplete'	=> 'new-password',
						'placeholder'	=> ' ',
						'required'		=> 'required'
					]
				] );
				
			?></div>
			<?php else : ?>
			<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>
			<?php endif; ?>
			
			<div class="has-text-align-right wp-block-button"><?php
			
				wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' );

				$classes = [ 'woocommerce-form-register__submit', 'wp-block-button__link', 'has-primary-background-color' ];
				$classes[] = wc_wp_theme_get_element_class_name( 'button' );
			
				wecodeart_input( 'button', [
					'type'	=> 'submit',
					'label' => esc_html__( 'Register', 'woocommerce' ),
					'attrs' => [
						'name'	=> 'register',
						'value'	=> esc_attr__( 'Register', 'woocommerce' ),
						'class'	=> join( ' ', array_filter( $classes ) )
					]
				] );
			
			?></div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
