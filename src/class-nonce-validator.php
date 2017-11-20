<?php
/**
 * Nonce validator file.
 *
 * @package    madaritech-wp-nonce
 */

namespace madaritech\nonces;

/**
 * The class for the nonce validation.
 */
final class Nonce_Validator extends Nonce_Abstract {

	/**
	 * Validate the nonce.
	 *
	 * @since 1.0.0
	 *
	 * @return    boolean $is_valid False if the nonce is invalid. Otherwise, returns true.
	 */
	private function validate() {

		$is_valid = wp_verify_nonce( $this->get_nonce(), $this->get_action() );

		if ( false === $is_valid ) {
			return $is_valid;
		} else {
			return true;
		}
	}

	/**
	 * Validate the nonce from the request.
	 *
	 * @since 1.0.0
	 *
	 * @param     string $param_action     Action name.
	 * @param     string $param_name       Optional. The nonce request name. Default = '_wpnonce'.
	 * @return    boolean $is_valid        Boolean false if the nonce is invalid. Otherwise, returns true.
	 */
	public function validate_request( $param_action, $param_name = '_wpnonce' ) {

		$is_valid = false;

		$this->set_action( $param_action );
		$this->set_name( $param_name );

		if ( isset( $_REQUEST[ $this->name() ] ) ) {

			$nonce_received = sanitize_text_field( wp_unslash( $_REQUEST[ $this->name() ] ) );

			$this->set_nonce( $nonce_received );

			$is_valid = $this->validate();

		}

		return $is_valid;
	}

	/**
	 * Validate the nonce directly.
	 *
	 * @since 1.0.0
	 *
	 * @param string $param_nonce  Nonce value.
	 * @param string $param_action Action name.
	 * @return    boolean $is_valid Boolean false if the nonce is invalid. Otherwise, returns true.
	 */
	private function validate_nonce( $param_nonce, $param_action ) {

		$is_valid = false;

		$this->set_action( $param_action );
		$this->set_nonce( $param_nonce );

		$is_valid = $this->validate();

		return $is_valid;
	}

}
