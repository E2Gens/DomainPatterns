<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;
use Neuron\Data\Validation;

class LedgerItem extends EntityBase
{
	private $_AccountId;
	private $_Amount;
	private $_TransactionId;
	private $_ItemId;
	private $_PaymentTypeId;
	private $_PaymentType;

	public function __construct()
	{
		parent::__construct();

		$this->addMap( 'AccountId',    'account_id',       new Validation\Integer() );
		$this->addMap( 'Amount',       'amount',           new Validation\Integer() );
		$this->addMap( 'TransactionId','transaction_id',   new Validation\Integer() );
		$this->addMap( 'ItemId',       'item_id',          new Validation\Integer() );
		$this->addMap( 'PaymentTypeId','payment_type_id',  new Validation\Integer() );
		$this->addMap( 'PaymentType',  'payment_type',     new Validation\ArrayData() );
	}

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
	public function setAccountId( int $AccountId ): LedgerItem
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
	public function setAmount( int $Amount ): LedgerItem
	{
		$this->_Amount = $Amount;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTransactionId() : ?int
	{
		return $this->_TransactionId;
	}

	/**
	 * @param mixed $TransactionId
	 * @return LedgerItem
	 */
	public function setTransactionId( int $TransactionId ): LedgerItem
	{
		$this->_TransactionId = $TransactionId;
		return $this;
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
	 * @return LedgerItem
	 */
	public function setItemId( int $ItemId ): LedgerItem
	{
		$this->_ItemId = $ItemId;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getPaymentTypeId(): ?int
	{
		return $this->_PaymentTypeId;
	}

	/**
	 * @param int|null $PaymentTypeId
	 * @return LedgerItem
	 */
	public function setPaymentTypeId( ?int $PaymentTypeId ): LedgerItem
	{
		$this->_PaymentTypeId = $PaymentTypeId;
		return $this;
	}

	/**
	 * @return array|null
	 */
	public function getPaymentType(): ?array
	{
		return $this->_PaymentType;
	}

	/**
	 * @param array|null $PaymentType
	 * @return LedgerItem
	 */
	public function setPaymentType( ?array $PaymentType ): LedgerItem
	{
		$this->_PaymentType = $PaymentType;
		return $this;
	}
}
