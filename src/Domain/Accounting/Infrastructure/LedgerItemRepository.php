<?php

namespace DDP\Domain\Accounting\Infrastructure;

use Neuron\Data\Object\DateRange;

class LedgerItemRepository
{
	public function getById( int $LedgerItemId )
	{

	}

	public function getByDateRange( DateRange $Range ) : array
	{
		$Validator = new \Neuron\Data\Validation\DateRange();

		if( $Validator->isValid( $Range ) )
		{
			throw new \Exception( "Invalid date range: ".$Range->Start.'-'.$Range->End );
		}
	}

	public function getByAccountAndDateRange( int $AccountId, DateRange $Range )
	{
		$Validator = new \Neuron\Data\Validation\DateRange();

		if( $Validator->isValid( $Range ) )
		{
			throw new \Exception( "Invalid date range: ".$Range->Start.'-'.$Range->End );
		}


	}
}
