<?php

use DDP\Core\Domain\FormatterService;
use PHPUnit\Framework\TestCase;
use Neuron\Patterns\Registry;

class FormatterServiceTest extends TestCase
{
	protected function setUp()
	{
		parent::setUp();

		Registry::getInstance()->set( FormatterService::DATE_TIME, 'm/d/Y g:i a' );
		Registry::getInstance()->set( FormatterService::DATE,      'm/d/Y' );
		Registry::getInstance()->set( FormatterService::TIME,      'g:i a' );
	}

	public function testTime()
	{
		$this->assertEquals(
			'1:30 pm',
			FormatterService::time( '13:30' )
		);
	}

	public function testDateTime()
	{
		$this->assertEquals(
			'12/24/2018 1:30 pm',
			FormatterService::dateTime( '2018-12-24 13:30' )
		);
	}

	public function testDate()
	{
		$this->assertEquals(
			'12/24/2018',
			FormatterService::date( '2018-12-24' )
		);
	}
}
