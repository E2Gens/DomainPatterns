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

	public function testArrayMap()
	{
		$Data = [
			'id'              => '1',
			'amount'          => 500,
			'transaction_id'  => 2,
			'account_id'      => 3,
			'payment_type_id' => 4,
			'payment_type'    => [
				'id'   => 1,
				'name' => 'Cash'
			]
		];

		$LedgerItem = new LedgerItem();

		$LedgerItem->arrayMap( $Data );

		$this->assertEquals(
			$Data[ 'id' ],
			$LedgerItem->getIdentifier()
		);

		$this->assertEquals(
			$Data[ 'amount' ],
			$LedgerItem->getAmount()
		);

		$this->assertEquals(
			$Data[ 'transaction_id' ],
			$LedgerItem->getTransactionId()
		);

		$this->assertEquals(
			$Data['payment_type_id'],
			$LedgerItem->getPaymentTypeId()
		);

		$this->assertEquals(
			$Data['payment_type'],
			$LedgerItem->getPaymentType()
		);

		$this->assertEquals(
			$Data[ 'account_id' ],
			$LedgerItem->getAccountId()
		);
	}

	public function testSetTransactionId()
	{
		$LedgerItem = new LedgerItem();

		$TransactionId = 1;

		$LedgerItem->setTransactionId( $TransactionId );

		$this->assertEquals(
			$TransactionId, $LedgerItem->getTransactionId()
		);

		$TransactionId = null;

		$LedgerItem->setTransactionId( $TransactionId );

		$this->assertNull( $LedgerItem->getTransactionId() );
	}
}


