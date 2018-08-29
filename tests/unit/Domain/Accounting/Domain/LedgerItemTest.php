<?php

use DDP\Domain\Accounting\Domain\LedgerItem;
use PHPUnit\Framework\TestCase;

class LedgerItemTest extends TestCase
{
	public $LedgerItem;

	public function setUp()
	{
		$this->LedgerItem = new LedgerItem();

		$this->LedgerItem->setIdentifier( 1 );
		$this->LedgerItem->setAmount( 500 );
		$this->LedgerItem->setTransactionId( 2 );
		$this->LedgerItem->setAccountId( 3 );
	}

	public function testToStdClass()
	{
		$Obj = $this->LedgerItem->toStdClass();

		$this->assertEquals(
			$this->LedgerItem->getIdentifier(),
			$Obj->id
		);

		$this->assertEquals(
			$this->LedgerItem->getAmount(),
			$Obj->amount
		);

		$this->assertEquals(
			$this->LedgerItem->getTransactionId(),
			$Obj->transaction_id
		);

		$this->assertEquals(
			$this->LedgerItem->getAccountId(),
			$Obj->account_id
		);
	}

	public function testFromArray()
	{
		$Data = [
			'id'             => '1',
			'amount'         => 500,
			'transaction_id' => 2,
			'account_id'     => 3
		];

		$LedgerItem = new LedgerItem();

		LedgerItem::fromArray( $LedgerItem, $Data );

		$this->assertEquals(
			$LedgerItem->getIdentifier(),
			$Data[ 'id' ]
		);

		$this->assertEquals(
			$LedgerItem->getAmount(),
			$Data[ 'amount' ]
		);

		$this->assertEquals(
			$LedgerItem->getTransactionId(),
			$Data[ 'transaction_id' ]
		);

		$this->assertEquals(
			$LedgerItem->getAccountId(),
			$Data[ 'account_id' ]
		);
	}
}


