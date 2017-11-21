<?php

namespace madaritech\nonces;

/**
* Mock version of wp_create_nonce() function.
*/
function wp_create_nonce( $action ) {
	return substr( md5( $action ), -12, 10 );
}

/**
* Mock version of esc_html() function.
*/
function esc_html( $text ) {
	return $text;
}

/**
* Mock version of add_query_arg() function.
*/
function add_query_arg( $name, $nonce, $actionurl ) {
	return $actionurl . '?'. $name . '='. $nonce;
}

/**
* Mock version of wp_referer_field() function.
*/
function wp_referer_field( $b ) {
	return '<input type="hidden" name="_wp_http_referer" value="my-url" />';
}

/**
* Mock version of esc_attr() function.
*/
function esc_attr( $text ) {
	return $text;
}

/**
* Mock version of wp_verify_nonce() function.
*/
function wp_verify_nonce( $nonce, $action = -1) {
	
	$nonce_calc = substr( md5( $action ), -12, 10 );

	if ( $nonce == $nonce_calc ) {
		return true;
	} else {
		return false;
	}
}

/**
* Mock version of wp_unslash() function.
*/
function wp_unslash( $text ) {
	return $text;
}

/**
* Mock version of sanitize_text_field() function.
*/
function sanitize_text_field( $text ) {
	return $text;
}