<?php

namespace Tests\unit\Domain\User\Domain;

use DDP\Domain\User\Domain\UserStatus;
use PHPUnit\Framework\TestCase;

class UserStatusTest extends TestCase
{
	public function testGetStatusName()
	{
		$this->assertEquals(
			UserStatus::getStatusName( UserStatus::STATUS_ACTIVE ),
			UserStatus::$StatusMap[ UserStatus::STATUS_ACTIVE ]
		);

		$this->assertEquals(
			UserStatus::getStatusName( UserStatus::STATUS_INACTIVE ),
			UserStatus::$StatusMap[ UserStatus::STATUS_INACTIVE ]
		);

		$this->assertEquals(
			UserStatus::getStatusName( UserStatus::STATUS_SUSPENDED ),
			UserStatus::$StatusMap[ UserStatus::STATUS_SUSPENDED ]
		);
	}
}
