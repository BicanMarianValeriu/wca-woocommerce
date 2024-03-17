<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

wecodeart( 'styles' )->Utilities->load( [
	'border',
	'fw-700',
	'my-0',
	'mx-0',
	'span-2',
	'span-md-1'
] );

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account card needs-validation" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> novalidate="">
	<div class="card-header">
		<h6 class="fw-700 my-0"><?php esc_html_e( 'Your details', 'woocommerce' ); ?></h6>
		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	</div>
	<div class="card-body grid" style="--wp--columns:2;">
		<div class="span-2 span-md-1">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'text',
				'label' => esc_html__( 'First name', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'account_first_name',
					'name'			=> 'account_first_name',
					'autocomplete'	=> 'given-name',
					'value'			=> $user->first_name,
					'placeholder'	=> ' ',
					'required'		=> 'required'
				]
			] ); ?>
		</div>
		<div class="span-2 span-md-1">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'text',
				'label' => esc_html__( 'Last name', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'account_last_name',
					'name'			=> 'account_last_name',
					'autocomplete'	=> 'family-name',
					'value'			=> $user->last_name,
					'placeholder'	=> ' ',
					'required'		=> 'required'
				]
			] ); ?>
		</div>
		<div class="span-2">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'text',
				'label' => esc_html__( 'Display name', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'account_display_name',
					'name'			=> 'account_display_name',
					'autocomplete'	=> 'family-name',
					'value'			=> $user->display_name,
					'placeholder'	=> ' ',
					'required'		=> 'required'
				]
			] ); ?>
		</div>
		<div class="span-2">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'email',
				'label' => esc_html__( 'Email address', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
				'attrs' => [
					'id'			=> 'account_email',
					'name'			=> 'account_email',
					'autocomplete'	=> 'email',
					'value'			=> $user->user_email,
					'placeholder'	=> ' ',
					'required'		=> 'required'
				]
			] ); ?>
		</div>
		<fieldset class="span-2 grid border mx-0" style="--wp--columns:2;">
			<legend class="span-2 has-normal-font-size fw-700 mb-0"><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>
			<div class="span-2">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'password',
				'label' => esc_html__( 'Current password (leave blank to leave unchanged)', 'woocommerce' ),
				'attrs' => [
					'id'			=> 'password_current',
					'name'			=> 'password_current',
					'autocomplete'	=> 'off',
					'placeholder'	=> ' ',
				]
			] ); ?>
			</div>
			<div class="span-2 span-md-1">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'password',
				'label' => esc_html__( 'New password (leave blank to leave unchanged)', 'woocommerce' ),
				'attrs' => [
					'id'			=> 'password_1',
					'name'			=> 'password_1',
					'autocomplete'	=> 'off',
					'placeholder'	=> ' ',
				]
			] ); ?>
			</div>
			<div class="span-2 span-md-1">
			<?php wecodeart_input( 'floating', [
				'type'	=> 'password',
				'label' => esc_html__( 'Confirm new password', 'woocommerce' ),
				'attrs' => [
					'id'			=> 'password_2',
					'name'			=> 'password_2',
					'autocomplete'	=> 'off',
					'placeholder'	=> ' ',
				]
			] ); ?>
			</div>
		</fieldset>
		<?php do_action( 'woocommerce_edit_account_form' ); ?>
	</div>
	<div class="card-footer">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<div class="wp-block-button">
			<?php			
			
			$classes = [ 'wp-block-button__link', 'has-primary-background-color' ];
			$classes[] = wc_wp_theme_get_element_class_name( 'button' );

			wecodeart_input( 'button', [
				'type'	=> 'submit',
				'label' => esc_html__( 'Save changes', 'woocommerce' ),
				'attrs' => [
					'name'	=> 'save_account_details',
					'value'	=> esc_attr__( 'Save changes', 'woocommerce' ),
					'class'	=> join( ' ', array_filter( $classes ) )
				]
			] );
					
			?>
		</div>
		<input type="hidden" name="action" value="save_account_details" />
		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	</div>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
