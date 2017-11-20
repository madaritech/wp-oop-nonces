<?php
/**
 * Nonce generator file.
 *
 * @package    madaritech-wp-nonce
 */

namespace madaritech\nonces;

/**
 * The class for nonce generator.
 */
class Nonce_Generator extends Nonce_Abstract {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param    string $param_action     The nonce action value.
	 * @param    string $param_name       Optional. The nonce request name. Default = '_wpnonce'.
	 */
	public function __construct( $param_action, $param_name = '_wpnonce' ) {
		$this->set_action( $param_action );
		$this->set_name( $param_name );
	}

	/**
	 * Nonce generation.
	 *
	 * @since 1.0.0
	 *
	 * @return int The generated nonce value.
	 */
	public function generate_nonce() {
		$this->set_nonce( wp_create_nonce( $this->get_action() ) );
		return $this->get_nonce();
	}

}
