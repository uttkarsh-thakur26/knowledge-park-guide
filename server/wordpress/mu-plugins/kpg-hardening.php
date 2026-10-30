<?php
/**
 * Plugin Name: KPG – Hardening
 * Description: Hides account details from visitors and turns off features the site doesn't use.
 */

// Visitors can't list user accounts through the REST API; logged-in editors still can.
add_filter( 'rest_endpoints', function ( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
} );

// "?author=1" style requests would reveal the author slug, so they get a 404 instead of a redirect.
add_action( 'template_redirect', function () {
	if ( isset( $_GET['author'] ) && ! is_user_logged_in() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}, 1 );

// Don't advertise the WordPress version.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Features not used here: application passwords and XML-RPC (Nginx also blocks xmlrpc.php).
add_filter( 'wp_is_application_passwords_available', '__return_false' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// A failed login doesn't say whether the username or the password was wrong.
add_filter( 'login_errors', function () {
	return 'The username or password is incorrect.';
} );
