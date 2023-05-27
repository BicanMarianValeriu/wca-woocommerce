<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

wecodeart( 'styles' )->Utilities->load( [
	'mb-3',
] );

?>
<form class="woocommerce-form woocommerce-form-login login needs-validation" method="post"<?php echo ( $hidden ) ? ' style="display:none;"' : ''; ?> novalidate>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

	<div class="mb-3"><?php
	
		wecodeart_input( 'floating', [
			'type'	=> 'text',
			'label' => esc_html__( 'Username or email', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
			'attrs' => [
				'id'			=> 'username',
				'name'			=> 'username',
				'autocomplete'	=> 'username',
				'placeholder'	=> ' ',
				'required'		=> true
			]
		] );
		
	?></div>
	<div class="mb-3"><?php
	
		wecodeart_input( 'floating', [
			'type'	=> 'password',
			'label' => esc_html__( 'Password', 'woocommerce' ) . '&nbsp;<span class="required">*</span>',
			'attrs' => [
				'id'			=> 'password',
				'name'			=> 'password',
				'autocomplete'	=> 'current-password',
				'placeholder'	=> ' ',
				'required'		=> true
			]
		] );
	
	?></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="mb-3 grid" style="--wp--columns: 2;">
		<div class="has-text-align-left"><?php

			wecodeart_input( 'toggle', [
				'type'	=> 'checkbox',
				'label' => esc_html__( 'Remember me', 'woocommerce' ),
				'attrs' => [
					'class'		=> 'form-switch',
					'id' 		=> 'rememberme',
					'name' 		=> 'rememberme',
					'value'		=> 'forever',
				]
			] );

		?></div>
		<div class="has-text-align-right">
			<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
		</div>
	</div>

	<div class="wp-block-button"><?php

		$classes = [ 'woocommerce-form-login__submit', 'wp-block-button__link', 'has-success-background-color' ];
		$classes[] = wc_wp_theme_get_element_class_name( 'button' );

		wecodeart_input( 'button', [
			'type'	=> 'submit',
			'label' => esc_html__( 'Login', 'woocommerce' ),
			'attrs' => [
				'name'	=> 'login',
				'value'	=> esc_attr__( 'Login', 'woocommerce' ),
				'class'	=> join( ' ', array_filter( $classes ) )
			]
		] );
		
		?>
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<?php if( ! empty( $redirect ) ) : ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
		<?php endif; ?>
	</div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
