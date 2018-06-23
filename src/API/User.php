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
	protected function registerUser( IRepository $UserRepo, UserWithRoles $User )
	{
		return $UserRepo->save( $User );
	}

	/**
	 * @param IRepository $UserRepo
	 * @param UserWithRoles $Admin
	 * @return mixed
	 */
	function registerAdmin( IRepository $UserRepo, UserWithRoles $Admin )
	{
		return $this->registerUser( $UserRepo, $Admin );
	}
}
