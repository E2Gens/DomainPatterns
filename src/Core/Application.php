<?php

namespace DDP\Core;

use Neuron\Log\Destination\DestinationBase;
use Neuron\Log\Log;
use Neuron\Log\Logger;

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
	}
}
