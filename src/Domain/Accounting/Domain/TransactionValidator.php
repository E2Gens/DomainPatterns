<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\ValidatorBase;
use Neuron\Data\Validation\ICollection;
use Neuron\Log\Log;

class TransactionValidator extends ValidatorBase implements ICollection
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * The primary validation for a transaction is to ensure that the sum of its
	 * ledger items equals its total.
	 *
	 * @param $Transaction
	 * @return bool
	 */
	public function isValid( $Transaction ): bool
	{
		$Items = $Transaction->getLedger();

		$Total = 0;

		foreach( $Items as $Item )
		{
			$Total += $Item->getAmount();
		}

		$Result = true;

		if( $Transaction->getTotal() != $Total )
		{
			$Message = "Ledger discrepancy for transaction_key: ".$Transaction->getKey();

			Log::error( $Message );

			$this->addViolation( $Message );
			$Result = false;
		}

		if( !$Transaction->getKey() )
		{
			$Message = "Transaction {$Transaction->getIdentifier()} missing transaction_key: ";

			Log::error( $Message );

			$this->addViolation( $Message );

			$Result = false;
		}

		return $Result;
	}
}
