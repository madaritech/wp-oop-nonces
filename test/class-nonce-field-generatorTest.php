<?php 

namespace madaritech\nonces\test;

use madaritech\nonces\Nonce_Field_Generator;
use PHPUnit\Framework\TestCase;

/**
 * Tests for class Nonce_Field_Generator.
 */
class Nonce_Field_GeneratorTest extends TestCase
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
	* @var    object $test_nfg The default test generator object.
 	*/
	private $test_nfg;

	/**
 	* Setting up the test environment.
 	*/
	protected function setUp() {

 		$this->test_action = 'my_action';
 		$this->test_name = 'my_name';

 		$this->test_nfg = new Nonce_Field_Generator( $this->test_action );
 		
 		// Building nonce value.
 		$this->test_nonce = \madaritech\nonces\wp_create_nonce( $this->test_action );
 	}

	/**
 	* Test the object instance.
 	*/
    public function test_instance() {

		$this->assertInstanceOf( Nonce_Field_Generator::class, new Nonce_Field_Generator( $this->test_action, $this->test_name ) );
		$this->assertInstanceOf( Nonce_Field_Generator::class, $this->test_nfg );
	}

	/**
 	* Test the getter and setter for the action property.
 	*/
	public function test_get_set_action() {

 		$nfg = new Nonce_Field_Generator( $this->test_action, $this->test_name );

 		// Check the getter.
 		$this->assertSame( $this->test_action, $nfg->get_action() );

 		// Check the setter.
 		$action = $nfg->set_action( 'new_action' );
		$this->assertSame( $nfg->get_action(), $action );
 	}

	/**
 	* Test the getter and setter for the name property.
 	*/
 	public function test_get_set_name() {

 		$nfg = new Nonce_Field_Generator($this->test_action, $this->test_name);

 		// Check the getter.
 		$this->assertSame( $this->test_name, $nfg->get_name() );

		// Check the setter.
 		$name = $nfg->set_name( 'new_name' );
		$this->assertSame( $nfg->get_name(), $name );
 	}

 	/**
 	* Test the getter and setter for the name property when default value in the constructor is used.
 	*/
 	public function test_default_name() {

 		$nfg = new Nonce_Field_Generator( 'another_action' );
 		
 		// Check the action property getter.
 		$this->assertSame( 'another_action', $nfg->get_action() );

 		// Check the name property getter: the name value now is the default one.
 		$this->assertSame( '_wpnonce', $nfg->get_name() );
 	}

 	/**
 	* Test the generate_nonce method used for the straight generation of the nonce.
 	*/
 	public function test_generate_nonce() {

		// Generating the nonce.
		$nonce_generated = $this->test_nfg->generate_nonce();

		// Check the nonce.
		$this->assertSame( $nonce_generated, $this->test_nonce );
 	}

    /**
 	* Test the getter and setter for the nonce property.
 	*/
 	public function test_get_set_nonce() {

 		$nfg = new Nonce_Field_Generator( $this->test_action );

 		// Getting nonce property: default null.
 		$this->assertNull( $nfg->get_nonce() );

		// Generating the nonce.
 		$nonce_generated = $nfg->generate_nonce();

 		// Overwrite the value generated and setting a new value for the nonce property.
 		$nfg->set_nonce( 'new_nonce' );

		// Checking failure.
 		$this->assertNotEquals( $nonce_generated, $nfg->get_nonce() );

 		// Checking actual nonce value.
 		$this->assertSame( 'new_nonce', $nfg->get_nonce() );
 	}

    /**
 	* Test the generate_nonce_field method to build form field with a nonce parameter to send on via POST. Here the 
 	* parameter refer and echo are called with values:
	*
	*	referer: false ---> hidden field with refer url value is not added.
	*	echo: false ------> the field is not printed.
 	*/
	public function test_generate_nonce_field(){
		
		$nfg = new Nonce_Field_Generator( $this->test_action );

		// Generating the form field.
		$field_generated = $nfg->generate_nonce_field( false, false );

		// Building the expected form field.
		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" />';

		// Checking result.
		$this->assertSame( $field_generated, $field_expected);
 	}

    /**
 	* Test the generate_nonce_field method to build form field with a nonce parameter to send on via POST. Here the 
 	* parameter refer and echo are called with values:
	*
	*	referer: true ---> hidden field with refer url value is added.
	*	echo: false ------> the fields are not printed.
 	*/
 	public function test_generate_nonce_field_referer(){
		
		$nfg = new Nonce_Field_Generator( $this->test_action );

		// Generating the form fields.
		$field_generated = $nfg->generate_nonce_field( true, false );

		// Building the expected form fields.
		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';

		// Checking result.
		$this->assertSame( $field_generated, $field_expected);
 	}

    /**
 	* Test the generate_nonce_field method to build form field with a nonce parameter to send on via POST. Here the 
 	* parameter refer and echo are called with values:
	*
	*	referer: false ---> hidden field with refer url value is not added.
	*	echo: true ------> the field is printed.
 	*/
 	public function test_generate_nonce_field_echo(){
		
		$nfg = new Nonce_Field_Generator( $this->test_action );

		// Building the expected form field.
		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" />';

		// Check that the result is printed.
 		$this->expectOutputString($field_expected);

 		// Generating the form fields. The second parameter defaults to true.
		$field_generated = $nfg->generate_nonce_field( false );

		// Checking result.
		$this->assertSame( $field_generated, $field_expected);
 	}

    /**
 	* Test the generate_nonce_field method to build form field with a nonce parameter to send on via POST. Here the 
 	* parameter refer and echo are called with values:
	*
	*	referer: true ---> hidden field with refer url value is added.
	*	echo: true ------> the fields are printed.
 	*/
 	public function test_generate_nonce_field_referer_echo(){
		
		$nfg = new Nonce_Field_Generator( $this->test_action );

		// Building the expected form fields.
		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';
		
		// Check that the result is printed.
		$this->expectOutputString($field_expected);
		
		// Generating the form fields. Both parameters defaults to true.
		$field_generated = $nfg->generate_nonce_field();

		// Checking result.
		$this->assertSame( $field_generated, $field_expected);
 	}
}