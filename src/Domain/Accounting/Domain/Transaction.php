<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;
use Neuron\Data\Validation;

class Transaction extends EntityBase
{
	private $_UserId;
	private $_Total;
	private $_Key;
	private $_Ledger;

	public function __construct()
	{
		parent::__construct();

		$this->addMap( 'UserId','user_id', new Validation\Integer() );
		$this->addMap( 'Total', 'total',   new Validation\Integer() );
		$this->addMap( 'Key',   'key',     new Validation\StringData() );
		$this->addMap( 'Ledger','ledger',  new Validation\ArrayData() );
	}

	/**
	 * @return mixed
	 */
	public function getUserId() : int
	{
		return $this->_UserId;
	}

	/**
	 * @param mixed $UserId
	 * @return Transaction
	 */
	public function setUserId( int $UserId )
	{
		$this->_UserId = $UserId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTotal() : int
	{
		return $this->_Total;
	}

	/**
	 * @param mixed $Total
	 * @return Transaction
	 */
	public function setTotal( int $Total )
	{
		$this->_Total = $Total;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getKey() : string
	{
		return $this->_Key;
	}

	/**
	 * @param mixed $Key
	 * @return Transaction
	 */
	public function setKey( string $Key )
	{
		$this->_Key = $Key;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLedger() : ?array
	{
		return $this->_Ledger;
	}

	/**
	 * @param LedgerItem $Item
	 */
	public function addLedgerItem( LedgerItem $Item )
	{
		$this->_Ledger[] = $Item;
	}

	public function setLedger( array $Data )
	{
		foreach( $Data as $Item )
		{
			$LedgerItem = new LedgerItem();
			$LedgerItem->arrayMap( $Item );
			$this->addLedgerItem( $LedgerItem );
		}
	}
}
