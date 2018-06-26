<?php
namespace App\API;

use MenaraSolutions\Geographer\Earth;

class Location
{
	private $_Earth;

	public function construct()
	{
		$this->_Earth = new Earth();
	}

	public function getCountries()
	{
		return $this->_Earth->getCountries()->useShortNames();
	}
}
