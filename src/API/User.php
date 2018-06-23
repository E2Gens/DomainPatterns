<?php

namespace DDP\API;

use DDP\Core\Infrastructure\IRepository;
use DDP\Domain\User\Domain\UserWithRoles;
use DDP\Domain\User\Infrastructure\UserRepository;

class User
{
	/**
	 * @param IRepository $UserRepo
	 * @param UserWithRoles $User
	 * @return mixed
	 */
	protected static function registerUser( IRepository $UserRepo, UserWithRoles $User )
	{
		return $UserRepo->save( $User );
	}

	/**
	 * @param IRepository $UserRepo
	 * @param UserWithRoles $Admin
	 * @return mixed
	 */
	public static function registerAdmin( IRepository $UserRepo, UserWithRoles $Admin )
	{
		return self::registerUser( $UserRepo, $Admin );
	}
}
