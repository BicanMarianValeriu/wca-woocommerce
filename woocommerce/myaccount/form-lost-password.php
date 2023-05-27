<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
	'col-md-10',
	'col-lg-6',
	'mx-auto',
	'mb-3',
] );

do_action( 'woocommerce_before_lost_password_form' );

?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password needs-validation col-md-10 col-lg-6 mx-auto">
	<p class="has-text-align-center"><?php

		echo apply_filters(
			'woocommerce_lost_password_message',
			esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' )
		);
			
	?></p>
	<?php
	
	wecodeart_input( 'floating', [
		'type'	=> 'text',
		'label' => esc_html__( 'Username or email', 'woocommerce' ),
		'attrs' => [
			'id'			=> 'user_login',
			'name'			=> 'user_login',
			'class'			=> 'form-control mb-3',
			'autocomplete'	=> 'username',
			'placeholder'	=> esc_html__( 'Username or email', 'woocommerce' ),
			'required'		=> 'required'
		]
	] );

	?>
	<?php do_action( 'woocommerce_lostpassword_form' ); ?>
	<div class="wp-block-button">
		<?php

		$classes = [ 'wp-block-button__link', 'has-primary-background-color', 'woocommerce-Button' ];
		$classes[] = wc_wp_theme_get_element_class_name( 'button' );

		wecodeart_input( 'button', [
			'type'	=> 'submit',
			'label' => esc_html__( 'Reset password', 'woocommerce' ),
			'attrs' => [
				'class'	=> join( ' ', array_filter( $classes ) ),
				'value'	=> esc_html__( 'Reset password', 'woocommerce' )
			]
		] );

		?>
		<input type="hidden" name="wc_reset_password" value="true" />
		<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
	</div>
</form>
<?php

do_action( 'woocommerce_after_lost_password_form' );
