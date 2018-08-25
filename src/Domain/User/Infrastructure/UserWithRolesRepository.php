<?php

namespace DDP\Domain\User\Infrastructure;

use DDP\Domain\User;
use DDP\Domain\User\Domain\UserWithRoles;
use Neuron\Data\Validation\Email;

class UserWithRolesRepository implements IUserRepository
{
	private $_UserModel;
	private $_RoleModel;
	private $_RoleUserModel;

	/**
	 * @return \App\User
	 */
	public function getUserModel()
	{
		return $this->_UserModel;
	}

	/**
	 * @return \App\Role
	 */
	public function getRoleModel()
	{
		return $this->_RoleModel;
	}

	/**
	 * @return \App\RoleUser
	 */
	public function getRoleUserModel()
	{
		return $this->_RoleUserModel;
	}


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

	public function getAll( array $Params ): array
	{
		// No. Just.. no.
		return [];
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
			unset( $Obj->is_deleted );
			unset( $Obj->is_new );

			if( property_exists( $Obj, 'password' ) && $Obj->password == null )
			{
				unset( $Obj->password );
			}
			if( property_exists( $Obj, 'photo' ) &&  $Obj->photo == null )
			{
				unset( $Obj->photo );
			}

			$this->_UserModel->whereId( $User->getIdentifier() )->update( ( array)$Obj );
		}
		else
		{
			$UserModel = $this->_UserModel->create( ( array)$Obj );

			$User->setIdentifier( $UserModel->id );
		}

		$this->saveRoles( $User );

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
		$User = $this->_UserModel->with('roles')->where( 'id', $UserId )->first()->toArray();

		$UserEntity = new UserWithRoles();

		UserWithRoles::fromArray( $UserEntity, $User );

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
	 * @param $Email
	 * @return mixed
	 * @throws \Exception if the email address parameter is invalid.
	 */
	public function isEmailAvailable( string $Email )
	{
		$Validation = new Email();

		if( !$Validation->isValid( $Email ) )
		{
			throw new \Exception( "$Email is not a valid email address." );
		}

		return !$this->doesEmailExist( $Email );
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
			$UsersObject = $UsersObject
				->where( 'first_name', 'LIKE', "%{$Params[ 'keyword' ]}%" )
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
