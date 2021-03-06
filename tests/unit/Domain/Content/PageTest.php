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
		$Arr[ 'route' ]            = 'Some route';
		$Arr[ 'title' ]            = 'Some title';
		$Arr[ 'meta_description' ] = 'Some meta description';
		$Arr[ 'meta_keywords' ]    = 'Some keywords';
		$Arr[ 'content_block_id' ] = 7;
		$Arr[ 'modified_by' ]      = 11;

		$Arr[ 'created_at' ]  = '2018-01-01 00:00:00';
		$Arr[ 'updated_at' ]  = '2018-02-01 00:00:00';
		$Arr[ 'deleted_at' ]  = '2018-02-01 00:00:00';

		$Arr[ 'content' ] = 'Some content';

		$Page->arrayMap( $Arr );

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

		$Arr[ 'id' ]               = 1;
		$Arr[ 'route' ]            = 'Some route';
		$Arr[ 'title' ]            = 'Some title';
		$Arr[ 'meta_description' ] = 'Some meta description';
		$Arr[ 'meta_keywords' ]    = 'Some keywords';
		$Arr[ 'content' ]          = 'Some content';
		$Arr[ 'content_block_id' ] = 7;
		$Arr[ 'modified_by' ]      = 11;

		$Page->arrayMap( $Arr );

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
