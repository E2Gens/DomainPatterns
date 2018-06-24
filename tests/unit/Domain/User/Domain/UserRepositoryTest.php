<?php

use DDP\Domain\User\Infrastructure\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
	public $Repo;

	public function setUp()
	{
		$this->Repo = $this
			->getMockBuilder( UserRepository::class )
			->setMethods(['save'])
			->disableOriginalConstructor()
			->getMock();

		$this->Repo->expects( $this->any() )
			->method('save')
			->will(
				$this->returnValue( true )
			);
	}

	public function testGetAll()
	{

	}

	public function testSave()
	{

	}

	public function testGetById()
	{

	}

	public function test__construct()
	{

	}
}
