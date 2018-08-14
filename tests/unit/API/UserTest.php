<?php

namespace Tests\unit\API;

use DDP\Core\Infrastructure\IWriteRepository;
use DDP\Domain\User\Domain\UserWithRoles;
use DDP\Domain\User\Infrastructure\IUserRepository;
use PHPUnit\Framework\TestCase;
use DDP\API\User;


class MockRepo implements IUserRepository
{
	public function save( $Object )
	{
		if( $Object->getIdentifier() == 0 )
			return false;

		return true;
	}

	public function getAll( array $Params ): array
	{
		return [];
	}

	public function getById( $UserId )
	{
		return new UserWithRoles();
	}
}

class UserTest extends TestCase
{
	public function testRegisterAdmin()
	{
		$User = new UserWithRoles();

		$User->setIdentifier( 0 );

		$this->assertFalse(
			User::registerAdmin(
				new MockRepo(),
				$User
			)
		);

		$User->setIdentifier( 1 );

		$this->assertTrue(
			User::registerAdmin(
				new MockRepo(),
				$User
			)
		);

	}
}
