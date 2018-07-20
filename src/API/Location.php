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
	 * @param string $SortBy
	 * @return mixed
	 */
	public function getCountries( $SortBy = 'name' )
	{
		return $this->_Earth->getCountries()->sortBy( $SortBy )->useShortNames();
	}

	/**
	 * @param $Name
	 * @param string $SortBy
	 * @return bool
	 */
	public function getStates( $Name, $SortBy = 'name' )
	{
		$Country = $this->_Earth->getCountries()->findOne( ['code' => $Name] );

		if( !$Country )
		{
			return false;
		}

		return $Country->getStates()->sortBy( $SortBy )->toArray();
	}
}
