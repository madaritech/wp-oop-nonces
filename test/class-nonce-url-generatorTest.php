<?php 

namespace madaritech\nonces\test;

require_once dirname(__DIR__) . "/src/nonce-interface.php";
require_once dirname(__DIR__) . "/src/nonce-abstract.php";
require_once dirname(__DIR__) . "/src/class-nonce-generator.php";
require_once dirname(__DIR__) . "/src/class-nonce-url-generator.php";
require_once dirname(__DIR__) . "/test/mock-functions.php";

use madaritech\nonces\Nonce_Url_Generator;
use PHPUnit\Framework\TestCase;

class Nonce_Url_GeneratorTest extends TestCase
{

    public function test_instance() {

		$this->assertInstanceOf( Nonce_Url_Generator::class, new Nonce_Url_Generator( 'my_action', 'my_name' ) );
		$this->assertInstanceOf( Nonce_Url_Generator::class, new Nonce_Url_Generator( 'my_action' ) );
	}

	public function test_get_set_action() {

 		$nug = new Nonce_Url_Generator( 'my_action', 'my_name' );
 		$this->assertEquals( 'my_action', $nug->get_action() );

 		$action = $nug->set_action( 'new_action' );
		$this->assertEquals( $action, $nug->get_action() );
 	}

 	public function test_get_set_name() {

 		$nug = new Nonce_Url_Generator('my_action', 'my_name');
 		$this->assertEquals( 'my_name', $nug->get_name() );

 		$name = $nug->set_name( 'new_name' );
		$this->assertEquals( $name, $nug->get_name() );
 	}

 	public function test_default_name() {

 		$nug = new Nonce_Url_Generator( 'another_action' );
 		
 		$this->assertEquals( 'another_action', $nug->get_action() );
 		$this->assertEquals( '_wpnonce', $nug->get_name() );
 	}

 	public function test_generate_nonce() {

		$nug = new Nonce_Url_Generator( 'my_action' );

		$nonce_generated = $nug->generate_nonce();
		$this->assertEquals( $nonce_generated, \madaritech\nonces\wp_create_nonce( 'my_action' ) );
 	}

 	public function test_get_set_nonce() {

 		$nug = new Nonce_Url_Generator( 'my_action' );
 		$this->assertNull( $nug->get_nonce() );

 		$nonce_generated = $nug->generate_nonce();
 		$nug->set_nonce( 'new_nonce' );

 		$this->assertNotEquals( $nonce_generated, $nug->get_nonce() );
 		$this->assertEquals( 'new_nonce', $nug->get_nonce() );
 	}

 	public function test_generate_nonce_url(){

		$nug = new Nonce_Url_Generator( 'my_action' );

		$url_generated = $nug->generate_nonce_url( 'http://www.madaritech.com' );
		$url_expected = 'http://www.madaritech.com?_wpnonce='. \madaritech\nonces\wp_create_nonce( $nug->get_action() );

		$this->assertEquals( $url_generated, $url_expected);
 	}
}