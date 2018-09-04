<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 9/4/18
 * Time: 8:10 AM
 */

namespace DDP\Core\Infrastructure;

use DDP\Core\Domain\Log;
use Neuron\Data\Object\DateRange;

interface ILogRepository
{
	/**
	 * @return \App\Log
	 */
	public function getLogModel(): \App\Log;

	/**
	 * @param int $LogId
	 * @return Log
	 * @throws \Exception
	 */
	public function getById( int $LogId ): Log;

	/**
	 * @param DateRange $Range
	 * @return array
	 * @throws \Exception
	 */
	public function getByDateRange( DateRange $Range ): array;

	/**
	 * @param DateRange $Range
	 * @param int $Level
	 * @return array
	 * @throws \Exception
	 */
	public function getByDateRangeAndLevel( DateRange $Range, int $Level ): array;
}
