<?php

namespace DDP\Core;

use DDP\Core\Infrastructure\DbLogDestination;
use Neuron\Log\Format\PlainText;
use Neuron\Log\Log;

class Application
{
	public static function init()
	{
		$Log = Log::getInstance();

		// Remove default logger

		$Log->Logger->reset();

		// Add database logger

		$Log->Logger->addLog(
			new DbLogDestination(
				new PlainText(),
				new \App\Log )
		);

		// Stuff it back into the singleton

		$Log->serialize();
	}
}
