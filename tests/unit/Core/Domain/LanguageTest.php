<?php

use DDP\Core\Domain\Language;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
	public function testSetName()
	{
		$Language = new Language();

		$Language->setName( 'test' );

		$this->assertEquals(
			'test',
			$Language->getName()
		);
	}

	public function testHydrate()
	{
		$Language = new Language();

		$Language->arrayMap(
			[
				'name' => 'test'
			]
		);

		$this->assertEquals(
			'test',
			$Language->getName()
		);
	}
}
