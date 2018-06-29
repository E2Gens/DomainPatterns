<?php

namespace Tests\unit\API;

use PHPUnit\Framework\TestCase;
use \DDP\API\Location;

class LocationTest extends TestCase
{
	public function testGetStates()
	{
		$Location = new Location();

		$States = $Location->getStates( 'US' );

		$this->assertGreaterThan(
			1,
			count( $States )
		);
	}

	public function testGetCountries()
	{
		$Location = new Location();

		$Countries = $Location->getCountries()->toArray();

		$this->assertTrue(
			is_array( $Countries )
		);
	}
}
