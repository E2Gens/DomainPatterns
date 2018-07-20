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

	public function testCountriesOrderByName()
	{
		$Location = new Location();

		$Countries = $Location->getCountries();

		$this->assertEquals($Countries->pluck('name'), $Countries->sortBy('name')->pluck('name'),
			'The Countries are not being ordered by Name');
	}

	public function testStatesOrderByName()
	{
		$Location = new Location();

		$OrderedStates = $this->orderedStateList();

		$States = $Location->getStates('US', 'name');

		$i = 0;

		foreach( $States as $State)
		{
			$this->assertEquals($State['name'], $OrderedStates[$i]['name'], 'The States are not ordered by Name.');

			$i++;
		}
	}

	private function orderedStateList()
	{
		$states = array(
			[ 'code' =>  'AL', 'name' => 'Alabama'],
			[ 'code' =>  'AK', 'name' => 'Alaska'],
			[ 'code' =>  'AZ', 'name' => 'Arizona'],
			[ 'code' =>  'AR', 'name' => 'Arkansas'],
			[ 'code' =>  'CA', 'name' => 'California'],
			[ 'code' =>  'CO', 'name' => 'Colorado'],
			[ 'code' =>  'CT', 'name' => 'Connecticut'],
			[ 'code' =>  'DE', 'name' => 'Delaware'],
			[ 'code' =>  'FL', 'name' => 'Florida'],
			[ 'code' =>  'GA', 'name' => 'Georgia'],
			[ 'code' =>  'HI', 'name' => 'Hawaii'],
			[ 'code' =>  'ID', 'name' => 'Idaho'],
			[ 'code' =>  'IL', 'name' => 'Illinois'],
			[ 'code' =>  'IN', 'name' => 'Indiana'],
			[ 'code' =>  'IA', 'name' => 'Iowa'],
			[ 'code' =>  'KS', 'name' => 'Kansas'],
			[ 'code' =>  'KY', 'name' => 'Kentucky'],
			[ 'code' =>  'LA', 'name' => 'Louisiana'],
			[ 'code' =>  'ME', 'name' => 'Maine'],
			[ 'code' =>  'MD', 'name' => 'Maryland'],
			[ 'code' =>  'MA', 'name' => 'Massachusetts'],
			[ 'code' =>  'MI', 'name' => 'Michigan'],
			[ 'code' =>  'MN', 'name' => 'Minnesota'],
			[ 'code' =>  'MS', 'name' => 'Mississippi'],
			[ 'code' =>  'MO', 'name' => 'Missouri'],
			[ 'code' =>  'MT', 'name' => 'Montana'],
			[ 'code' =>  'NE', 'name' => 'Nebraska'],
			[ 'code' =>  'NV', 'name' => 'Nevada'],
			[ 'code' =>  'NH', 'name' => 'New Hampshire'],
			[ 'code' =>  'NJ', 'name' => 'New Jersey'],
			[ 'code' =>  'NM', 'name' => 'New Mexico'],
			[ 'code' =>  'NY', 'name' => 'New York'],
			[ 'code' =>  'NC', 'name' => 'North Carolina'],
			[ 'code' =>  'ND', 'name' => 'North Dakota'],
			[ 'code' =>  'OH', 'name' => 'Ohio'],
			[ 'code' =>  'OK', 'name' => 'Oklahoma'],
			[ 'code' =>  'OR', 'name' => 'Oregon'],
			[ 'code' =>  'PA', 'name' => 'Pennsylvania'],
			[ 'code' =>  'RI', 'name' => 'Rhode Island'],
			[ 'code' =>  'SC', 'name' => 'South Carolina'],
			[ 'code' =>  'SD', 'name' => 'South Dakota'],
			[ 'code' =>  'TN', 'name' => 'Tennessee'],
			[ 'code' =>  'TX', 'name' => 'Texas'],
			[ 'code' =>  'UT', 'name' => 'Utah'],
			[ 'code' =>  'VT', 'name' => 'Vermont'],
			[ 'code' =>  'VA', 'name' => 'Virginia'],
			[ 'code' =>  'WA', 'name' => 'Washington'],
			[ 'code' =>  'DC', 'name' => 'Washington, D.C.'],
			[ 'code' =>  'WV', 'name' => 'West Virginia'],
			[ 'code' =>  'WI', 'name' => 'Wisconsin'],
			[ 'code' =>  'WY', 'name' => 'Wyoming']
		);

		return $states;
	}
}
