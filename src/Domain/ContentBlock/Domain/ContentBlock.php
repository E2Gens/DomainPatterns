<?php

namespace DDP\Domain\ContentBlock\Domain;

use DDP\Core\Domain\EntityBase;

class ContentBlock extends EntityBase
{
	private $_Name;
	private $_Content;
	private $_CreatedAt;
	private $_UpdatedAt;
	private $_ModifiedBy;

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->_Name;
	}

	/**
	 * @param mixed $Name
	 */
	public function setName( $Name ): void
	{
		$this->_Name = $Name;
	}

	/**
	 * @return mixed
	 */
	public function getContent()
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
	 * @return mixed
	 */
	public function getCreatedAt()
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
	 * @return mixed
	 */
	public function getUpdatedAt()
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
	 * @return mixed
	 */
	public function getModifiedBy()
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


}
