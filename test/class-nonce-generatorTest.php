<?php

namespace madaritech\nonces\test;

require_once dirname(__DIR__) . "/src/nonce-interface.php";
require_once dirname(__DIR__) . "/src/nonce-abstract.php";
require_once dirname(__DIR__) . "/src/class-nonce-generator.php";
require_once dirname(__DIR__) . "/test/mock-functions.php";

use madaritech\nonces\Nonce_Generator;
use PHPUnit\Framework\TestCase;

class Nonce_GeneratorTest extends TestCase
{

	public function test_instance() {

		$this->assertInstanceOf( Nonce_Generator::class, new Nonce_Generator( 'my_action', 'my_name' ) );
		$this->assertInstanceOf( Nonce_Generator::class, new Nonce_Generator( 'my_action' ) );
	}

	public function test_get_set_action() {

 		$ng = new Nonce_Generator( 'my_action', 'my_name' );
 		$this->assertEquals( 'my_action', $ng->get_action() );

 		$action = $ng->set_action( 'new_action' );
		$this->assertEquals( $action, $ng->get_action() );
 	}

 	public function test_get_set_name() {

 		$ng = new Nonce_Generator('my_action', 'my_name');
 		$this->assertEquals( 'my_name', $ng->get_name() );

 		$name = $ng->set_name( 'new_name' );
		$this->assertEquals( $name, $ng->get_name() );
 	}

 	public function test_default_name() {

 		$ng = new Nonce_Generator( 'another_action' );
 		
 		$this->assertEquals( 'another_action', $ng->get_action() );
 		$this->assertEquals( '_wpnonce', $ng->get_name() );
 	}

 	public function test_generate_nonce() {

		$ng = new Nonce_Generator('my_action');
		$this->assertNull( $ng->get_nonce() );

		$nonce_generated = $ng->generate_nonce();
		$this->assertEquals( $nonce_generated, \madaritech\nonces\wp_create_nonce('my_action') );
 	}

 	public function test_get_set_nonce() {

 		$ng = new Nonce_Generator( 'my_action' );

 		$nonce_generated = $ng->generate_nonce();
 		$ng->set_nonce( 'new_nonce' );

 		$this->assertNotEquals( $nonce_generated, $ng->get_nonce() );
 		$this->assertEquals( 'new_nonce', $ng->get_nonce() );
 	}
}