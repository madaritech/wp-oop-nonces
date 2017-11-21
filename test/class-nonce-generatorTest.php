<?php

namespace madaritech\nonces\test;

/*require_once dirname(__DIR__) . "/src/nonce-interface.php";
require_once dirname(__DIR__) . "/src/nonce-abstract.php";
require_once dirname(__DIR__) . "/src/class-nonce-generator.php";
require_once dirname(__DIR__) . "/test/mock-functions.php";*/

use madaritech\nonces\Nonce_Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests for class Nonce_Generator.
 */
class Nonce_GeneratorTest extends TestCase
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
	* @var    object $test_ng The default test generator object.
 	*/
	private $test_ng;

	/**
 	* Setting up the test environment.
 	*/
	protected function setUp() {

 		$this->test_action = 'my_action';
 		$this->test_name = 'my_name';

 		$this->test_ng = new Nonce_Generator( $this->test_action );
 		
 		// Building nonce value.
 		$this->test_nonce = \madaritech\nonces\wp_create_nonce( $this->test_action );
 	}

	/**
 	* Test the object instance.
 	*/
	public function test_instance() {

		$this->assertInstanceOf( Nonce_Generator::class, new Nonce_Generator( $this->test_action, $this->test_name ) );
		$this->assertInstanceOf( Nonce_Generator::class, $this->test_ng );
	}

	/**
 	* Test the getter and setter for the action property.
 	*/
	public function test_get_set_action() {

 		$ng = new Nonce_Generator( $this->test_action, $this->test_name );

 		// Check the getter.
 		$this->assertSame( $this->test_action, $ng->get_action() );

 		// Check the setter.
 		$action = $ng->set_action( 'new_action' );
		$this->assertSame( $ng->get_action(), $action );
 	}

 	/**
 	* Test the getter and setter for the name property.
 	*/
 	public function test_get_set_name() {

 		$ng = new Nonce_Generator($this->test_action, $this->test_name);

 		// Check the getter.
 		$this->assertSame( $this->test_name, $ng->get_name() );

 		// Check the setter.
 		$name = $ng->set_name( 'new_name' );
		$this->assertSame( $ng->get_name(), $name );
 	}

 	/**
 	* Test the getter and setter for the name property when default value in the constructor is used.
 	*/
 	public function test_default_name() {

 		$ng = new Nonce_Generator( 'another_action' );
 		
 		// Check the action property getter.
 		$this->assertSame( 'another_action', $ng->get_action() );
 		
 		// Check the name property getter: the name value now is the default one.
 		$this->assertSame( '_wpnonce', $ng->get_name() );
 	}


 	/**
 	* Test the generate_nonce method used for the straight generation of the nonce.
 	*/
 	public function test_generate_nonce() {

		$ng = new Nonce_Generator($this->test_action);

		// The constructor sets nonce property to null. Checking null value.
		$this->assertNull( $ng->get_nonce() );

		// Generating the nonce.
		$nonce_generated = $ng->generate_nonce();

		// Check the nonce.
		$this->assertSame( $nonce_generated, $this->test_nonce );
 	}

 	/**
 	* Test the getter and setter for the nonce property.
 	*/
 	public function test_get_set_nonce() {
		
		// Generating the nonce.
 		$nonce_generated = $this->test_ng->generate_nonce();
 		
 		// Setting new value for the nonce.
 		$this->test_ng->set_nonce( 'new_nonce' );

 		// Getting and cheking the nonce value.
 		$this->assertNotEquals( $nonce_generated, $this->test_ng->get_nonce() );
 		$this->assertSame( 'new_nonce', $this->test_ng->get_nonce() );
 	}
}