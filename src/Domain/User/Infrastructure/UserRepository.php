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
		$this->_UserModel     = $UserModel;
		$this->_RoleModel     = $RoleModel;
		$this->_RoleUserModel = $RoleUserModel;
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
			$UserModel = $this->_UserModel::whereId( $User->getIdentifier() )->update( ( array)$Obj );
		}

		$this->saveRoles( $User );

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
