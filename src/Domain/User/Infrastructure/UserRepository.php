<?php

namespace DDP\Domain\User\Infrastructure;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\User;
use Neuron\Data\Validation\Email;

// @todo rename to UserWithRolesRepository

/**
 * Repository for UsersWithRoles
 *
 * @see User\Domain\UserWithRoles
 *
 * @package DDP\Domain\User\Infrastructure
 */
class UserRepository implements IRepository
{
	private $_UserModel;

	/**
	 * @return mixed
	 */
	public function getUserModel()
	{
		return $this->_UserModel;
	}

	/**
	 * @param mixed $UserModel
	 */
	public function setUserModel( $UserModel )
	{
		$this->_UserModel = $UserModel;
	}

	/**
	 * UserRepository constructor.
	 * @param $UserModel
	 */
	public function __construct( $UserModel  )
	{
		$this->_UserModel = $UserModel;
	}

	/**
	 * @param $User
	 * @return mixed
	 *
	 * @todo $User needs to be a reference as the id can change during save.
	 */
	public function save( $User )
	{
		$Obj = $User->toStdClass();

		if( !$User->getIdentifier() )
		{
			$UserModel = $this->_UserModel::create( ( array)$Obj );
			$User->setIdentifier( $UserModel->id );
		}
		else
		{
			if( !$Obj->password )
			{
				unset( $Obj->password );
			}

			$UserModel = $this->_UserModel::whereId( $User->getIdentifier() )->update( ( array)$Obj );
		}

		return $UserModel;
	}

	public function getAll(): array
	{
		// Probably never a good idea to return every record in the system.
		return [];
	}

	/**
	 * @param $UserId
	 * @return User\Domain\User
	 */
	public function getById( $UserId )
	{
		$UserObj = $this->_UserModel::find( $UserId )->toArray();

		$User = User\Domain\User::fromStdClass( $UserObj );

		return $User;
	}

	/**
	 * Returns true if the email address is available.
	 *
	 * @param $EmailAddress
	 * @return mixed
	 * @throws \Exception if the email address parameter is invalid.
	 */
	public function isEmailAvailable( $EmailAddress )
	{
		$Validation = new Email();

		if( !$Validation->isValid( $EmailAddress ) )
		{
			throw new \Exception( "$EmailAddress is not a valid email address." );
		}

		return !$this->_UserModel::where( 'email' , $EmailAddress )->exists();
	}
}
