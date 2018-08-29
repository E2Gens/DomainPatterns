<?php

use DDP\Domain\Accounting\Domain\TransactionValidator;
use PHPUnit\Framework\TestCase;

class TransactionValidatorTest extends TestCase
{
	public function testValidatorTotalFail()
	{
		$Validator = new TransactionValidator();

		$Transaction = new \DDP\Domain\Accounting\Domain\Transaction();
		$Transaction->setKey( "Test1" );

		$LedgerItem1 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem1->setAmount( 1 );

		$Transaction->addLedgerItem( $LedgerItem1 );

		$LedgerItem2 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem2->setAmount( 2 );

		$Transaction->addLedgerItem( $LedgerItem2 );

		$Transaction->setTotal( 5 );

		$this->assertFalse(
			$Validator->isValid( $Transaction )
		);
	}

	public function testValidatorKeyFail()
	{
		$Validator = new TransactionValidator();

		$Transaction = new \DDP\Domain\Accounting\Domain\Transaction();
		$Transaction->setKey( "" );

		$LedgerItem1 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem1->setAmount( 1 );

		$Transaction->addLedgerItem( $LedgerItem1 );

		$LedgerItem2 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem2->setAmount( 2 );

		$Transaction->addLedgerItem( $LedgerItem2 );

		$Transaction->setTotal( 3 );

		$this->assertFalse(
			$Validator->isValid( $Transaction )
		);
	}

	public function testValidatorPass()
	{
		$Validator = new TransactionValidator();

		$Transaction = new \DDP\Domain\Accounting\Domain\Transaction();
		$Transaction->setKey( "Test1" );

		$LedgerItem1 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem1->setAmount( 1 );

		$Transaction->addLedgerItem( $LedgerItem1 );

		$LedgerItem2 = new \DDP\Domain\Accounting\Domain\LedgerItem();
		$LedgerItem2->setAmount( 1 );

		$Transaction->addLedgerItem( $LedgerItem2 );

		$Transaction->setTotal( 2 );

		$this->assertTrue(
			$Validator->isValid( $Transaction )
		);
	}
}
