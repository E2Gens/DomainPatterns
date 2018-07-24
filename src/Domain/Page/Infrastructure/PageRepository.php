<?php

namespace DDP\Domain\Page\Infrastructure;

use DDP\Core\Infrastructure\IRepository;

class PageRepository implements IRepository
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
	 * @param $Object
	 * @SuppressWarnings("unused")
	 */
	public function save( $Object )
	{
		// TODO: Implement save() method.
	}

	/**
	 * @param $Id
	 * @SuppressWarnings("unused")
	 */
	public function getById( $Id )
	{
		// TODO: Implement getById() method.
	}

	/**
	 * @param $Name
	 * @SuppressWarnings("unused")
	 */
	public function getByName( $Name )
	{
		// TODO: Implement getByName() method.
	}
}
