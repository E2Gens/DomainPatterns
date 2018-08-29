<?php

namespace DDP\Core;

use Neuron\Log\Destination\DestinationBase;
use Neuron\Log\Log;
use Neuron\Log\Logger;
use Neuron\Patterns\Registry;
use DDP\API\ValidationRegistry;

class Application
{
	public static function init( DestinationBase $Destination )
	{
		$Log = Log::getInstance();

		$Log->initIfNeeded();

		// Remove default logger

		$Log->Logger->reset();

		// Add database logger

		$Log->Logger->addLog(
			new Logger(
				$Destination
			)
		);

		// Stuff it back into the singleton

		$Log->serialize();

		Registry::getInstance()
			->set(
				'Validator',
				new ValidationRegistry()
			);
	}

	/**
	 * @param string $Class
	 * @param $Entity
	 */
	public static function registerValidator( string $Class, $Entity )
	{
		Registry::getInstance()
			->get( 'Validator' )
			->register(
				$Class,
				$Entity
			);
	}

	/**
	 * @param $Entity
	 * @param array $Violations
	 * @return mixed
	 */
	public static function validate( $Entity, array $Violations )
	{
		return Registry::getInstance()
			->get( 'Validator' )
			->validate( $Entity, $Violations );
	}
}
