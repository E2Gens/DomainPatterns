<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\LedgerItem;
use Neuron\Data\Object\DateRange;

class LedgerItemRepository
{
	private $_LedgerModel;

	/**
	 * LedgerItemRepository constructor.
	 * @param \App\Ledger $Ledger
	 */
	public function __construct( \App\Ledger $Ledger )
	{
		$this->_LedgerModel = $Ledger;
	}

	/**
	 * @param int $LedgerItemId
	 * @return LedgerItem
	 */
	public function getById( int $LedgerItemId ) : LedgerItem
	{
		$Data = $this->_LedgerModel->where( 'id', $LedgerItemId )->first()->toArray();

		$Ledger = new LedgerItem();

		LedgerItem::fromArray( $Ledger, $Data );

		return $Ledger;
	}

	/**
	 * @param DateRange $Range
	 * @return array
	 * @throws \Exception
	 */
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

	/**
	 * @param int $AccountId
	 * @param DateRange $Range
	 * @throws \Exception
	 */
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
