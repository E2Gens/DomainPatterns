<?php

namespace DDP\Core\Domain;

/**
 * Class EntityBase
 * @package App\DDD
 */
interface IEntity
{
	/**
	 * @return mixed
	 */
	public function getDeleted() : bool;

	/**
	 * @param mixed $Deleted
	 */
	public function setDeleted( bool $Deleted ): void;

	/**
	 * @return mixed
	 */
	public function getIdentifier();

	/**
	 * @param mixed $Identifier
	 */
	public function setIdentifier( $Identifier ): void;
}
