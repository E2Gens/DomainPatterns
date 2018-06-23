<?php

namespace Tests\unit\API;

use DDP\Core\Infrastructure\IWriteRepository;
use DDP\Domain\User\Domain\UserWithRoles;
use PHPUnit\Framework\TestCase;
use DDP\API\User;


class MockRepo implements IWriteRepository
{
	public function save( $Object )
	{
		if( $Object->getIdentifier() == 0 )
			return false;

		return true;
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
