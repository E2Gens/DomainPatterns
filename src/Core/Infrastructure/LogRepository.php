<?php

namespace DDP\Core\Infrastructure;


use DDP\Core\Domain\Log;
use Neuron\Data\Object\DateRange;

class LogRepository implements ILogRepository
{
	private $_LogModel;

	public function __construct( \App\Log $LogModel )
	{
		$this->_LogModel = $LogModel;
	}

	/**
	 * @return \App\Log
	 */
	public function getLogModel(): \App\Log
	{
		return $this->_LogModel;
	}

	/**
	 * @param int $LogId
	 * @return Log
	 * @throws \Exception
	 */
	public function getById( int $LogId ) : Log
	{
		$Log = new Log();
		$Log
			->arrayMap(
				$this->getLogModel()
					->where( 'id', $LogId )
					->first()
					->toArray()
			);

		return $Log;
	}

	/**
	 * @param DateRange $Range
	 * @return array
	 * @throws \Exception
	 */
	public function getByDateRange( DateRange $Range ) : array
	{
		$Rows = $this->getLogModel()
			->whereBetween(
				[
					$Range->Start,
					$Range->End
				]
			)
			->get()
			->toArray();

		$Logs = [];

		foreach( $Rows as $Row )
		{
			$Log = new Log;
			$Log->arrayMap( $Row );
			$Logs[] = $Log;
		}

		return $Logs;
	}

	/**
	 * @param DateRange $Range
	 * @param int $Level
	 * @return array
	 * @throws \Exception
	 */
	public function getByDateRangeAndLevel( DateRange $Range, int $Level ) : array
	{
		$Rows = $this->getLogModel()
			->whereBetween(
				[
					$Range->Start,
					$Range->End
				]
			)
			->where( 'level', '=', $Level )
			->get()
			->toArray();

		$Logs = [];

		foreach( $Rows as $Row )
		{
			$Log = new Log;
			$Log->arrayMap( $Row );
			$Logs[] = $Log;
		}

		return $Logs;
	}
}
