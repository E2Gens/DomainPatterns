<?php

namespace DDP\Domain\User\Domain;

class UserWithRoles extends User
{
	private $_Phone;
	private $_Address_1;
	private $_Address_2;
	private $_Country;
	private $_State;
	private $_City;
	private $_PostalCode;
	private $_Photo;
	private $_TaxEin;
	private $_Roles;
	private $_StatusId;
	private $_Status;
	private $_SuspendedReason;
	private $_CreatedAt;

	private $DT_RowId;

	/**
	 * @return mixed
	 */
	public function getDTRowId()
	{
		return $this->DT_RowId;
	}

	/**
	 * @param mixed $DT_RowId
	 */
	public function setDTRowId( $DT_RowId ): void
	{
		$this->DT_RowId = $DT_RowId;
	}

	/**
	 * @return mixed
	 */
	public function getStatusId()
	{
		return $this->_StatusId;
	}

	/**
	 * @param mixed $StatusId
	 */
	public function setStatusId($StatusId): void
	{
		$this->_StatusId = $StatusId;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->_Status;
	}

	/**
	 * @param $Status
	 */
	public function setStatus( $Status )
	{
		$this->_Status = $Status;
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
	 */
	public function getAddress1()
	{
		return $this->_Address_1;
	}

	/**
	 * @param mixed $Address1
	 */
	public function setAddress1( $Address1 )
	{
		$this->_Address_1 = $Address1;
	}

	/**
	 * @return mixed
	 */
	public function getAddress2()
	{
		return $this->_Address_2;
	}

	/**
	 * @param mixed $Address2
	 */
	public function setAddress2( $Address2 )
	{
		$this->_Address_2 = $Address2;
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
	public function getState()
	{
		return $this->_State;
	}

	/**
	 * @param mixed $State
	 */
	public function setState( $State )
	{
		$this->_State = $State;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->_City;
	}

	/**
	 * @param mixed $City
	 */
	public function setCity( $City )
	{
		$this->_City = $City;
	}

	/**
	 * @return mixed
	 */
	public function getPostalCode()
	{
		return $this->_PostalCode;
	}

	/**
	 * @param mixed $PostalCode
	 */
	public function setPostalCode( $PostalCode )
	{
		$this->_PostalCode = $PostalCode;
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

	/**
	 * @return mixed
	 */
	public function getTaxEin()
	{
		return $this->_TaxEin;
	}

	/**
	 * @param mixed $TaxEin
	 */
	public function setTaxEin($TaxEin)
	{
		$this->_TaxEin = $TaxEin;
	}

	/**
	 * @return mixed
	 */
	public function getRoles()
	{
		return $this->_Roles;
	}

	/**
	 * @param RoleUser $Role
	 */
	public function addRole( RoleUser $Role )
	{
		$this->_Roles[] = $Role;
	}

	/**
	 * @param Role $Role
	 */
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

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getPhone() )
		{
			$Obj->phone = $this->getPhone();
		}

		if( $this->getAddress1() )
		{
			$Obj->address_1 = $this->getAddress1();
		}

		if( $this->getAddress2() )
		{
			$Obj->address_2 = $this->getAddress2();
		}

		if( $this->getPhoto() )
		{
			$Obj->avatar_url = $this->getPhoto();
		}

		if( $this->getStatusId() )
		{
			$Obj->status = $this->getStatusId();
		}

		if( $this->getCountry() )
		{
			$Obj->country = $this->getCountry();
		}

		if( $this->getCity() )
		{
			$Obj->city = $this->getCity();
		}

		if( $this->getState() )
		{
			$Obj->state = $this->getState();
		}

		if( $this->getPostalCode() )
		{
			$Obj->postal_code = $this->getPostalCode();
		}

		if( $this->getTaxEin() )
		{
			$Obj->tax_ein = $this->getTaxEin();
		}

		if( $this->getSuspendedReason() )
		{
			$Obj->reason_for_suspension = $this->getSuspendedReason();
		}

		return $Obj;
	}

	/**
	 * @param array $Data
	 * @return User|UserWithRoles
	 */
	public static function fromArray( array $Data )
	{
		$User = new static;

		if( isset( $Data[ 'id' ] ) )
		{
			$User->setIdentifier( $Data[ 'id' ] );
			$User->setDtRowId( 'row_'.$Data[ 'id' ] );
		}

		if( isset( $Data[ 'first_name' ] ) )
		{
			$User->setFirstName( $Data[ 'first_name' ] );
		}

		if( isset( $Data[ 'last_name' ] ) )
		{
			$User->setLastName( $Data[ 'last_name' ] );
		}

		if( isset( $Data[ 'middle_initial' ] ) )
		{
			$User->setMiddleInitial( $Data[ 'middle_initial' ] );
		}

		$User->setName( $User->getFirstName() . ' ' . $User->getLastName() );

		if( isset( $Data[ 'email' ] ) )
		{
			$User->setEmail( $Data[ 'email' ] );
		}

		if( isset( $Data[ 'password' ] ) )
		{
			$User->setPassword( $Data[ 'password' ] );
		}

		if( isset( $Data[ 'phone' ] ) )
		{
			$User->setPhone( $Data[ 'phone' ] );
		}

		if( isset( $Data[ 'address_1' ] ) )
		{
			$User->setAddress1( $Data[ 'address_1' ] );
		}

		if( isset( $Data[ 'address_2' ] ) )
		{
			$User->setAddress2( $Data[ 'address_2' ] );
		}

		if( isset( $Data[ 'country' ] ) )
		{
			$User->setCountry( $Data[ 'country' ] );
		}

		if( isset( $Data[ 'state' ] ) )
		{
			$User->setState( $Data[ 'state' ] );
		}

		if( isset( $Data[ 'city' ] ) )
		{
			$User->setCity( $Data[ 'city' ] );
		}

		if( isset( $Data[ 'postal_code' ] ) )
		{
			$User->setPostalCode( $Data[ 'postal_code' ] );
		}

		if( isset( $Data[ 'avatar_url' ] ) )
		{

			$User->setPhoto( $Data[ 'avatar_url' ] );
		}

		if( isset( $Data[ 'tax_ein' ] ) )
		{
			$User->setTaxEin( $Data[ 'tax_ein' ] );
		}

		if( isset( $Data[ 'status' ] ) )
		{
			$User->setStatusId( $Data[ 'status' ] );
			$User->setStatus( UserStatus::getStatusName( $Data[ 'status' ] ) );
		}

		if( isset( $Data[ 'reason_for_suspension' ] ) )
		{
			$User->setSuspendedReason( $Data[ 'reason_for_suspension' ] );
		}

		if( isset( $Data[ 'created_at' ] ) )
		{
			$User->setCreatedAt( $Data[ 'created_at' ] );
		}

		if( isset( $Data[ 'roles' ] ) )
		{
			$Role = new Role();
			$Role->setName( $Data[ 'roles' ][ 0 ][ 'name' ] );
			$Role->setIdentifier( $Data[ 'roles' ][ 0 ][ 'id' ] );

			$RoleUser = new RoleUser();
			$RoleUser->setUser( $User );
			$RoleUser->setRole( $Role );

			$User->addRole( $RoleUser );
		}

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
