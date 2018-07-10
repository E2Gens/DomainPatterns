<?php

namespace DDP\Domain\User\Infrastructure;

class UserWithRolesRepository extends UserRepository
{
	private $_RoleModel;
	private $_RoleUserModel;

	/**
	 * UserRepository constructor.
	 * @param $UserModel
	 * @param $RoleModel
	 * @param $RoleUserModel
	 */
	public function __construct( $UserModel, $RoleModel, $RoleUserModel )
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
		$UserObj = $this->_UserModel::find( $UserId )->toArray();

		$User = User\Domain\UserWithRoles::fromStdClass( $UserObj );

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
		});

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
