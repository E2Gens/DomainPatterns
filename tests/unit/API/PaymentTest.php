<?php

namespace Tests\unit\API;

use DDP\API\Payment;
use DDP\Domain\Accounting\Domain\Account;
use DDP\Domain\Accounting\Domain\LedgerItem;
use DDP\Domain\Accounting\Domain\Transaction;
use DDP\Domain\Accounting\Infrastructure\ILedgerItemRepository;
use DDP\Domain\Accounting\Infrastructure\IPaymentService;
use DDP\Domain\Accounting\Infrastructure\ITransactionRepository;
use Neuron\Data\Object\DateRange;
use PHPUnit\Framework\TestCase;

class MockPaymentService implements IPaymentService
{
	public function processPayment( Transaction $transaction, string $ConfirmationId ): string
	{
		return $ConfirmationId;
	}

	public function processRefund( Transaction $Transaction, string $ConfirmationId, string $ChargeId): string
	{
		return $ConfirmationId;
	}
}

class MockTransactionRepository implements ITransactionRepository
{
	public function save( Transaction $Transaction ): Transaction
	{
		return $Transaction;
	}
}

class MockLedgerItemRepository implements ILedgerItemRepository
{
	public function getAccountById( int $AccountId ): Account
	{
		$Account = new Account();
		$Account->setIdentifier( $AccountId );
		return $Account;
	}

	public function getAccountByName( string $Name ): Account
	{
		$Account = new Account();
		$Account->setIdentifier( 1 );
		$Account->setName( $Name );
		return $Account;
	}

	public function getById( int $LedgerItemId ): LedgerItem
	{
		$Item = new LedgerItem();
		$Item->setIdentifier( $LedgerItemId );
		return $Item;
	}

	public function getByDateRange( DateRange $Range ): array
	{
		return [
			new LedgerItem(),
			new LedgerItem()
		];
	}

	public function getByAccountAndDateRange( int $AccountId, DateRange $Range )
	{
		return [
			new LedgerItem(),
			new LedgerItem()
		];
	}

}

class PaymentTest extends TestCase
{
	public function testCharge()
	{
		$Payment = new Payment(
			new MockTransactionRepository(),
			new MockLedgerItemRepository(),
			new MockPaymentService()
		);

		$Transaction = $Payment->charge(
			[
				[
					'account' => 'test',
					'amount' => 1
				],
				[
					'account' => 'tax',
					'amount' => 2
				]
			],
			'1234'
		);

		$Ledger = $Transaction->getLedger();

		$this->assertEquals(
			$Transaction->getTotal(),
			3
		);

		$this->assertEquals(
			$Ledger[ 0 ]->getAmount(),
			1
		);

		$this->assertEquals(
			$Ledger[ 1 ]->getAmount(),
			2
		);

	}
}
