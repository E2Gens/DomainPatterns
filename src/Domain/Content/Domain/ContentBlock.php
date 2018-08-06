<?php

namespace DDP\Domain\Content\Domain;

use DDP\Core\Domain\EntityBase;

class ContentBlock extends EntityBase
{
	private $_Name;
	private $_Content;
	private $_ModifiedBy;
	private $_CreatedAt;
	private $_UpdatedAt;

	/**
	 * @return null|string
	 */
	public function getName(): ?string
	{
		return $this->_Name;
	}

	/**
	 * @param $Name
	 */
	public function setName( $Name ): void
	{
		$this->_Name = $Name;
	}

	/**
	 * @return null|string
	 */
	public function getContent(): ?string
	{
		return $this->_Content;
	}

	/**
	 * @param mixed $Content
	 */
	public function setContent( $Content ): void
	{
		$this->_Content = $Content;
	}

	/**
	 * @return int|null
	 */
	public function getModifiedBy(): ?int
	{
		return $this->_ModifiedBy;
	}

	/**
	 * @param mixed $ModifiedBy
	 */
	public function setModifiedBy( $ModifiedBy ): void
	{
		$this->_ModifiedBy = $ModifiedBy;
	}

	/**
	 * @return null|string
	 */
	public function getCreatedAt(): ?string
	{
		return $this->_CreatedAt;
	}

	/**
	 * @param mixed $CreatedAt
	 */
	public function setCreatedAt( $CreatedAt ): void
	{
		$this->_CreatedAt = $CreatedAt;
	}

	/**
	 * @return null|string
	 */
	public function getUpdatedAt(): ?string
	{
		return $this->_UpdatedAt;
	}

	/**
	 * @param mixed $UpdatedAt
	 */
	public function setUpdatedAt( $UpdatedAt ): void
	{
		$this->_UpdatedAt = $UpdatedAt;
	}

	/**
	 * @param array $Data
	 * @return ContentBlock
	 */
	public static function fromArray( array $Data )
	{
		$ContentBlock = new static;

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
			$ContentBlock->setContent(  $Data[ 'content' ] );
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

		return $ContentBlock;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		$Obj->name        = $this->getName();
		$Obj->content     = $this->getContent();
		$Obj->modified_by = $this->getModifiedBy();
		$Obj->created_at  = $this->getCreatedAt();
		$Obj->updated_at  = $this->getUpdatedAt();

		return $Obj;
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
