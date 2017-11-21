<?php

namespace madaritech\nonces;

/**
* Mock version of wp_create_nonce() function.
*
* @param string $action The nonce action value.
* @return string $nonce The nonce. 
*/
function wp_create_nonce( $action ) {
	return substr( md5( $action ), -12, 10 );
}

/**
* Mock version of esc_html() function.
*
* @param string $text Text value.
* @return string $text The text value in input.
*/
function esc_html( $text ) {
	return $text;
}

/**
* Mock version of add_query_arg() function.
*
* @param string $name Name of the nonce.
* @param string $nonce Nonce value.
* @param string $actionurl Url to update with the nonce.
* @return string $url The new url with the nonce as query arg.
*/
function add_query_arg( $name, $nonce, $actionurl ) {
	return $actionurl . '?'. $name . '='. $nonce;
}

/**
* Mock version of wp_referer_field() function.
*
* @param boolean $b Boolean value set to false.
* @return string $field The referer form field.
*/
function wp_referer_field( $b ) {
	return '<input type="hidden" name="_wp_http_referer" value="my-url" />';
}

/**
* Mock version of esc_attr() function.
*
* @param string $text Text value.
* @return string $text The text value in input.
*/
function esc_attr( $text ) {
	return $text;
}

/**
* Mock version of wp_verify_nonce() function.
*
* @param string $nonce Nonce value.
* @param string $action Optional. Action value. Default value -1.
* @return boolean $is_valid true if the nonces is valid, false otherwise.
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
*
* @param string $text Text value.
* @return string $text The text value in input.
*/
function wp_unslash( $text ) {
	return $text;
}

/**
* Mock version of sanitize_text_field() function.
*
* @param string $text Text value.
* @return string $text The text value in input.
*/
function sanitize_text_field( $text ) {
	return $text;
}