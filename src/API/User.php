<?php

namespace DDP\API;


use DDP\Domain\User\Domain\UserWithRoles;
use DDP\Domain\User\Infrastructure\UserRepository;

class User
{
	private $_UserRepo;

	/**
	 * User constructor.
	 * @param UserRepository $Repo
	 */
	public function __construct( UserRepository $Repo )
	{
		$this->_UserRepo = $Repo;
	}

	/**
	 * @return UserRepository
	 */
	public function getUserRepo()
	{
		return $this->_UserRepo;
	}

	/**
	 * @param UserRepository $UserRepo
	 */
	public function setUserRepo( $UserRepo )
	{
		$this->_UserRepo = $UserRepo;
	}


	/**
	 * @param $User
	 * @return mixed
	 */
	protected function registerUser( UserWithRoles $User )
	{
		return $this->_UserRepo->save( $User );
	}

	/**
	 * @param Domain\UserWithRoles $Admin
	 * @return mixed
	 */
	function registerAdmin( UserWithRoles $Admin )
	{
		return $this->registerUser( $Admin );
	}

	/**
	 * @param Domain\UserWithRoles $Guest
	 * @return mixed
	 */
}
