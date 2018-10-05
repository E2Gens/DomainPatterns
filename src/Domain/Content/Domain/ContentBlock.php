<?php

namespace DDP\Domain\Content\Domain;

use DDP\Core\Domain\EntityBase;
use DDP\Core\Domain\TimestampsTrait;
use Neuron\Data\Validation\Integer;
use Neuron\Data\Validation\StringData;

class ContentBlock extends EntityBase
{
	use TimestampsTrait;

	private $_Name;
	private $_Content;
	private $_ModifiedBy;

	/**
	 * ContentBlock constructor.
	 */
	public function __construct()
	{
		$this->addMap( 'Name', 'name', new StringData() );
		$this->addMap( 'Content', 'content', new StringData() );
		$this->addMap( 'ModifiedBy', 'modified_by', new Integer() );
	}

	/**
	 * @return null|string
	 */
	public function getName(): ?string
	{
		return $this->_Name;
	}

	/**
	 * @param string $Name
	 * @return $this
	 */
	public function setName( ?string $Name )
	{
		$this->_Name = $Name;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getContent(): ?string
	{
		return $this->_Content;
	}

	/**
	 * @param string $Content
	 * @return $this
	 */
	public function setContent( ?string $Content )
	{
		$this->_Content = $Content;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getModifiedBy(): ?int
	{
		return $this->_ModifiedBy;
	}

	/**
	 * @param int $ModifiedBy
	 * @return $this
	 */
	public function setModifiedBy( ?int $ModifiedBy )
	{
		$this->_ModifiedBy = $ModifiedBy;
		return $this;
	}

	/**
	 * @param $ContentBlock
	 * @param array $Data
	 */
	public static function fromArray( &$ContentBlock, array $Data ): void
	{
		if( isset( $Data[ 'id' ] ) )
		{
			$ContentBlock->setIdentifier( $Data[ 'id' ] );
		}

		if( isset( $Data[ 'name' ] ) )
		{
			$ContentBlock->setName( $Data[ 'name' ] );
		}

		if( isset( $Data[ 'content' ] ) )
		{
			$ContentBlock->setContent( $Data[ 'content' ] );
		}

		if( isset( $Data[ 'modified_by' ] ) )
		{
			$ContentBlock->setModifiedBy( $Data[ 'modified_by' ] );
		}

		if( isset( $Data[ 'created_at' ] ) )
		{
			$ContentBlock->setCreatedAt( $Data[ 'created_at' ] );
		}

		if( isset( $Data[ 'updated_at' ] ) )
		{
			$ContentBlock->setUpdatedAt( $Data[ 'updated_at' ] );
		}

		if( isset( $Data[ 'deleted_at' ] ) )
		{
			$ContentBlock->setDeletedAt( $Data[ 'deleted_at' ] );
		}
	}

	/**
	 * @return object
	 */
	public function jsonSerialize()
	{
		$this->_Id = $this->getIdentifier();

		return (object)get_object_vars($this);
	}
}
