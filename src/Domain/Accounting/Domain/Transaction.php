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

	/**
	 * @param LedgerItem $Item
	 */
	public function addLedgerItem( LedgerItem $Item )
	{
		$this->_Ledger[] = $Item;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getUserId() )
		{
			$Obj->user_id = $this->getUserId();
		}

		if( $this->getTotal() )
		{
			$Obj->total = $this->getTotal();
		}

		if( $this->getKey() )
		{
			$Obj->key = $this->getKey();
		}

		return $Obj;
	}

	/**
	 * @param $Transaction
	 * @param array $Data
	 */
	public static function fromArray( &$Transaction, array $Data ): void
	{
		parent::fromArray( $Transaction, $Data );

		if( isset( $Data[ 'user_id' ] ) )
		{
			$Transaction->setUserId( $Data[ 'user_id' ] );
		}

		if( isset( $Data[ 'total' ] ) )
		{
			$Transaction->setTotal( $Data[ 'total' ] );
		}

		if( isset( $Data[ 'key' ] ) )
		{
			$Transaction->setKey( $Data[ 'key' ] );
		}

		if( isset( $Data[ 'ledger' ] ) & is_array( $Data[ 'ledger' ] ) )
		{
			foreach( $Data[ 'ledger' ] as $Item )
			{
				$LedgerItem = new LedgerItem();
				$LedgerItem::fromArray( $LedgerItem, $Item );
				$Transaction->addLedgerItem( $LedgerItem );
			}
		}
	}
}
