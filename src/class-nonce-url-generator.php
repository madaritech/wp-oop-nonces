<?php
/**
 * Nonce url generator file.
 *
 * @package    madaritech-wp-nonce
 */

namespace madaritech\nonces;

/**
 * The class for the url generation with nonce.
 */
final class Nonce_Url_Generator extends Nonce_Generator {

	/**
	 * Class constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param    string $param_action     The nonce action value.
	 * @param    string $param_name       Optional. The nonce request name. Default = '_wpnonce'.
	 */
	public function __construct( $param_action, $param_name = '_wpnonce' ) {
		parent::__construct( $param_action, $param_name );
	}

	/**
	 * Generate the url with nonce value.
	 *
	 * @since 1.0.0
	 *
	 * @param  string $param_actionurl URL value to set.
	 * @return string $url             URL with nonce action added.
	 */
	public function generate_nonce_url( $param_actionurl ) {

		$this->generate_nonce();

		$name   = $this->get_name();
		$nonce  = $this->get_nonce();

		$actionurl = str_replace( '&amp;', '&', $param_actionurl );
		$url = esc_html( add_query_arg( $name, $nonce, $actionurl ) );

		return $url;
	}
}
