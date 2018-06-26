<?php

namespace DDP\Domain\User\Domain;

class UserWithRoles extends User
{
	private $_Phone;
	private $_Address;
	private $_Photo;
	private $_Roles;

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->_Phone;
	}

	/**
	 * @param mixed $Phone
	 */
	public function setPhone( $Phone ): void
	{
		$this->_Phone = $Phone;
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->_Address;
	}

	/**
	 * @param mixed $Address
	 */
	public function setAddress( $Address ): void
	{
		$this->_Address = $Address;
	}

	/**
	 * @return mixed
	 */
	public function getPhoto()
	{
		return $this->_Photo;
	}

	/**
	 * @param mixed $Photo
	 */
	public function setPhoto( $Photo ): void
	{
		$this->_Photo = $Photo;
	}

	public function getRoles()
	{
		return $this->_Roles;
	}

	public function addRole( RoleUser $Role )
	{
		$this->_Roles[] = $Role;
	}

	public function removeRole( Role $Role )
	{
		foreach( $this->_Roles as &$UserRole )
		{
			if( $UserRole->getName() == $Role->getName() )
			{
				$UserRole->setDeleted( true );
			}
		}
	}

	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		$Obj->phone   = $this->getPhone();
		$Obj->address = $this->getAddress();
		$Obj->photo   = $this->getPhoto();

		return $Obj;
	}

	public static function fromArray( array $Data )
	{
		$User = new static;

		$User->setName( $Data[ 'name' ] );
		$User->setEmail( $Data[ 'email' ] );
		$User->setPassword( $Data[ 'password' ] );

		$User->setPhone( $Data[ 'phone' ] );
		$User->setAddress( $Data[ 'address' ] );
		$User->setPhoto( $Data[ 'photo' ] );

		$Role = new Role();
		$Role->setName( $Data[ 'role' ] );
		$Role->setIdentifier( $Data['role_id'] );

		$RoleUser = new RoleUser();
		$RoleUser->setUser( $User );
		$RoleUser->setRole( $Role );

		$User->addRole( $RoleUser );

		return $User;
	}

	public function hasRole( Role $Role )
	{
		foreach( $this->_Roles as $RoleUser )
		{
			if( $RoleUser->getRole()->getName() == $Role->getName() )
			{
				return true;
			}
		}

		return false;
	}
}
