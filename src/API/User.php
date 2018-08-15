<?php

namespace DDP\API;

use DDP\Domain\User\Infrastructure\IUserRepository;
use DDP\Domain\User\Domain\UserWithRoles;

/**
 * User API for registering Users and Admins.
 *
 * @package DDP\API
 */
class User
{
	/**
	 * @param IUserRepository $UserRepo
	 * @param UserWithRoles $User
	 * @return mixed
	 */
	protected static function registerUser( IUserRepository $UserRepo, UserWithRoles $User )
	{
		return $UserRepo->save( $User );
	}

	/**
	 * @param IUserRepository $UserRepo
	 * @param UserWithRoles $Admin
	 * @return mixed
	 */
	public static function registerAdmin( IUserRepository $UserRepo, UserWithRoles $Admin )
	{
		return self::registerUser( $UserRepo, $Admin );
	}
}
