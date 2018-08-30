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
	 * @param Domain\Page $Page
	 * @return Domain\Page
	 */
	public function save( Domain\Page $Page ) : Domain\Page
	{
		$Obj = $Page->toStdClass();

		if( !$Page->getIdentifier() )
		{
			$PageModel = $this->_PageModel->create( (array)$Obj );
			$Page->setIdentifier( $PageModel->id );
		}
		else
		{
			$this->_PageModel->where( 'id', $Obj->id )->update( (array)$Obj );
		}

		return $Page;
	}

	/**
	 * @param $PageId
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getById( $PageId ) : Domain\Page
	{
		$PageObj = $this->_PageModel
			->with( 'contentBlock' )
			->where( 'id', $PageId )
			->first()
			->toArray();

		$Page = new Domain\Page();

		Domain\Page::fromArray( $Page, $PageObj );

		return $Page;
	}

	/**
	 * @param string $Route
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getByRoute( string $Route ) : Domain\Page
	{
		$PageObj = $this->_PageModel
			->with( 'contentBlock' )
			->where( 'route', $Route )
			->firstOrFail();

		$Page = new Domain\Page();

		Domain\Page::fromArray( $Page, $PageObj->toArray() );

		return $Page;
	}

	/**
	 * @return array
	 */
	public function getAll(): array
	{
		$Pages = [];

		$PageObjs = $this->_PageModel
			->with( 'contentBlock' )
			->orderBy( 'updated_at', 'DESC' )
			->get()
			->toArray();

		foreach( $PageObjs as $PageObj )
		{
			$Page = new Domain\Page();

			Domain\Page::fromArray( $Page, $PageObj->toArray() );

			$Pages[] = $Page;
		}

		return $Pages;
	}
}
