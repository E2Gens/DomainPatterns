<?php

namespace DDP\Domain\User\Infrastructure;

use DDP\Core\Infrastructure\IRepository;

class UserRepository implements IRepository
{
	private $_UserModel;
	private $_RoleModel;

	/**
	 * UserRepository constructor.
	 * @param App\User $UserModel
	 * @param $RoleModel
	 */
	public function __construct( App\User $UserModel, $RoleModel )
	{
		$this->_UserModel = $UserModel;
		$this->_RoleModel = $RoleModel;
	}

	/**
	 * @param Domain\User $User
	 * @return mixed
	 */
	public function save( Domain\User $User )
	{
		$Obj = $User->toStdClass();

		if( !$User->getIdentifier() )
		{
			$UserModel = App\User::create( $Obj );
			$User->setIdentifier( $UserModel->id );
		}
		else
		{
			$UserModel = App\User::update( $Obj );
		}

		$this->saveRoles( $User );

		return $UserModel;
	}

	public function getAll(): array
	{
		return [];
	}

	/**
	 * @param $UserId
	 * @return Domain\User
	 */
	public function getById( $UserId )
	{
		$UserObj = App\User::find( $UserId );

		$User = Domain\User::fromStdClass( $UserObj );

		/**
		 * Load all of the roles.
		 */

		$Roles = $UserObj->roles();

		foreach( $Roles as $RoleObj )
		{
			$RoleUser = new Domain\RoleUser();
			$Role     = new Domain\Role();

			$Role->setIdentifier( $RoleObj->id );

			$RoleUser->setName( $Role->getName() );
			$RoleUser->setRole( $Role );
			$RoleUser->setUser( $User );

			$User->addRole( $RoleUser );
		}

		return $User;
	}

	/**
	 * Remove any deleted roles and save any new ones.
	 *
	 * @param Domain\User $User
	 */
	protected function saveRoles( Domain\User $User )
	{
		$Roles = $User->getRoles();

		foreach( $Roles as $RoleUser )
		{
			$RoleModel = App\Role::findOrFail( $RoleUser->getRole()->getIdentifier() );
			$UserModel = App\User::findOrFail( $RoleUser->getUser()->getIdentifier() );

			if( $RoleUser->getDeleted() )
			{
				/**
				 * If RoleUser is flagged as deleted then detach the role from the user..
				 */
				$UserModel->roles()->detach( $RoleModel );
			}
			else if( !$RoleUser->getIdentifier() )
			{
				/**
				 * If the RoleUser relation has no identifier then attach the role..
				 */
				$UserModel->roles()->attach( $RoleModel->id );
			}
		}
	}
}
