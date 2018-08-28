<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;

class Transaction extends EntityBase
{
	private $_UserId;
	private $_Total;
	private $_Key;
	private $_Ledger;

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
	public function getLedger() : array
	{
		return $this->_Ledger;
	}

	public function addLedgerItem( LedgerItem $Item )
	{
		$this->_Ledger[] = $Item;
	}
}
