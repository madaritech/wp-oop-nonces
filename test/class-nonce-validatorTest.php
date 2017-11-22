<?php 

namespace madaritech\nonces\test;

use madaritech\nonces\Nonce_Validator;
use PHPUnit\Framework\TestCase;

/**
 * Tests for class Nonce_Validator.
 */
class Nonce_ValidatorTest extends TestCase
{
	/**
	* Test action.
	*
	* @var    string $test_action The default test action value.
 	*/
	private $test_action;
	
	/**
	* Test nonce.
	*
	* @var    string $test_action The default test nonce value.
 	*/
	private $test_nonce;

	/**
	* Test validator.
	*
	* @var    object $test_validator The default test validator object.
 	*/
	private $test_validator;

	/**
 	* Setting up the test environment.
 	*/
	protected function setUp() {

 		$this->test_action = 'my_action';
 		$this->test_name = 'my_name';

 		$this->test_validator = new Nonce_Validator( $this->test_action );
 		
 		// Building nonce value.
 		$this->test_nonce = \madaritech\nonces\wp_create_nonce( $this->test_action );
 	}
	
	/**
 	* Test the object instance.
 	*/
    public function test_instance() {

		$this->assertInstanceOf( Nonce_Validator::class, new Nonce_Validator( $this->test_action, $this->test_name ) );
		$this->assertInstanceOf( Nonce_Validator::class, new Nonce_Validator( $this->test_action ) );
	}

	/**
 	* Test the getter and setter for the action property.
 	*/
	public function test_get_set_action() {

 		$nv = new Nonce_Validator( $this->test_action, $this->test_name );

 		// Check the getter.
 		$this->assertSame( $this->test_action, $nv->get_action() );

		// Check the setter.
 		$action = $nv->set_action( 'new_action' );
		$this->assertSame( $action, $nv->get_action() );
 	}

	/**
 	* Test the getter and setter for the name property.
 	*/
 	public function test_get_set_name() {

 		$nv = new Nonce_Validator($this->test_action, $this->test_name);

 		// Check the getter.
 		$this->assertSame( $this->test_name, $nv->get_name() );

		// Check the setter.
 		$name = $nv->set_name( 'new_name' );
		$this->assertSame( $name, $nv->get_name() );
 	}

 	/**
 	* Test the getter and setter for the name property when default value in the constructor is used.
 	*/
 	public function test_default_name() {

 		$nv = new Nonce_Validator( 'another_action' );
 		
 		// Check the action property getter.
 		$this->assertSame( 'another_action', $nv->get_action() );

 		// Check the name property getter: the name value now is the default one.
 		$this->assertSame( '_wpnonce', $nv->get_name() );
 	}

 	/**
 	* Test the validate_nonce method used for the straight validation of the nonce.
 	*/
 	public function test_validate_nonce() {

 		// Check validating method.
 		$is_valid = $this->test_validator->validate_nonce( $this->test_nonce );
 		$this->assertTrue( $is_valid );

		// Injecting wrong value in the nonce.
 		$is_valid = $this->test_validator->validate_nonce( $this->test_nonce . 'failure' );
 		
 		// Check failure on validating.
 		$this->assertFalse( $is_valid );
 	}

 	/**
 	* Test the validate_nonce method used for the validation of the nonce through the $_REQUEST.
 	*/
 	public function test_validate_request() {

 		$test_name = '_wpnonce';

 		// Build the $_REQUEST
 		$_REQUEST[ '_wpnonce' ] = $this->test_nonce;

 		// Checking validation method.
 		$is_valid = $this->test_validator->validate_request();
 		$this->assertTrue( $is_valid );

		// Injecting wrong value in the nonce.
		$_REQUEST[ '_wpnonce' ] = $this->test_nonce . 'failure';

		// Check failure on validating.
 		$is_valid = $this->test_validator->validate_request();
 		$this->assertFalse( $is_valid );
 	}
}