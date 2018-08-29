<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\LedgerItem;
use Neuron\Data\Object\DateRange;

class LedgerItemRepository
{
	private $_LedgerModel;

	public function __construct( \App\Ledger $Ledger )
	{
		$this->_LedgerModel = $Ledger;
	}

	public function getById( int $LedgerItemId ) : LedgerItem
	{
		$Data = $this->_LedgerModel->where( 'id', $LedgerItemId )->first()->toArray();

		$Ledger = new LedgerItem();

		LedgerItem::fromArray( $Ledger, $Data );

		return $Ledger;
	}

	public function getByDateRange( DateRange $Range ) : array
	{
		$Validator = new \Neuron\Data\Validation\DateRange();

		if( $Validator->isValid( $Range ) )
		{
			throw new \Exception( "Invalid date range: ".$Range->Start.'-'.$Range->End );
		}

		// @todo
		throw new \Exception( 'not implemented' );
	}

	public function getByAccountAndDateRange( int $AccountId, DateRange $Range )
	{
		$Validator = new \Neuron\Data\Validation\DateRange();

		if( $Validator->isValid( $Range ) )
		{
			throw new \Exception( "Invalid date range: ".$Range->Start.'-'.$Range->End );
		}

		// @todo
		throw new \Exception( 'not implemented' );
	}
}
