<?php
/**
 * Basic nonces signatures.
 *
 * @package    madaritech-wp-nonce
 */

namespace madaritech\nonces;

/**
 * The interface for the nonces basic functionality signatures.
 */
interface Nonce_Interface {

	/**
	 * Get signature for action property.
	 *
	 * @since 1.0.0
	 *
	 * @return string $action Action value.
	 */
	public function get_action();

	/**
	 * Set signature for action property.
	 *
	 * @since 1.0.0
	 *
	 * @param string $param_action Action value.
	 * @return string $action      Action value set.
	 */
	public function set_action( $param_action );

	/**
	 * Get signature for name property.
	 *
	 * @since 1.0.0
	 *
	 * @return string $name The nonce name value.
	 */
	public function get_name();

	/**
	 * Set signature for name property.
	 *
	 * @since 1.0.0
	 *
	 * @param string $param_name Name for the nonce value to set.
	 * @return string $name      The nonce name value set.
	 */
	public function set_name( $param_name );

	/**
	 * Get signature for nonce property.
	 *
	 * @since 1.0.0
	 *
	 * @return string $nonce Nonce value.
	 */
	public function get_nonce();

	/**
	 * Set signature for nonce property.
	 *
	 * @since 1.0.0
	 *
	 * @param string $param_nonce Nonce value to set.
	 * @return string $nonce      Nonce value set.
	 */
	public function set_nonce( $param_nonce );
}
