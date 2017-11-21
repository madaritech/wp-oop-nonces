<?php 

namespace madaritech\nonces\test;

require_once dirname(__DIR__) . "/src/nonce-interface.php";
require_once dirname(__DIR__) . "/src/nonce-abstract.php";
require_once dirname(__DIR__) . "/src/class-nonce-generator.php";
require_once dirname(__DIR__) . "/src/class-nonce-field-generator.php";
require_once dirname(__DIR__) . "/test/mock-functions.php";

use madaritech\nonces\Nonce_Field_Generator;
use PHPUnit\Framework\TestCase;

class Nonce_Field_GeneratorTest extends TestCase
{

    public function test_instance() {

		$this->assertInstanceOf( Nonce_Field_Generator::class, new Nonce_Field_Generator( 'my_action', 'my_name' ) );
		$this->assertInstanceOf( Nonce_Field_Generator::class, new Nonce_Field_Generator( 'my_action' ) );
	}

	public function test_get_set_action() {

 		$nfg = new Nonce_Field_Generator( 'my_action', 'my_name' );
 		$this->assertEquals( 'my_action', $nfg->get_action() );

 		$action = $nfg->set_action( 'new_action' );
		$this->assertEquals( $action, $nfg->get_action() );
 	}

 	public function test_get_set_name() {

 		$nfg = new Nonce_Field_Generator('my_action', 'my_name');
 		$this->assertEquals( 'my_name', $nfg->get_name() );

 		$name = $nfg->set_name( 'new_name' );
		$this->assertEquals( $name, $nfg->get_name() );
 	}

 	public function test_default_name() {

 		$nfg = new Nonce_Field_Generator( 'another_action' );
 		
 		$this->assertEquals( 'another_action', $nfg->get_action() );
 		$this->assertEquals( '_wpnonce', $nfg->get_name() );
 	}

 	public function test_generate_nonce() {

		$nfg = new Nonce_Field_Generator( 'my_action' );

		$nonce_generated = $nfg->generate_nonce();
		$this->assertEquals( $nonce_generated, \madaritech\nonces\wp_create_nonce( 'my_action' ) );
 	}

 	public function test_get_set_nonce() {

 		$nfg = new Nonce_Field_Generator( 'my_action' );

 		$this->assertNull( $nfg->get_nonce() );

 		$nonce_generated = $nfg->generate_nonce();
 		$nfg->set_nonce( 'new_nonce' );

 		$this->assertNotEquals( $nonce_generated, $nfg->get_nonce() );
 		$this->assertEquals( 'new_nonce', $nfg->get_nonce() );
 	}

	public function test_generate_nonce_field(){
		
		$nfg = new Nonce_Field_Generator( 'my_action' );

		$field_generated = $nfg->generate_nonce_field( false, false );

		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . \madaritech\nonces\wp_create_nonce( $nfg->get_action() ) . '" />';

		$this->assertEquals( $field_generated, $field_expected);
 	}

 	public function test_generate_nonce_field_referer(){
		
		$nfg = new Nonce_Field_Generator( 'my_action' );

		$field_generated = $nfg->generate_nonce_field( true, false );

		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . \madaritech\nonces\wp_create_nonce( $nfg->get_action() ) . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';

		$this->assertEquals( $field_generated, $field_expected);
 	}

 	public function test_generate_nonce_field_echo(){
		
		$nfg = new Nonce_Field_Generator( 'my_action' );

		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . \madaritech\nonces\wp_create_nonce( $nfg->get_action() ) . '" />';

 		$this->expectOutputString($field_expected);

		$field_generated = $nfg->generate_nonce_field( false );

		$this->assertEquals( $field_generated, $field_expected);
 	}

 	public function test_generate_nonce_field_referer_echo(){
		
		$nfg = new Nonce_Field_Generator( 'my_action' );

		$field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . \madaritech\nonces\wp_create_nonce( $nfg->get_action() ) . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';
		
		$this->expectOutputString($field_expected);
		
		$field_generated = $nfg->generate_nonce_field();

		$this->assertEquals( $field_generated, $field_expected);
 	}
}