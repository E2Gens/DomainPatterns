<?php

namespace DDP\Domain\User\Domain;

class UserStatus
{
	const STATUS_ACTIVE    = 1;
	const STATUS_INACTIVE  = 0;
	const STATUS_SUSPENDED = 2;

	public static $StatusMap = [ self::STATUS_ACTIVE    => 'Active',
										  self::STATUS_INACTIVE  => 'Inactive',
										  self::STATUS_SUSPENDED => 'Suspended' ];

	/**
	 * @param $Status
	 * @return string
	 */
	public static function getStatusName( $Status ): string
	{
		return self::$StatusMap[ $Status ];
	}
}
