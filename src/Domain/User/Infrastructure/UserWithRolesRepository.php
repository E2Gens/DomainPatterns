<?php

namespace DDP\Domain\User\Infrastructure;

use DDP\Domain\User;
use DDP\Domain\User\Domain\UserWithRoles;
use Neuron\Data\Validation\Email;

class UserWithRolesRepository extends UserRepository
{
	private $_UserModel;
	private $_RoleModel;
	private $_RoleUserModel;

	/**
	 * UserWithRolesRepository constructor.
	 * @param \App\User $UserModel
	 * @param \App\Role $RoleModel
	 * @param \App\RoleUser $RoleUserModel
	 */
	public function __construct( \App\User $UserModel, \App\Role $RoleModel, \App\RoleUser $RoleUserModel )
	{
		$this->_UserModel     = $UserModel;
		$this->_RoleModel     = $RoleModel;
		$this->_RoleUserModel = $RoleUserModel;
	}

	/**
	 * @param $User
	 * @return mixed
	 */
	public function save( $User )
	{
		$Obj = $User->toStdClass();

		if( $User->getIdentifier() )
		{
			$this->_UserModel->whereId( $User->getIdentifier() )->update( ( array)$Obj );
		}
		else
		{
			$UserModel = $this->_UserModel->create( ( array)$Obj );

			$User = new UserWithRoles();

			UserWithRoles::fromArray( $User, $UserModel->toArray() );
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
		$RoleModel = $this->_RoleModel->findOrFail( $RoleUser->getRole()->getIdentifier() );
		$UserModel = $this->_UserModel->findOrFail( $RoleUser->getUser()->getIdentifier() );

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

			if( !$UserModel->hasRole( $RoleUser->getRole()->getName() ) )
			{
				$UserModel->roles()->attach( $RoleModel->id );
			}
		}
	}

	/**
	 * @param $UserId
	 * @return User|UserWithRoles
	 */
	public function getById( $UserId )
	{
		$UserAr = $this->_UserModel->with('roles')->where( 'id', $UserId )->first()->toArray();

		$UserEntity = new UserWithRoles();

		UserWithRoles::fromArray( $UserEntity, $UserAr );

		/**
		 * Load all of the roles.
		 */

		$Roles = $this->_RoleUserModel::where( 'user_id', $UserId );

		foreach( $Roles as $RoleObj )
		{
			$RoleUser = new User\Domain\RoleUser();
			$Role     = new User\Domain\Role();

			$Role->setIdentifier( $RoleObj->id );

			$RoleUser->setName( $Role->getName() );
			$RoleUser->setRole( $Role );
			$RoleUser->setUser( $UserEntity );

			$UserEntity->addRole( $RoleUser );
		}

		return $UserEntity;
	}

	/**
	 * @param string $Email
	 * @return bool
	 */
	public function doesEmailExist( string $Email ): bool
	{
		return $this->_UserModel
			->where( 'email', $Email )
			->exists();
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

		return !$this->_UserModel->where( 'email' , $EmailAddress )->exists();
	}

	/**
	 * @param string $Email
	 * @return UserWithRoles
	 */
	public function getByEmail( string $Email )
	{
		$User = $this->_UserModel
			->where( 'email', $Email )
			->first();

		if( $User )
		{
			$Entity = new UserWithRoles();

			UserWithRoles::fromArray( $Entity, $User->toArray() );

			return $Entity;
		}

		return null;
	}

	/**
	 * @param string $RoleName
	 * @param array $Params
	 * @return array
	 */
	private function getAllByRoleName( string $RoleName, array $Params = [] ) : array
	{
		$Users = [];

		$UsersObject = $this->_UserModel->whereHas('roles', function ( $Query ) use ( $RoleName, $Params ) {
			$Query->where( 'name', $RoleName );
		})->with('roles');

		if( isset( $Params[ 'status' ] ) && $Params[ 'status' ] != 'all' )
		{
			$UsersObject = $UsersObject->where( 'status', $Params[ 'status' ] );
		}

		if( isset( $Params[ 'keyword' ] ) && $Params[ 'keyword' ] != '' )
		{
			$UsersObject = $UsersObject->where( 'first_name', 'LIKE', "%{$Params[ 'keyword' ]}%" )
				->orwhere( 'last_name', 'LIKE', "%{$Params[ 'keyword' ]}%" )
				->orWhere( 'email', 'LIKE', "%{$Params[ 'keyword' ]}%" );
		}

		$UsersObject = $UsersObject->get()->toArray();

		foreach( $UsersObject as $User )
		{
			$Entity = new UserWithRoles();

			UserWithRoles::fromArray( $Entity, $User );

			$Users[] = $Entity;
		}

		return $Users;
	}
}
