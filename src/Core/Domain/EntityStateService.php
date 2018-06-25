<?php

namespace DDP\Core\Domain;

class EntityStateService
{
	public static function getDeleted( array $Entities )
	{
		return array_filter( $Entities, [ __CLASS__, 'isDeleted' ] );
	}

	public static function getNew( array $Entities )
	{
		return array_filter( $Entities, [ __CLASS__, 'isNew' ] );
	}

	public static function isDeleted( $Entity )
	{
		return $Entity->isDeleted();
	}

	public static function isNew( $Entity )
	{
		return !$Entity->getIdentifier();
	}
}
