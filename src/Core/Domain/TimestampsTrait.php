<?php

namespace DDP\Core\Domain;

trait TimestampsTrait
{
	private $_CreatedAt;
	private $_UpdatedAt;
	private $_DeletedAt;

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
	public function setCreatedAt( $CreatedAt )
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
	public function setUpdatedAt( $UpdatedAt )
	{
		$this->_UpdatedAt = $UpdatedAt;
	}

	/**
	 * @return mixed
	 */
	public function getDeletedAt()
	{
		return $this->_DeletedAt;
	}

	/**
	 * @param mixed $DeletedAt
	 */
	public function setDeletedAt( $DeletedAt )
	{
		$this->_DeletedAt = $DeletedAt;
	}
}
