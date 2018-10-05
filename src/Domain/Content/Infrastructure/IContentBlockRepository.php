<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 8/30/18
 * Time: 2:51 PM
 */

namespace DDP\Domain\Content\Infrastructure;


use DDP\Domain\Content\Domain;

/**
 * Repository for ContentBlock
 *
 * Class ContentBlockRepository
 *
 * @package DDP\Domain\ContentBlock\Infrastructure
 */
interface IContentBlockRepository
{
	/**
	 * @param $ContentBlock
	 * @return Domain\ContentBlock
	 */
	public function save( Domain\ContentBlock $ContentBlock ): Domain\ContentBlock;

	/**
	 * @param $ContentBlockId
	 * @return Domain\ContentBlock
	 */
	public function getById( $ContentBlockId ): Domain\ContentBlock;

	/**
	 * @return array
	 */
	public function getAll(): array;

	/**
	 * @param string $Name
	 * @return Domain\ContentBlock
	 */
	public function getByName( string $Name ): Domain\ContentBlock;
}
