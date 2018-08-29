<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;

class LedgerItem extends EntityBase
{
	private $_AccountId;
	private $_Amount;
	private $_TransactionId;

	/**
	 * @return mixed
	 */
	public function getAccountId() : int
	{
		return $this->_AccountId;
	}

	/**
	 * @param mixed $AccountId
	 * @return LedgerItem
	 */
	public function setAccountId( int $AccountId )
	{
		$this->_AccountId = $AccountId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAmount() : int
	{
		return $this->_Amount;
	}

	/**
	 * @param mixed $Amount
	 * @return LedgerItem
	 */
	public function setAmount( int $Amount )
	{
		$this->_Amount = $Amount;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTransactionId() : int
	{
		return $this->_TransactionId;
	}

	/**
	 * @param mixed $TransactionId
	 * @return LedgerItem
	 */
	public function setTransactionId( int $TransactionId )
	{
		$this->_TransactionId = $TransactionId;
		return $this;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getAccountId() )
		{
			$Obj->account_id = $this->getAccountId();
		}

		if( $this->getTransactionId() )
		{
			$Obj->transaction_id = $this->getTransactionId();
		}

		if( $this->getAmount() )
		{
			$Obj->amount = $this->getAmount();
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

		if( isset( $Data[ 'account_id' ] ) )
		{
			$Transaction->setAccountId( $Data[ 'account_id' ] );
		}

		if( isset( $Data[ 'transaction_id' ] ) )
		{
			$Transaction->setTransactionId( $Data[ 'transaction_id' ] );
		}

		if( isset( $Data[ 'amount' ] ) )
		{
			$Transaction->setAmount( $Data[ 'amount' ] );
		}
	}
}
