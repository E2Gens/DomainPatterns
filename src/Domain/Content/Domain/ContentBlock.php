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
	 * @return $this
	 */
	public function setName( $Name )
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
	 * @param mixed $Content
	 * @return $this
	 */
	public function setContent( $Content )
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
	 * @param mixed $ModifiedBy
	 * @return $this
	 */
	public function setModifiedBy( $ModifiedBy )
	{
		$this->_ModifiedBy = $ModifiedBy;
		return $this;
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
	 * @return $this
	 */
	public function setCreatedAt( $CreatedAt )
	{
		$this->_CreatedAt = $CreatedAt;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getUpdatedAt(): ?string
	{
		return $this->_UpdatedAt;
	}

	/**
	 * @param $UpdatedAt
	 * @return $this
	 */
	public function setUpdatedAt( $UpdatedAt )
	{
		$this->_UpdatedAt = $UpdatedAt;
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
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getName() )
		{
			$Obj->name = $this->getName();
		}

		if( $this->getContent() )
		{
			$Obj->content = $this->getContent();
		}

		if( $this->getModifiedBy() )
		{
			$Obj->modified_by = $this->getModifiedBy();
		}

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
