<?php 

namespace madaritech\nonces\test;

require_once dirname(__DIR__) . "/src/nonce-interface.php";
require_once dirname(__DIR__) . "/src/nonce-abstract.php";
require_once dirname(__DIR__) . "/src/class-nonce-validator.php";
require_once dirname(__DIR__) . "/test/mock-functions.php";

use madaritech\nonces\Nonce_Validator;
use PHPUnit\Framework\TestCase;

class Nonce_ValidatorTest extends TestCase
{

    public function test_instance() {

		$this->assertInstanceOf( Nonce_Validator::class, new Nonce_Validator( 'my_action', 'my_name' ) );
		$this->assertInstanceOf( Nonce_Validator::class, new Nonce_Validator( 'my_action' ) );
	}

	public function test_get_set_action() {

 		$nv = new Nonce_Validator( 'my_action', 'my_name' );
 		$this->assertEquals( 'my_action', $nv->get_action() );

 		$action = $nv->set_action( 'new_action' );
		$this->assertEquals( $action, $nv->get_action() );
 	}

 	public function test_get_set_name() {

 		$nv = new Nonce_Validator('my_action', 'my_name');
 		$this->assertEquals( 'my_name', $nv->get_name() );

 		$name = $nv->set_name( 'new_name' );
		$this->assertEquals( $name, $nv->get_name() );
 	}

 	public function test_default_name() {

 		$nv = new Nonce_Validator( 'another_action' );
 		
 		$this->assertEquals( 'another_action', $nv->get_action() );
 		$this->assertEquals( '_wpnonce', $nv->get_name() );
 	}

 	public function test_validate_nonce() {

 		$test_action = 'my_action';
 		$nv = new Nonce_Validator( $test_action );
 		
 		$nonce = \madaritech\nonces\wp_create_nonce( $test_action );

 		$is_valid = $nv->validate_nonce( $nonce );
 		$this->assertTrue( $is_valid );

 		$is_valid = $nv->validate_nonce( $nonce . 'failure' );
 		$this->assertFalse( $is_valid );
 	}

 	public function test_validate_request() {

 		$test_action = 'my_action';
 		$test_name = '_wpnonce';
 		$nonce = \madaritech\nonces\wp_create_nonce( $test_action );

 		$_REQUEST[ $test_name ] = $nonce;

 		$nv = new Nonce_Validator( $test_action );

 		$is_valid = $nv->validate_request();
 		$this->assertTrue( $is_valid );

		$_REQUEST[ $test_name ] = $nonce . 'failure';

 		$is_valid = $nv->validate_request( $nonce . 'failure' );
 		$this->assertFalse( $is_valid );
 	}
}