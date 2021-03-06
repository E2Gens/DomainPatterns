<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;
use DDP\Core\Domain\TimestampsTrait;
use Neuron\Data\Validation;

class Transaction extends EntityBase
{
	use TimestampsTrait;

	private $_UserId;
	private $_Total;
	private $_Key;
	private $_Ledger;
	private $_ItemId;

	public function __construct()
	{
		parent::__construct();

		$this->addMap( 'UserId','user_id', new Validation\Integer() );
		$this->addMap( 'ItemId','item_id', new Validation\Integer() );
		$this->addMap( 'Total', 'total',   new Validation\Integer() );
		$this->addMap( 'Key',   'key',     new Validation\StringData() );
		$this->addMap( 'Ledger','ledger',  new Validation\ArrayData() );
	}

	/**
	 * @return mixed
	 */
	public function getItemId() : ?int
	{
		return $this->_ItemId;
	}

	/**
	 * @param mixed $ItemId
	 * @return Transaction
	 */
	public function setItemId( $ItemId ) : Transaction
	{
		$this->_ItemId = $ItemId;
		return $this;
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
	public function setUserId( int $UserId )  : Transaction
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
	public function setTotal( int $Total ) : Transaction
	{
		$this->_Total = $Total;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getKey() : ?string
	{
		return $this->_Key;
	}

	/**
	 * @param string|null $Key
	 * @return Transaction
	 */
	public function setKey( ?string $Key ) : Transaction
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

	public function setLedger( array $Data ) : Transaction
	{
		foreach( $Data as $Item )
		{
			$LedgerItem = new LedgerItem();

			if( is_array( $Item ) )
			{
				$LedgerItem->arrayMap( $Item );
			}
			else
			{
				$LedgerItem = $Item;
			}

			$this->addLedgerItem( $LedgerItem );
		}
		return $this;
	}
}
