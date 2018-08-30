<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/30/18
 * Time: 2:59 PM
 */

namespace DDP\Domain\Content\Infrastructure;

use DDP\Domain\Content\Domain;

interface IPageRepository
{
	/**
	 * @param Domain\Page $Page
	 * @return Domain\Page
	 */
	public function save( Domain\Page $Page ): Domain\Page;

	/**
	 * @param $PageId
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getById( $PageId ): Domain\Page;

	/**
	 * @param string $Route
	 * @return \DDP\Core\Domain\EntityBase|Domain\Page
	 */
	public function getByRoute( string $Route ): Domain\Page;

	/**
	 * @return array
	 */
	public function getAll(): array;
}
