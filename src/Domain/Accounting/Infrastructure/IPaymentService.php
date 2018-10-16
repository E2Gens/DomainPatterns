<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Transaction;

interface IPaymentService
{
	public function processPayment( Transaction $Transaction, string $ConfirmationId ) : string;
	public function processRefund( Transaction $Transaction, string $ConfirmationId, string $ChargeId ) : string;
}
