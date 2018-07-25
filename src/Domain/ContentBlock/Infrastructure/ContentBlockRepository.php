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
	 * @param $ContentBlock
	 * @return mixed
	 */
	public function save( $ContentBlock )
	{
		$Obj = $ContentBlock->toStdClass();

		if( !$ContentBlock->getIdentifier() )
		{
			$ContentBlockModel = $this->_ContentBlockModel->create( (array)$Obj );
		}
		else
		{
			$ContentBlockModel = $this->_ContentBlockModel->where( 'id', $Obj->id )->update( (array)$Obj );
		}

		return $ContentBlockModel;
	}

	/**
	 * @param $ContentBlockId
	 * @return mixed
	 */
	public function getById( $ContentBlockId )
	{
		$ContentBlockArr = $this->_ContentBlockModel->findOrFail( $ContentBlockId )->toArray();

		return Domain\ContentBlock::fromArray( $ContentBlockArr );
	}

	/**
	 * @return array
	 */
	public function getAll(): array
	{
		$ContentBlocks = [];

		$ContentBlocksArr = $this->_ContentBlockModel
			->orderBy( 'updated_at', 'DESC' )
			->get()
			->toArray();

		foreach ( $ContentBlocksArr as $ContentBlock )
		{
			$ContentBlocks[] = Domain\ContentBlock::fromArray( $ContentBlock );
 		}

 		return $ContentBlocks;
	}
}
