<?php

use DDP\Core\Infrastructure\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
	public $Message;

	public function setUp()
	{
		$this->Message = new Message();
	}

	public function testSetTo()
	{
		$Passed = true;
		try
		{
			$this->Message->setTo( [ 'test1@example.org', 'test2@exampleorg' ] );
		}
		catch( \Exception $Exception )
		{
			$Passed = false;
		}

		$this->assertFalse( $Passed );
	}

	public function testSetFrom()
	{
		$Passed = true;
		try
		{
			$this->Message->setFrom( 'test2@exampleorg' );
		}
		catch( \Exception $Exception )
		{
			$Passed = false;
		}

		$this->assertFalse( $Passed );
	}


	public function testGetTo()
	{
		$this->Message->setTo( [ 'test1@example.org', 'test2@example.org' ] );

		$List = $this->Message->getTo();

		$this->assertEquals(
			'test1@example.org',
			$List[ 0 ]
		);

		$this->assertEquals(
			'test2@example.org',
			$List[ 1 ]
		);

	}

	public function testGetSubject()
	{
		$this->Message->setSubject( 'test' );

		$this->assertEquals(
			'test',
			$this->Message->getSubject()
		);
	}

	public function testGetMessage()
	{
		$this->Message->setMessage( 'test' );

		$this->assertEquals(
			'test',
			$this->Message->getMessage()
		);

	}

	public function testGetFrom()
	{
		$this->Message->setFrom( 'test@example.org' );

		$this->assertEquals(
			'test@example.org',
			$this->Message->getFrom()
		);

	}
}
