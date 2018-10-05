<?php

namespace DDP\Domain\Content\Infrastructure;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\Content\Domain;

/**
 * Repository for ContentBlock
 *
 * Class ContentBlockRepository
 *
 * @package DDP\Domain\ContentBlock\Infrastructure
 */
class ContentBlockRepository implements IContentBlockRepository
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
	 * @return Domain\ContentBlock
	 */
	public function save( Domain\ContentBlock $ContentBlock ) : Domain\ContentBlock
	{
		$Obj = $ContentBlock->toStdClass();

		if( !$ContentBlock->getIdentifier() )
		{
			$this->_ContentBlockModel->create( (array)$Obj );
		}
		else
		{
			$this->_ContentBlockModel->where( 'id', $Obj->id )->update( (array)$Obj );
		}

		return $ContentBlock;
	}

	/**
	 * @param $ContentBlockId
	 * @return Domain\ContentBlock
	 */
	public function getById( $ContentBlockId ) : Domain\ContentBlock
	{
		$ContentBlockArr = $this->_ContentBlockModel->findOrFail( $ContentBlockId )->toArray();

		$ContentBlock = new Domain\ContentBlock();
		Domain\ContentBlock::fromArray( $ContentBlock, $ContentBlockArr );

		return $ContentBlock;
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
			$Block = new Domain\ContentBlock();

			Domain\ContentBlock::fromArray( $Block, $ContentBlock );

			$ContentBlocks[] = $Block;
 		}

 		return $ContentBlocks;
	}

	/**
	 * @param string $Name
	 * @return Domain\ContentBlock
	 */
	public function getByName( string $Name ) : Domain\ContentBlock
	{
		$PageObj = $this->_ContentBlockModel
			->with( 'page' )
			->where( 'name', $Name )
			->firstOrFail();

		$Block = new Domain\ContentBlock();
		Domain\ContentBlock::fromArray( $Block, $PageObj->toArray() );

		return $Block;
	}
}
