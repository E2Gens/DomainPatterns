<?php

namespace DDP\Domain\User\Domain;

use App\DDD;
use DDP\Core\Domain\EntityBase;
use Illuminate\Support\Facades\Hash;

class User extends EntityBase
{
	private $_Name;
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

	public function getName()
	{
		return $this->_Name;
	}

	public function setName( $Name )
	{
		$this->_Name = $Name;
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

	public static function fromArray( array $Data )
	{
		$User = new static;

		$User->setName( $Data[ 'name' ] );
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
