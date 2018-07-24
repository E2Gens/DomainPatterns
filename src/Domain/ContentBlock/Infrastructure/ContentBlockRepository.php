<?php

namespace DDP\Domain\ContentBlock\Infrastructure;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\ContentBlock\Domain;

/**
 * Repository for ContentBlock
 *
 * Class ContentBlockRepository
 *
 * @package DDP\Domain\ContentBlock\Infrastructure
 */
class ContentBlockRepository implements IRepository
{
	private $_ContentBlockModel;

	/**
	 * ContentBlockRepository constructor.
	 * @param \App\ContentBlock $ContentBlockModel
	 */
	public function __construct( \App\ContentBlock $ContentBlockModel )
	{
		$this->_ContentBlockModel = $ContentBlockModel;
	}

	/**
	 * @param Domain\ContentBlock $ContentBlock
	 * @return mixed
	 */
	public function save( Domain\ContentBlock $ContentBlock )
	{
		$Obj = $ContentBlock->toStdClass();

		if( !$ContentBlock->getIdentifier() )
		{
			$ContentBlockModel = $this->_ContentBlockModel->create( (array)$Obj );
			$ContentBlock->setIdentifier( $ContentBlockModel->id );
		}
		else
		{
			$ContentBlockModel = $this->_ContentBlockModel->update( (array)$Obj );
		}

		return $ContentBlockModel;
	}

	/**
	 * @param int $ContentBlockId
	 * @return mixed
	 */
	public function getById( int $ContentBlockId )
	{
		return $this->_ContentBlockModel->findOrFail( $ContentBlockId );
	}

	/**
	 * @return array
	 */
	public function getAll(): array
	{
		return $this->_ContentBlockModel
			->orderBy( 'updated_at', 'DESC' )
			->get()
			->toArray();
	}
}
