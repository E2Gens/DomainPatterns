<?php

use DDP\Domain\Accounting\Domain\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
	public $Account;

	public function setUp()
	{
		$this->Account = new Account();

		$this->Account->setName( 'Test Account' );
		$this->Account->setIdentifier( 1 );
	}

	public function testToStdClass()
	{
		$Obj = $this->Account->toStdClass();

		$this->assertEquals(
			$Obj->id,
			$this->Account->getIdentifier()
		);

		$this->assertEquals(
			$Obj->name,
			$this->Account->getName()
	);

	}

	public function testFromArray()
	{
		$Data = [
			'id'   => '1',
			'name' => 'Test Account'
		];

		$Account = new Account();

		Account::fromArray( $Account, $Data );

		$this->assertEquals(
			$Account->getIdentifier(),
			$Data[ 'id' ]
		);

		$this->assertEquals(
			$Account->getName(),
			$Data[ 'name' ]
		);
	}
}
