<?php

namespace Tests\unit\Domain\Content\Domain;

use DDP\Domain\Content\Domain\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
	public function testFromArray()
	{
		$Page = new Page();

		$Arr[ 'id' ]               = 1;
		$Arr[ 'route' ]            = 2;
		$Arr[ 'title' ]            = 3;
		$Arr[ 'meta_description' ] = 4;
		$Arr[ 'meta_keywords' ]    = 5;
		$Arr[ 'content' ]          = 6;
		$Arr[ 'content_block_id' ] = 7;
		$Arr[ 'modified_by' ]      = 11;
		$Arr[ 'created_at' ]       = 10;
		$Arr[ 'updated_at' ]       = 8;
		$Arr[ 'deleted_at' ]       = 9;

		Page::fromArray( $Page, $Arr );

		$this->assertEquals(
			$Page->getIdentifier(),
			$Arr[ 'id' ]
		);

		$this->assertEquals(
			$Page->getRoute(),
			$Arr[ 'route' ]
		);

		$this->assertEquals(
			$Page->getTitle(),
			$Arr[ 'title' ]
		);

		$this->assertEquals(
			$Page->getContent(),
			$Arr[ 'content' ]
		);

		$this->assertEquals(
			$Page->getMetaDescription(),
			$Arr[ 'meta_description' ]
		);

		$this->assertEquals(
			$Page->getMetaKeywords(),
			$Arr[ 'meta_keywords' ]
		);

		$this->assertEquals(
			$Page->getContentBlockId(),
			$Arr[ 'content_block_id' ]
		);

		$this->assertEquals(
			$Page->getModifiedBy(),
			$Arr[ 'modified_by' ]
		);

		$this->assertEquals(
			$Page->getCreatedAt(),
			$Arr[ 'created_at' ]
		);

		$this->assertEquals(
			$Page->getUpdatedAt(),
			$Arr[ 'updated_at' ]
		);

		$this->assertEquals(
			$Page->getDeletedAt(),
			$Arr[ 'deleted_at' ]
		);
	}

	public function testToStdClass()
	{
		$Page = new Page();

		$Page->setIdentifier( 1 );
		$Page->setRoute( 2 );
		$Page->setTitle( 3 );
		$Page->setContent( 4 );
		$Page->setMetaDescription( 5 );
		$Page->setMetaKeywords( 6 );
		$Page->setContentBlockId( 7 );
		$Page->setModifiedBy( 8 );

		$Obj = $Page->toStdClass();

		$this->assertEquals(
			$Page->getIdentifier(),
			$Obj->id
		);

		$this->assertEquals(
			$Page->getRoute(),
			$Obj->route
		);

		$this->assertEquals(
			$Page->getTitle(),
			$Obj->title
		);

		$this->assertEquals(
			$Page->getContent(),
			$Obj->content
		);

		$this->assertEquals(
			$Page->getMetaDescription(),
			$Obj->meta_description
		);

		$this->assertEquals(
			$Page->getMetaKeywords(),
			$Obj->meta_keywords
		);

		$this->assertEquals(
			$Page->getContentBlockId(),
			$Obj->content_block_id
		);

		$this->assertEquals(
			$Page->getModifiedBy(),
			$Obj->modified_by
		);
	}
}
