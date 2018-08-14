<?php

namespace Tests\unit\Domain\Content\Domain;

use DDP\Domain\Content\Domain\ContentBlock;
use PHPUnit\Framework\TestCase;

class ContentBlockTest extends TestCase
{
	public function testFromArray()
	{
		$Entity = new ContentBlock();

		$Arr[ 'id' ]          = 1;
		$Arr[ 'name' ]        = 6;
		$Arr[ 'content' ]     = 2;
		$Arr[ 'modified_by' ] = 3;
		$Arr[ 'created_at' ]  = 4;
		$Arr[ 'updated_at' ]  = 5;
		$Arr[ 'deleted_at' ]  = 7;

		ContentBlock::fromArray( $Entity, $Arr );

		$this->assertEquals(
			$Entity->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$Entity->getName(),
			$Arr[ 'name' ]
		);

		$this->assertEquals(
			$Entity->getContent(),
			$Arr[ 'content' ]
		);

		$this->assertEquals(
			$Entity->getModifiedBy(),
			$Arr[ 'modified_by' ]
		);

		$this->assertEquals(
			$Entity->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$Entity->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$Entity->getDeletedAt(),
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
