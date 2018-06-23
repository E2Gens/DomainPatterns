<?php

namespace DDP\Domain\User\Domain;

use DDP\Core\Domain\EntityBase;

class Role extends EntityBase
{
	private $_Name;

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
}
