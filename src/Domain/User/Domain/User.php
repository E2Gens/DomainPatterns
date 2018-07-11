<?php

namespace DDP\Domain\User\Domain;

use App\DDD;
use DDP\Core\Domain\EntityBase;
use Illuminate\Support\Facades\Hash;

class User extends EntityBase
{
	private $_Name;
	private $_FirstName;
	private $_LastName;
	private $_Email;
	private $_Password;

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->_Email;
	}

	/**
	 * @param mixed $Email
	 */
	public function setEmail( $Email ): void
	{
		$this->_Email = $Email;
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
	public function setName($Name)
	{
		$this->_Name = $Name;
	}

	/**
	 * @return mixed
	 */
	public function getFirstName()
	{
		return $this->_FirstName;
	}

	/**
	 * @param mixed $FirstName
	 */
	public function setFirstName( $FirstName )
	{
		$this->_FirstName = $FirstName;
	}

	/**
	 * @return mixed
	 */
	public function getLastName()
	{
		return $this->_LastName;
	}

	/**
	 * @param mixed $LastName
	 */
	public function setLastName( $LastName )
	{
		$this->_LastName = $LastName;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->_Password;
	}

	/**
	 * @param mixed $Password
	 * Hashes the given password and saves it.
	 */
	public function setPassword( $Password ): void
	{
		if( $Password != null && !empty($Password) )
		{
			$this->_Password = Hash::make( $Password );
		}
	}

	/**
	 * @param array $Data
	 * @return User
	 */
	public static function fromArray( array $Data )
	{
		$User = new static;

		$User->setName( $Data[ 'first_name' ] . ' ' .$Data[ 'last_name' ] );
		$User->setFirstName( $Data[ 'first_name' ] );
		$User->setLastName( $Data[ 'last_name' ] );
		$User->setEmail( $Data[ 'email' ] );
		$User->setPassword( isset( $Data[ 'password' ] ) ? $Data[ 'password' ]:null );

		return $User;
	}

	public static function fromStdClass( \stdClass $Object )
	{
		$User = new static;

		$User->setName( $Object->name );
		$User->setEmail( $Object->email );
		$User->setPassword( $Object->password );

		return $User;
	}

	public static function fromRequest( $Request )
	{
		$User = new static;

		$User->setName( $Request->input( 'name' ) );
		$User->setEmail( $Request->input( 'email' ) );
		$User->setPassword( $Request->input( 'password' ) );

		return $User;
	}

	public function toStdClass() : \stdClass
	{
		$Obj = new \stdClass();

		$Obj->name     = $this->getName();
		$Obj->email    = $this->getEmail();
		$Obj->password = $this->getPassword();

		return $Obj;
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
