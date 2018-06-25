<?php

namespace DDP\Domain\User\Domain;

use DDP\Core\Domain\EntityBase;

class RoleUser extends EntityBase
{
	private $_User;
	private $_Role;
	private $_Name;

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->_User;
	}

	/**
	 * @param mixed $User
	 */
	public function setUser( $User ): void
	{
		$this->_User = $User;
	}

	/**
	 * @return mixed
	 */
	public function getRole() : Role
	{
		return $this->_Role;
	}

	/**
	 * @param mixed $Role
	 */
	public function setRole( Role $Role ): void
	{
		$this->_Role = $Role;
	}

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
