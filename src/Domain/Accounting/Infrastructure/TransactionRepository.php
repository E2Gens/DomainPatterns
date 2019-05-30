<?php

namespace DDP\Domain\Accounting\Infrastructure;

use App\DDD\CurrencyService;
use DDP\Domain\Accounting\Domain\LedgerItem;
use DDP\Domain\Accounting\Domain\Transaction;
use Neuron\Data\Object\DateRange;


class TransactionRepository implements ITransactionRepository
{
	private $_TransactionModel;
	private $_LedgerModel;
	private $_AccountModel;

	/**
	 * TransactionRepository constructor.
	 * @param \App\Transaction $Transaction
	 * @param \App\Ledger $Ledger
	 * @param \App\Account $Account
	 */
	public function __construct(
		\App\Transaction $Transaction,
		\App\Ledger $Ledger,
		\App\Account $Account )
	{
		$this->_AccountModel     = $Account;
		$this->_LedgerModel      = $Ledger;
		$this->_TransactionModel = $Transaction;
	}

	/**
	 * @param DateRange $Range
	 * @return array
	 * @throws \Exception
	 */
	public function getByDateRange( DateRange $Range ): array
	{
		$Transactions = [];

		$Results = $this->_TransactionModel
			->with('ledger')
			->whereDate('created_at', '>=', $Range->Start)
			->whereDate('created_at', '<=', $Range->End)
			->get()
			->toArray();

		foreach ( $Results as $Result )
		{
			$Transaction = new Transaction();

			$Transaction->arrayMap( $Result );

			$Transactions[] = $Transaction;
		}

		return $Transactions;
	}

	public function getById( int $TransactionId ) : Transaction
	{
		$Data = $this->_TransactionModel->where( 'id', $TransactionId )->first()->toArray();

		$Transaction = new Transaction();

		$Transaction->arrayMap( $Data );

		$Repo = new LedgerItemRepository(
			$this->_LedgerModel,
			$this->_AccountModel
		);

		$Transaction->setLedger(
			$Repo->getAllByTransactionId( $TransactionId )
		);

		return $Transaction;
	}

	/**
	 * @param int $UserId
	 * @return array
	 * @throws \Exception
	 */
	public function getByUserId( int $UserId ): array
	{
		$Transactions = [];

		$Rows = $this->_TransactionModel
			->where( 'user_id', $UserId )
			->orderBy('created_at', 'DESC')
			->with('ledger')
			->get()
			->toArray();

		foreach ( $Rows as $Row )
		{
			$Transaction = new Transaction();

			$Transaction->arrayMap( $Row );

			$Transactions[] = $Transaction;
		}

		return $Transactions;
	}

	/**
	 * @param Transaction $Transaction
	 * @return Transaction
	 */
	public function save( Transaction $Transaction ) : Transaction
	{
		$Obj = $Transaction->toStdClass();

		// Write Transaction

		if( $Transaction->getIdentifier() )
		{
			unset( $Obj->is_deleted );
			unset( $Obj->is_new );

			$this->_TransactionModel->whereId( $Transaction->getIdentifier() )->update( ( array)$Obj );
		}
		else
		{
			$TransactionModel = $this->_TransactionModel->create( ( array)$Obj );

			$Transaction->setIdentifier( $TransactionModel->id );

			$Items = $Transaction->getLedger();

			foreach( $Items as $Item )
			{
				$Item->setTransactionId( $Transaction->getIdentifier() );
			}
		}

		// Write Ledger Items

		$this->saveLedgerItems( $Transaction );

		return $Transaction;
	}

	/**
	 * @param Transaction $Transaction
	 * @return array|mixed
	 */
	protected function saveLedgerItems( Transaction $Transaction )
	{
		$Items = $Transaction->getLedger();

		// Save/Update/Delete items..
		if( is_array( $Items ) )
		{
			array_walk(
				$Items,
				[
					$this,
					'addOrRemoveLedgerItem'
				]
			);
		}

		// Rebuild the array, removing deleted items..
		return array_filter(
			$Items,
			[
				$this,
				'filterDeletedItem'
			]
		);
	}

	protected function filterDeletedItem( LedgerItem $Item )
	{
		return !$Item->getDeleted();
	}

	/**
	 * @param LedgerItem $Item
	 */
	protected function addOrRemoveLedgerItem( LedgerItem $Item )
	{
		if( $Item->getDeleted() )
		{
			// Delete..

			$this->deleteLedgerItem( $Item );
		}
		else
		{
			// Save

			$this->saveLedgerItem( $Item );
		}
	}

	/**
	 * @param LedgerItem $Item
	 */
	protected function deleteLedgerItem( LedgerItem $Item )
	{
		$this->_LedgerModel->findOrFail( $Item->getIdentifier() )->delete();
	}

	/**
	 * @param LedgerItem $Item
	 * @return LedgerItem
	 */
	protected function saveLedgerItem( LedgerItem $Item ) : LedgerItem
	{
		$Obj = $Item->toStdClass();

        $Obj->amount = CurrencyService::toInteger( $Obj->amount );

		if( $Item->getIdentifier() )
		{
			$this->_LedgerModel->whereId( $Item->getIdentifier() )->update( ( array)$Obj );
		}
		else
		{
			unset( $Obj->is_deleted );
			unset( $Obj->is_new );

			$Model = $this->_LedgerModel->create( ( array)$Obj );

			$Item->setIdentifier( $Model->id );
		}

		return $Item;
	}
}
