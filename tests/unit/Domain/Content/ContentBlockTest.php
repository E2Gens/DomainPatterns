<?php

namespace Tests\unit\Domain\Content\Domain;

use DDP\Domain\Content\Domain\ContentBlock;
use PHPUnit\Framework\TestCase;

class ContentBlockTest extends TestCase
{
	public function testFromArray()
	{
		$ContentBlock = new ContentBlock();

		$Arr[ 'id' ]          = 1;
		$Arr[ 'name' ]        = 6;
		$Arr[ 'content' ]     = 2;
		$Arr[ 'modified_by' ] = 3;
		$Arr[ 'created_at' ]  = '2018-01-01';
		$Arr[ 'updated_at' ]  = '2018-02-01';
		$Arr[ 'deleted_at' ]  = '0000-00-00';

		$ContentBlock->arrayMap( $Arr );

		$this->assertEquals(
			$ContentBlock->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$ContentBlock->getName(),
			$Arr[ 'name' ]
		);

		$this->assertEquals(
			$ContentBlock->getContent(),
			$Arr[ 'content' ]
		);

		$this->assertEquals(
			$ContentBlock->getModifiedBy(),
			$Arr[ 'modified_by' ]
		);

		$this->assertEquals(
			$ContentBlock->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$ContentBlock->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$ContentBlock->getDeletedAt(),
			$Arr[ 'deleted_at' ]
		);
	}

	public function testToStdClass()
	{
		$ContentBlock = new ContentBlock();

		$ContentBlock->setIdentifier( 1 );
		$ContentBlock->setName( 2 );
		$ContentBlock->setContent( 3 );
		$ContentBlock->setModifiedBy( 4 );

		$Obj = $ContentBlock->toStdClass();

		$this->assertEquals(
			$ContentBlock->getIdentifier(),
			$Obj->id
		);

		$this->assertEquals(
			$ContentBlock->getName(),
			$Obj->name
		);

		$this->assertEquals(
			$ContentBlock->getContent(),
			$Obj->content
		);

		$this->assertEquals(
			$ContentBlock->getModifiedBy(),
			$Obj->modified_by
		);
	}
}
