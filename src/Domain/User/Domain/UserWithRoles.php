<?php

namespace DDP\Domain\User\Domain;

class UserWithRoles extends User
{
	private $_Phone;
	private $_Address;
	private $_Country;
	private $_Photo;
	private $_Roles;
	private $_Status;
	private $_SuspendedReason;
	private $_CreatedAt;

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->_Status;
	}

	/**
	 * @param mixed $_Status
	 *
	 * @return self
	 */
	public function setStatus( $Status )
	{
		$this->_Status = $Status;

		return $this;
	}

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
	 * @todo this is really dumb. Why is address one database field?
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
	public function getCountry()
	{
		return $this->_Country;
	}

	/**
	 * @param mixed $Country
	 */
	public function setCountry( $Country ): void
	{
		$this->_Country = $Country;
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

	/**
	 * @return mixed
	 */
	public function getSuspendedReason()
	{
		return $this->_SuspendedReason;
	}

	/**
	 * @param mixed $SuspendedReason
	 *
	 * @return self
	 */
	public function setSuspendedReason( $SuspendedReason )
	{
		$this->_SuspendedReason = $SuspendedReason;

		return $this;
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
	 * @return string
	 */
	public function getStatusName()
	{
		return UserStatus::getStatusName( $this->_Status );
	}

	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		$Obj->phone   = $this->getPhone();
		$Obj->address = $this->getAddress();
		$Obj->photo   = $this->getPhoto();
		$Qbj->status  = $this->getStatus();

		$Obj->reason_for_suspension = $this->getSuspendedReason();

		return $Obj;
	}

	public static function fromArray( array $Data )
	{
		$User = new static;

		$User->setIdentifier( $Data[ 'id' ] );
		$User->setName( $Data[ 'first_name' ] . $Data[ 'last_name' ] );
		$User->setEmail( $Data[ 'email' ] );

		if( isset( $Data[ 'password' ] ) )
		{
			$User->setPassword( $Data[ 'password' ] );
		}

		$User->setPhone( $Data[ 'phone' ] );
		$User->setAddress( $Data[ 'address_1' ] );
		$User->setCountry( $Data[ 'country' ] );
		$User->setPhoto( $Data[ 'avatar_url' ] );
		$User->setStatus( UserStatus::getStatusName( $Data[ 'status' ] ) );

		$User->setSuspendedReason( $Data[ 'reason_for_suspension' ] );
		$User->setCreatedAt( $Data[ 'created_at' ] );

		$Role = new Role();
		$Role->setName( $Data[ 'roles' ][ 0 ][ 'name' ] );
		$Role->setIdentifier( $Data[ 'roles' ][ 0 ][ 'id' ] );

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

	/**
	 * @return object
	 */
	public function jsonSerialize()
	{
		$ParentObjVars  = parent::jsonSerialize();
		$CurrentObjVars = (object)get_object_vars($this);

		return (object) array_merge((array) $ParentObjVars, (array) $CurrentObjVars);
	}
}
