<?php

use DDP\Domain\Accounting\Domain\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
	public function testFromArray()
	{
		$Data = [
			'id'      => 1,
			'key'     => '1234',
			'total'   => 5,
			'user_id' => 2,
			'ledger'  => [
				[
					'id'             => '1',
					'amount'         => 501,
					'transaction_id' => 21,
					'account_id'     => 1
				],
				[
					'id'             => '2',
					'amount'         => 502,
					'transaction_id' => 22,
					'account_id'     => 2
				],
				[
					'id'             => '3',
					'amount'         => 503,
					'transaction_id' => 23,
					'account_id'     => 3
				]
			]
		];

		$Transaction = new Transaction();

		Transaction::fromArray( $Transaction, $Data );

		$this->assertEquals(
			$Transaction->getIdentifier(),
			$Data[ 'id' ]
		);

		$this->assertEquals(
			$Transaction->getKey(),
			$Data[ 'key' ]
		);

		$this->assertEquals(
			$Transaction->getTotal(),
			$Data[ 'total' ]
		);

		$this->assertEquals(
			$Transaction->getUserId(),
			$Data[ 'user_id' ]
		);

		$Items = $Transaction->getLedger();

		$this->assertEquals(
			count( $Items ),
			count( $Data[ 'ledger' ] )
		);

		for( $Count = 0; $Count < count( $Items ); $Count++ )
		{
			$this->assertEquals(
				$Items[ $Count ]->getIdentifier(),
				$Data[ 'ledger' ][ $Count ][ 'id' ]
			);

			$this->assertEquals(
				$Items[ $Count ]->getAmount(),
				$Data[ 'ledger' ][ $Count ][ 'amount' ]
			);

			$this->assertEquals(
				$Items[ $Count ]->getTransactionId(),
				$Data[ 'ledger' ][ $Count ][ 'transaction_id' ]
			);

			$this->assertEquals(
				$Items[ $Count ]->getAccountId(),
				$Data[ 'ledger' ][ $Count ][ 'account_id' ]
			);
		}

	}

	public function testToStdClass()
	{
		$Transaction = new Transaction();
		$Transaction->setIdentifier( 1 );
		$Transaction->setKey( '1234' );
		$Transaction->setTotal( 5 );
		$Transaction->setUserId(2 );

		$Obj = $Transaction->toStdClass();

		$this->assertEquals(
			$Transaction->getIdentifier(),
			$Obj->id
		);

		$this->assertEquals(
			$Transaction->getKey(),
			$Obj->key
		);

		$this->assertEquals(
			$Transaction->getTotal(),
			$Obj->total
		);

		$this->assertEquals(
			$Transaction->getUserId(),
			$Obj->user_id
		);
	}
}
