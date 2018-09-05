<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Transaction;

interface IPaymentService
{
	public function processPayment( Transaction $transaction ) : string;
}
