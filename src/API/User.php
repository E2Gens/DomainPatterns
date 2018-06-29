<?php

namespace DDP\API;

use DDP\Core\Infrastructure\IWriteRepository;
use DDP\Domain\User\Domain\UserWithRoles;

/**
 * User API for registering Users and Admins.
 *
 * @package DDP\API
 */
class User
{
	/**
	 * @param IWriteRepository $UserRepo
	 * @param UserWithRoles $User
	 * @return mixed
	 */
	protected static function registerUser( IWriteRepository $UserRepo, UserWithRoles $User )
	{
		return $UserRepo->save( $User );
	}

	/**
	 * @param IWriteRepository $UserRepo
	 * @param UserWithRoles $Admin
	 * @return mixed
	 */
	public static function registerAdmin( IWriteRepository $UserRepo, UserWithRoles $Admin )
	{
		return self::registerUser( $UserRepo, $Admin );
	}
}
