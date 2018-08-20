<?php

namespace DDP\API;

use DDP\Domain\User\Infrastructure\IUserRepository;
use DDP\Domain\User\Domain\UserWithRoles;
use Neuron\Log\Log;

/**
 * User API for registering Users and Admins.
 *
 * @package DDP\API
 */
class User
{
	/**
	 * @param IUserRepository $UserRepo
	 * @param $User
	 * @return mixed
	 */
	protected static function registerUser( IUserRepository $UserRepo, $User )
	{
		return $UserRepo->save( $User );
	}

	/**
	 * @param IUserRepository $UserRepo
	 * @param $Admin
	 * @return mixed
	 */
	public static function registerAdmin( IUserRepository $UserRepo, $Admin )
	{
		Log::info( "registerAdmin: ".$Admin->getEmail() );

		return self::registerUser( $UserRepo, $Admin );
	}
}
