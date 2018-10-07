<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Account;
use DDP\Domain\Accounting\Domain\LedgerItem;
use Neuron\Data\Object\DateRange;

class LedgerItemRepository implements ILedgerItemRepository
{
	private $_LedgerModel;
	private $_AccountModel;

	/**
	 * LedgerItemRepository constructor.
	 * @param \App\Ledger $Ledger
	 */
	public function __construct( \App\Ledger $Ledger, \App\Account $Account )
	{
		$this->_LedgerModel = $Ledger;
		$this->_AccountModel = $Account;
	}

	/**
	 * @param int $AccountId
	 * @return Account
	 *
	 * @throws \Exception
	 */
	public function getAccountById( int $AccountId ) : Account
	{
		$Account = new Account();

		$Data = $this->_AccountModel->where( 'id', $AccountId )->first()->toArray();

		$Account->arrayMap( $Data );

		return $Account;
	}

	/**
	 * @param string $Name
	 * @return Account
	 *
	 * @throws \Exception
	 */
	public function getAccountByName( string $Name ) : Account
	{
		$Account = new Account();

		$Data = $this->_AccountModel->where( 'name', $Name )->first()->toArray();

		$Account->arrayMap( $Data );

		return $Account;
	}

	/**
	 * @param int $LedgerItemId
	 * @return LedgerItem
	 *
	 * @throws \Exception
	 */
	public function getById( int $LedgerItemId ) : LedgerItem
	{
		$Data = $this->_LedgerModel->where( 'id', $LedgerItemId )->first()->toArray();

		$Ledger = new LedgerItem();

		$Ledger->arrayMap( $Data );

		return $Ledger;
	}

	/**
	 * @param int $TransactionId
	 * @param string $AccountName
	 * @return array
	 *
	 * @throws \Exception
	 */
	public function getAllByTransactionId( int $TransactionId, string $AccountName = '' ) : array
	{
		$Query = $this->_LedgerModel->where( 'transaction_id', $TransactionId );

		if( $AccountName )
		{
			$Query->join( 'accounts', 'accounts.id', '=', 'ledger_items.account_id' )
				->where( 'accounts.name', '=' , $AccountName );
		}

		$Objects = $Query->get()->toArray();

		$Items = [];

		foreach( $Objects as $Object )
		{
			$Item = new LedgerItem();
			$Item->arrayMap( $Object );

			$Items[] = $Item;
		}

		return $Items;
	}

	/**
	 * @param DateRange $Range
	 * @return array
	 *
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
	 *
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
