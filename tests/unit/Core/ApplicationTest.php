<?php

use DDP\Core\Application;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{
	public function testInit()
	{
		Application::init(
			new \Neuron\Log\Destination\Echoer(
				new \Neuron\Log\Format\PlainText() )
		);

		\Neuron\Log\Log::info('test' );

		$this->assertTrue( true );
	}
}
