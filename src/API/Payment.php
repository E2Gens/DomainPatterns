<?php

namespace DDP\API;

use DDP\Domain\Accounting\Domain\LedgerItem;
use DDP\Domain\Accounting\Domain\Transaction;
use DDP\Domain\Accounting\Infrastructure\IPaymentService;
use DDP\Domain\Accounting\Infrastructure\ILedgerItemRepository;
use DDP\Domain\Accounting\Infrastructure\ITransactionRepository;

class Payment
{
	private $_TransactionRepository;
	private $_LedgerRepository;
	private $_PaymentService;

	public function __construct(
		ITransactionRepository $TransRepo,
		ILedgerItemRepository $LedgerRepo,
		IPaymentService $PaymentService )
	{
		$this->_TransactionRepository = $TransRepo;
		$this->_LedgerRepository      = $LedgerRepo;
		$this->_PaymentService        = $PaymentService;
	}

	/**
	 * @return ITransactionRepository
	 */
	public function getTransactionRepository(): ITransactionRepository
	{
		return $this->_TransactionRepository;
	}

	/**
	 * @return ILedgerItemRepository
	 */
	public function getLedgerRepository(): ILedgerItemRepository
	{
		return $this->_LedgerRepository;
	}

	/**
	 * @return IPaymentService
	 */
	public function getPaymentService(): IPaymentService
	{
		return $this->_PaymentService;
	}

	public function getTotal( array $LineItems ) : int
	{
		$Total = 0;

		foreach( $LineItems as $LineItem )
		{
			$Total += $LineItem[ 'amount' ];
		}

		return $Total;
	}

	/**
	 * @param array $LineItems
	 * @param string $ConfirmationId
	 * @return Transaction
	 * @throws \Exception
	 */
	public function charge( array $LineItems, string $ConfirmationId ) : Transaction
	{
		$Transaction = new Transaction();

		$Total = 0;

		foreach( $LineItems as $LineItem )
		{
			$Ledger = new LedgerItem();

			$Account = $this->_LedgerRepository->getAccountByName( $LineItem[ 'account' ] );

			$Ledger->setAccountId( $Account->getIdentifier() );
			$Ledger->setAmount( $LineItem[ 'amount' ] );

			if( array_key_exists( 'item_id', $LineItem ) )
			{
				$Ledger->setItemId( $LineItem[ 'item_id' ] );
			}

			$Total += $LineItem[ 'amount' ];
			$Transaction->addLedgerItem( $Ledger );
		}

		$Transaction->setTotal( $Total );

		$Transaction->setKey(
			$this->_PaymentService->processPayment( $Transaction, $ConfirmationId )
		);

		return $Transaction;
	}
}
