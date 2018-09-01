<?php

use DDP\Core\Domain\EntityBase;
use PHPUnit\Framework\TestCase;

class EntityBaseTest extends TestCase
{
	public function testArrayMapPass()
	{
		$Entity = new EntityBase();

		$Data[ 'id' ] = 1;

		$Entity->arrayMap( $Data );

		$this->assertEquals(
			$Entity->getIdentifier(),
			1
		);
	}

	public function testArrayMapFail()
	{
		$Entity = new EntityBase();

		$Data[ 'id' ] = 'poop';

		$Result = true;

		try
		{
			$Entity->arrayMap( $Data );
		}
		catch( Exception $Exception )
		{
			$Result = false;
		}

		$this->assertFalse( $Result );
	}
}
