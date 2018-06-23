<?php

namespace Tests\unit\API;

use DDP\Domain\User\Infrastructure\UserRepository;
use DDP\Domain\User\Domain\UserWithRoles;
use PHPUnit\Framework\TestCase;
use DDP\API\User;

class UserTest extends TestCase
{
	public function testRegisterAdmin()
	{
		$Repo = $this
			->getMockBuilder( UserRepository::class )
			->setMethods(['save'])
			->disableOriginalConstructor()
			->getMock();

		$UserApi = new User(
			$Repo
		);

		$Repo->expects( $this->any() )
			->method('save')
			->will(
				$this->returnValue( true )
			);

		$User = new UserWithRoles();

		$this->assertTrue( $UserApi->registerAdmin( $User ) );

	}
}
