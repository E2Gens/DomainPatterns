<?php

namespace DDP\Core\Domain;

use Neuron\Data\Formatter;
use Neuron\Patterns\Registry;

class FormatterService
{
	const DATE_TIME = 'config.format.dateTime';
	const DATE      = 'config.format.date';
	const TIME      = 'config.format.time';

	/**
	 * @param string $DateTime
	 * @return mixed
	 */
	public static function dateTime( string $DateTime )
	{
		return Formatter::dateTime(
			$DateTime,
			Registry::getInstance()->get( self::DATE_TIME )
		);
	}

	/**
	 * @param string $Date
	 * @return false|string
	 */
	public static function date( string $Date )
	{
		return Formatter::dateOnly(
			$Date,
			Registry::getInstance()->get( self::DATE )
		);
	}

	/**
	 * @param string $Time
	 * @return false|string
	 */
	public static function time( string $Time )
	{
		return Formatter::timeOnly(
			$Time,
			Registry::getInstance()->get( self::TIME )
		);
	}
}
