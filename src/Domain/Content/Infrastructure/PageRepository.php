<?php

namespace DDP\Domain\Content\Infrastructure;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\Content\Domain;

class PageRepository implements IPageRepository
{
	private $_PageModel;

	/**
	 * PageRepository constructor.
	 * @param \App\Page $PageModel
	 */
	public function __construct( \App\Page $PageModel )
	{
		$this->_PageModel = $PageModel;
	}

	/**
	 * @param $Page
	 * @return mixed
	 */
	public function save( $Page )
	{
		$Obj = $Page->toStdClass();

		if( !$Page->getIdentifier() )
		{
			$PageModel = $this->_PageModel->create( (array)$Obj );
		}
		else
		{
			$PageModel = $this->_PageModel->where( 'id', $Obj->id )->update( (array)$Obj );
		}

		return $PageModel;
	}

	/**
	 * @param $PageId
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getById( $PageId )
	{
		$PageObj = $this->_PageModel
			->with( 'contentBlock' )
			->where( 'id', $PageId )
			->first()
			->toArray();

		return Domain\Page::fromArray( $PageObj );
	}

	/**
	 * @param string $Route
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getByRoute( string $Route )
	{
		$PageObj = $this->_PageModel
			->with( 'contentBlock' )
			->where( 'route', $Route )
			->firstOrFail();

		return Domain\Page::fromArray( $PageObj->toArray() );
	}

	/**
	 * @return array
	 */
	public function getAll(): array
	{
		$Pages = [];

		$PagesObj = $this->_PageModel
			->with( 'contentBlock' )
			->orderBy( 'updated_at', 'DESC' )
			->get()
			->toArray();

		foreach( $PagesObj as $Page )
		{
			$Pages[] = Domain\Page::fromArray( $Page );
		}

		return $Pages;
	}
}
