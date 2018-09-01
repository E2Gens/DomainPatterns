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
	public function getCreatedAt() : ?string
	{
		return $this->_CreatedAt;
	}

	/**
	 * @param mixed $CreatedAt
	 */
	public function setCreatedAt( string $CreatedAt )
	{
		$this->_CreatedAt = $CreatedAt;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt() : ?string
	{
		return $this->_UpdatedAt;
	}

	/**
	 * @param mixed $UpdatedAt
	 */
	public function setUpdatedAt( string $UpdatedAt )
	{
		$this->_UpdatedAt = $UpdatedAt;
	}

	/**
	 * @return mixed
	 */
	public function getDeletedAt() : ?string
	{
		return $this->_DeletedAt;
	}

	/**
	 * @param mixed $DeletedAt
	 */
	public function setDeletedAt( string $DeletedAt )
	{
		$this->_DeletedAt = $DeletedAt;
	}
}
