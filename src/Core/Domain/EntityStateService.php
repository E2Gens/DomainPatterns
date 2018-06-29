<?php

namespace DDP\Core\Domain;

/**
 * Services to filter arrays of entities based on states.
 * @package DDP\Core\Domain
 */
class EntityStateService
{
	/**
	 * Returns all entities flagged for deletion.
	 * @param array $Entities
	 * @return array
	 */
	public static function getDeleted( array $Entities )
	{
		return array_filter( $Entities, [ __CLASS__, 'isDeleted' ] );
	}

	/**
	 * Returns all entities flagged for creation be the repository.
	 * @param array $Entities
	 * @return array
	 */
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
