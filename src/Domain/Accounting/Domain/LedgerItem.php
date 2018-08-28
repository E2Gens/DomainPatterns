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
}
