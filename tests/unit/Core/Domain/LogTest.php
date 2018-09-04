<?php

use DDP\Core\Domain\Log;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
	public function testMapper()
	{
		$Data = [
			'id' => 1,
			'datetime' => '2018-01-01 12:13:14',
			'text' => 'Test log'
		];

		$Log = new Log();

		$Log->arrayMap( $Data );

		$this->assertEquals(
			$Log->getIdentifier(),
			$Data[ 'id' ]
		);

		$this->assertEquals(
			$Log->getText(),
			$Data[ 'text' ]
		);

		$this->assertEquals(
			$Log->getDateTime(),
			$Data[ 'datetime' ]
		);

	}
}
