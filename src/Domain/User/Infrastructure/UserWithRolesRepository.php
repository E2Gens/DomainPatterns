<?php

namespace DDP\Domain\User\Infrastructure;

class UserWithRolesRepository extends UserRepository
{
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
		parent::__construct( $UserModel );

		$this->_RoleModel     = $RoleModel;
		$this->_RoleUserModel = $RoleUserModel;
	}

	public function save( $User )
	{
		$UserModel = parent::save( $User );

		$this->saveRoles( $User );

		return $UserModel;
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
		$UserModel = parent::getUserModel()::findOrFail( $RoleUser->getUser()->getIdentifier() );

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

			if( !$UserModel->hasRole( $RoleUser->getName() ) )
			{
				$UserModel->roles()->attach( $RoleModel->id );
			}
		}
	}

	/**
	 * @param $UserId
	 * @return User\Domain\User
	 */
	public function getById( $UserId )
	{
		$UserAr = parent::getUserModel()::find( $UserId )->toArray();

		$User = User\Domain\UserWithRoles::fromArray( $UserAr );

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
			$RoleUser->setUser( $User );

			$User->addRole( $RoleUser );
		}

		return $User;
	}

	/**
	 * @param string $RoleName
	 * @param array $Params
	 * @return array
	 */
	public function getAllByRoleName( string $RoleName, array $Params = [] ) : array
	{
		$Administrators = [];

		$AdministratorsObject = $this->_UserModel::whereHas('roles', function ( $Query ) use ( $RoleName, $Params ) {
			$Query->where( 'name', $RoleName );
		})->with('roles');

		if( isset( $Params[ 'status' ] ) && $Params[ 'status' ] != 'all' )
		{
			$AdministratorsObject = $AdministratorsObject->where( 'status', $Params[ 'status' ] );
		}

		if( isset( $Params[ 'keyword' ] ) && $Params[ 'keyword' ] != '' )
		{
			$AdministratorsObject = $AdministratorsObject->where( 'first_name', 'LIKE', "%{$Params[ 'keyword' ]}%" )
				->orwhere( 'last_name', 'LIKE', "%{$Params[ 'keyword' ]}%" )
				->orWhere( 'email', 'LIKE', "%{$Params[ 'keyword' ]}%" );
		}

		$AdministratorsObject = $AdministratorsObject->get()->toArray();

		foreach( $AdministratorsObject as $Administrator )
		{
			$Administrators[] = Domain\User::fromArray($Administrator)->jsonSerialize();
		}

		return $Administrators;
	}
}
