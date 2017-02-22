<?php
/**
 * This file is part of the Subway WordPress Plugin Package.
 *
 * (c) Joseph Gabito <joseph@useissuestabinstead.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Subway
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

$args = array(
	'echo'           => true,
	'form_id'        => 'loginform',
	'label_username' => __( 'Username', 'subway' ),
	'label_password' => __( 'Password', 'subway' ),
	'label_remember' => __( 'Remember Me', 'subway' ),
	'label_log_in'   => __( 'Log In', 'subway' ),
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'remember'       => true,
	'value_username' => '',
	'value_remember' => false,
	'redirect' 		 => home_url(),
);

$error_login_message = '';

$message_types = array();

if ( isset( $_GET['login'] ) ) {

	if ( 'failed' === $_GET['login'] ) {

		if ( isset( $_GET['type'] ) ) {

			$message_types = array(

				'default' => array(
						'message' => __( 'There was an error trying to sign-in to your account. Make sure the credentials below are correct.', 'subway' ),
					),
				'__blank' => array(
						'message' => __( 'Required: Username and Password cannot be empty.', 'subway' ),
					),
				'__userempty' => array(
						'message' => __( 'Required: Username cannot be empty.', 'subway' ),
					),
				'__passempty' => array(
						'message' => __( 'Required: Password cannot be empty.', 'subway' ),
					),
				'fb_invalid_email' => array(
						'message' => __( 'Facebook email address is invalid or is not yet verified.', 'subway' ),
					),
				'fb_error' => array(
						'message' => __( 'Facebook Application Error. Misconfigured or App is rejected.', 'subway' ),
					),
				'app_not_live' => array(
						'message' => __( 'Unable to fetch your Facebook Profile.', 'subway' ),
					),
				'gears_username_or_email_exists' => array(
						'message' => __( 'Username or email address already exists', 'subway' ),
					),
				'gp_error_authentication' => array(
						'message' => __( 'Google Plus Authentication Error. Invalid Client ID or Secret.', 'subway' ),
					),
			);

			$message = $message_types['default']['message'];

			if ( array_key_exists( $_GET['type'], $message_types ) ) {

				$message = $message_types[ $_GET['type'] ]['message'];

			}

			$error_login_message = '<div id="message" class="error">'. esc_html( $message ) .'</div>';

		} else {

			$error_login_message = '<div id="message" class="error">'. esc_html__ ( 'Error: Invalid username and password combination.', 'subway' ).'</div>';

		}
	}
}

if ( isset( $_GET['_redirected'] ) ) {
	$error_login_message = '<div id="message" class="success">' . esc_html__( 'We are glad to have you back. Please use the login form below to access the page.', 'subway' ) . '</div>';
}

?>
<?php if ( ! is_user_logged_in() ) { ?>
	<div class="mg-top-35 mg-bottom-35 subway-login-form">
		<div class="subway-login-form-form">
			<div class="subway-login-form__actions">
				<h3>
					<?php _e( 'Account Sign-in', 'subway' ); ?>
				</h3>
				<?php do_action( 'gears_login_form' ); ?>
			</div>
			<div class="subway-login-form-message">
				<?php echo $error_login_message; ?>
			</div>
			<div class="subway-login-form__form">
				<?php echo wp_login_form( $args ); ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="mg-top-35 mg-bottom-35 subway-login-sucessfull" style="background: #CDDC39; padding: 15px 15px 15px 15px;border-radius: 4px;color: #616161;">
		<p style="margin-bottom: 0px;">
			<?php echo esc_html__( apply_filters( 'subway_login_message', 'Great! You have succesfully login.' ), 'subway' ); ?>
		</p>
	</div>
<?php } ?>
