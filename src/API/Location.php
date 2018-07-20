<?php
namespace DDP\API;

use MenaraSolutions\Geographer\Earth;

/**
 * Encapsulates location information.
 * @package App\API
 */
class Location
{
	private $_Earth;

	/**
	 * Location constructor.
	 */
	public function __construct()
	{
		$this->_Earth = new Earth();
	}

	/**
	 * @return \MenaraSolutions\Geographer\Collections\MemberCollection
	 */
	public function getCountries()
	{
		return $this->_Earth->getCountries()->useShortNames();
	}

	/**
	 * @param $Name - Short name of the country.
	 * @return array
	 */
	public function getStates( $Name )
	{
		$Country = $this->_Earth->getCountries()->findOne( ['code' => $Name] );

		if( !$Country )
		{
			return false;
		}

		return $Country->getStates()->sortBy('name')->toArray();
	}
}
