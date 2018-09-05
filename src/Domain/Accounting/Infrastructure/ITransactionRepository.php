<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Transaction;

interface ITransactionRepository
{
	/**
	 * @param Transaction $Transaction
	 * @return Transaction
	 */
	public function save( Transaction $Transaction ): Transaction;
}
