<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Transaction;

class TransactionRepository
{
	private $_TransactionModel;
	private $_LedgerModel;
	private $_AccountModel;

	/**
	 * TransactionRepository constructor.
	 * @param \App\Transaction $Transaction
	 * @param \App\Ledger $Ledger
	 * @param \App\Account $Account
	 */
	public function __construct(
		\App\Transaction $Transaction,
		\App\Ledger $Ledger,
		\App\Account $Account )
	{
		$this->_AccountModel     = $Account;
		$this->_LedgerModel      = $Ledger;
		$this->_TransactionModel = $Transaction;
	}

	/**
	 * @param Transaction $Transaction
	 */
	public function save( Transaction $Transaction )
	{

	}
}
