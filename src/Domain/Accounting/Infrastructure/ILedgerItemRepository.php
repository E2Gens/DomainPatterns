<?php

namespace DDP\Domain\Accounting\Infrastructure;

use DDP\Domain\Accounting\Domain\Account;
use DDP\Domain\Accounting\Domain\LedgerItem;
use Neuron\Data\Object\DateRange;

interface ILedgerItemRepository
{
	/**
	 * @param int $AccountId
	 * @return Account
	 *
	 * @throws \Exception
	 */
	public function getAccountById( int $AccountId ): Account;

	/**
	 * @param string $Name
	 * @return Account
	 *
	 * @throws \Exception
	 */
	public function getAccountByName( string $Name ): Account;

	/**
	 * @param int $LedgerItemId
	 * @return LedgerItem
	 *
	 * @throws \Exception
	 */
	public function getById( int $LedgerItemId ): LedgerItem;

	/**
	 * @param DateRange $Range
	 * @return array
	 *
	 * @throws \Exception
	 */
	public function getByDateRange( DateRange $Range ): array;

	/**
	 * @param int $AccountId
	 * @param DateRange $Range
	 *
	 * @throws \Exception
	 */
	public function getByAccountAndDateRange( int $AccountId, DateRange $Range );
}
