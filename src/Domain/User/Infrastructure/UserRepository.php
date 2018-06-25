<?php

namespace DDP\Domain\User\Infrastructure;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\User;

// @todo rename to UserWithRolesRepository

class UserRepository implements IRepository
{
	private $_UserModel;
	private $_RoleModel;

	/**
	 * UserRepository constructor.
	 * @param $UserModel
	 * @param $RoleModel
	 */
	public function __construct( $UserModel, $RoleModel )
	{
		$this->_UserModel = $UserModel;
		$this->_RoleModel = $RoleModel;
	}

	/**
	 * @param $User
	 * @return mixed
	 */
	public function save( $User )
	{
		$Obj = $User->toStdClass();

		if( !$User->getIdentifier() )
		{
			$UserModel = $this->_UserModel::create( (array)$Obj );
			$User->setIdentifier( $UserModel->id );
		}
		else
		{
			// @todo this is wrong and needs to be updated.
			$UserModel = $this->_UserModel::update( (array)$Obj );
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
	 * @return User\Domain\User
	 */
	public function getById( $UserId )
	{
		$UserObj = $this->_UserModel::find( $UserId );

		$User = User\Domain\UserWithRoles::fromStdClass( $UserObj );

		/**
		 * Load all of the roles.
		 */

		$Roles = $UserObj->roles();

		foreach( $Roles as $RoleObj )
		{
			$RoleUser = new User\Domain\RoleUser();
			$Role     = new User\Domain\Role();

			$Role->setIdentifier( $RoleObj->id );

			$RoleUser->setName( $Role->getName() );
			$RoleUser->setRole( $Role );
			$RoleUser->setUser( $User );

			$User->addRole( $RoleUser );
		}

		return $User;
	}

	/**
	 * @param User\Domain\UserWithRoles $User
	 */
	protected function saveRoles( $User )
	{
		$Roles = $User->getRoles();

		if( is_array( $Roles ) )
		{
			array_walk( $Roles, [ $this, 'addOrRemoveRole' ] );
		}
	}

	/**
	 * @param $RoleUser
	 */
	protected function addOrRemoveRole( $RoleUser )
	{
		$RoleModel = $this->_RoleModel::findOrFail( $RoleUser->getRole()->getIdentifier() );
		$UserModel = $this->_UserModel::findOrFail( $RoleUser->getUser()->getIdentifier() );

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
