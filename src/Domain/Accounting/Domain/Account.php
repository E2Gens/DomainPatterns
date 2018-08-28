<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;

class Account extends EntityBase
{
	private $_Name;

	/**
	 * @return mixed
	 */
	public function getName() : string
	{
		return $this->_Name;
	}

	/**
	 * @param mixed $Name
	 * @return Account
	 */
	public function setName( string $Name )
	{
		$this->_Name = $Name;
		return $this;
	}
}
