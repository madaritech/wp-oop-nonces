<?php
/**
 * Nonce field generator file.
 *
 * @package    madaritech/wp-oop-nonces
 */

namespace madaritech\nonces;

/**
 * The class for the form nonce field generation.
 */
final class Nonce_Field_Generator extends Nonce_Generator {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param    string $param_action Action name.
	 * @param    string $param_name   Optional. Nonce name. Default '_wpnonce'.
	 */
	public function __construct( $param_action, $param_name = '_wpnonce' ) {
		parent::__construct( $param_action, $param_name );
	}

	/**
	 * Generate the form field/s with nonce value.
	 *
	 * @since 1.0.0
	 *
	 * @param    string $param_referer      Optional. Whether to set the referer field for validation. Default true.
	 * @param    string $param_echo         Optional. Whether to display or return hidden form field. Default true.
	 * @return   string $fields             The nonce hidden form field, optionally followed by the referer hidden form *                                      field if the $referer argument is set to true.
	 */
	public function generate_nonce_field( $param_referer = true, $param_echo = true ) {

		$this->generate_nonce();

		$name   = $this->get_name();
		$nonce  = $this->get_nonce();

		$name = esc_attr( $name );

		$nonce_field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="' . $nonce . '" />';

		if ( $param_referer ) {
			$nonce_field .= wp_referer_field( false );
		}

		if ( $param_echo ) {
			echo $nonce_field;
		}

		return $nonce_field;
	}
}
