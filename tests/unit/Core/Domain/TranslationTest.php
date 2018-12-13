<?php

use DDP\Core\Domain\Translation;
use PHPUnit\Framework\TestCase;

class TranslationTest extends TestCase
{

	public function testSetText()
	{
		$Translation = new Translation();

		$Translation->setText( 'test' );

		$this->assertEquals(
			'test',
			$Translation->getText()
		);
	}

	public function testSetLanguageId()
	{
		$Translation = new Translation();

		$Translation->setLanguageId( '1' );

		$this->assertEquals(
			'1',
			$Translation->getLanguageId()
		);
	}

	public function testSetTag()
	{
		$Translation = new Translation();

		$Translation->setTag( 'test' );

		$this->assertEquals(
			'test',
			$Translation->getTag()
		);

	}

	public function testHydrate()
	{
		$Translation = new Translation();

		$Translation->arrayMap(
			[
				'text'        => 'test',
				'language_id' => '1',
				'tag'         => 'test1'
			]
		);

		$this->assertEquals(
			'test',
			$Translation->getText()
		);

		$this->assertEquals(
			'1',
			$Translation->getLanguageId()
		);

		$this->assertEquals(
			'test1',
			$Translation->getTag()
		);

	}
}
