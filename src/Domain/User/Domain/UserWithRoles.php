<?php

namespace DDP\Domain\User\Domain;

use DDP\Core\Domain\EntityBase;
use DDP\Core\Domain\TimestampsTrait;#

class UserWithRoles extends EntityBase
{
	use TimestampsTrait;

	private $_Name;
	private $_FirstName;
	private $_LastName;
	private $_Email;
	private $_Password;
	private $_RememberToken;
	private $_Phone;
	private $_Photo;
	private $_Roles;

	/**
	 * @return mixed
	 */
	public function getName()
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
	 * @return mixed
	 */
	public function getFirstName()
	{
		return $this->_FirstName;
	}

	/**
	 * @param $FirstName
	 * @return $this
	 */
	public function setFirstName( $FirstName )
	{
		$this->_FirstName = $FirstName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->_LastName;
	}

	/**
	 * @param $LastName
	 * @return $this
	 */
	public function setLastName( $LastName )
	{
		$this->_LastName = $LastName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->_Email;
	}

	/**
	 * @param $Email
	 * @return $this
	 */
	public function setEmail( $Email )
	{
		$this->_Email = $Email;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->_Password;
	}

	/**
	 * @param $Password
	 * @return $this
	 */
	public function setPassword( $Password )
	{
		if( $Password != null && !empty( $Password ) )
		{
			$this->_Password = $Password;
			return $this;
		}
	}

	/**
	 * @return mixed
	 */
	public function getRememberToken()
	{
		return $this->_RememberToken;
	}

	/**
	 * @param mixed $RememberToken
	 * @return $this
	 */
	public function setRememberToken( $RememberToken )
	{
		$this->_RememberToken = $RememberToken;
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
	 * @param $Phone
	 * @return $this
	 */
	public function setPhone( $Phone )
	{
		$this->_Phone = $Phone;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPhoto()
	{
		return $this->_Photo;
	}

	/**
	 * @param $Photo
	 * @return $this
	 */
	public function setPhoto( $Photo )
	{
		$this->_Photo = $Photo;
		return $this;
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
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getName() )
		{
			$Obj->name = $this->getName();
		}

		if( $this->getFirstName() )
		{
			$Obj->first_name = $this->getFirstName();
		}

		if( $this->getLastName() )
		{
			$Obj->last_name = $this->getLastName();
		}

		if( $this->getEmail() )
		{
			$Obj->email = $this->getEmail();
		}

		if( $this->getPassword() )
		{
			$Obj->password = $this->getPassword();
		}

		if( $this->getPhone() )
		{
			$Obj->phone = $this->getPhone();
		}

		if( $this->getPhoto() )
		{
			$Obj->photo = $this->getPhoto();
		}

		if( $this->getRememberToken() )
		{
			$Obj->remember_token = $this->getRememberToken();
		}

		return $Obj;
	}

	/**
	 * @param $User
	 * @param array $Data
	 */
	public static function fromArray( &$User, array $Data ) : void
	{
		if( isset( $Data[ 'id' ] ) )
		{
			$User->setIdentifier( $Data[ 'id' ] );
		}

		if( isset( $Data[ 'first_name' ] ) && isset( $Data[ 'last_name' ] ) )
		{
			$User->setName( $Data[ 'first_name' ] . ' ' .$Data[ 'last_name' ] );
		}
		else if( isset( $Data[ 'name' ] ) )
		{
			$User->setName( $Data[ 'name' ] );
		}

		if( isset( $Data[ 'first_name' ] ) )
		{
			$User->setFirstName( $Data[ 'first_name' ] );
		}

		if( isset( $Data[ 'last_name' ] ) )
		{
			$User->setLastName( $Data[ 'last_name' ] );
		}

		if( isset( $Data[ 'email' ] ) )
		{
			$User->setEmail( $Data[ 'email' ] );
		}

		if( isset( $Data[ 'password' ] ) )
		{
			$User->setPassword( $Data[ 'password' ] );
		}

		if( isset( $Data[ 'remember_token' ] ) )
		{
			$User->setRememberToken( $Data[ 'remember_token' ] );
		}

		if( isset( $Data[ 'phone' ] ) )
		{
			$User->setPhone( $Data[ 'phone' ] );
		}

		if( isset( $Data[ 'photo' ] ) )
		{
			$User->setPhoto( $Data[ 'photo' ] );
		}

		if( isset( $Data[ 'created_at' ] ) )
		{
			$User->setCreatedAt( $Data[ 'created_at' ] );
		}

		if( isset( $Data[ 'updated_at' ] ) )
		{
			$User->setUpdatedAt( $Data[ 'updated_at' ] );
		}

		if( isset( $Data[ 'deleted_at' ] ) )
		{
			$User->setDeletedAt( $Data[ 'deleted_at' ] );
		}

		if( isset( $Data[ 'roles' ] ) && is_array( $Data[ 'roles' ] ) )
		{
			foreach( $Data[ 'roles' ] as $RoleObj )
			{
				$Role = new Role();
				$Role->setName( $RoleObj[ 'name' ] );
				$Role->setIdentifier( $RoleObj[ 'id' ] );

				$RoleUser = new RoleUser();
				$RoleUser->setUser( $User );
				$RoleUser->setRole( $Role );

				$User->addRole( $RoleUser );
			}
		}
	}

	/**
	 * @param Role $Role
	 * @return bool
	 */
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
		$this->_Id = $this->getIdentifier();

		return (object)get_object_vars($this);
	}
}
