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

	/**
	 * @param \stdClass $Object
	 * @SuppressWarnings("unused")
	 */
	public static function fromStdClass( \stdClass $Object );

	/**
	 * @deprecated
	 * @param FormRequest $Request
	 * @SuppressWarnings("unused")
	 */
	public static function fromRequest( $Request );

	/**
	 * @return \stdClass
	 * @SuppressWarnings("unused")
	 */
	public function toStdClass(): \stdClass;

	/**
	 * @param array $Data
	 * @param IEnity $Entity
	 * @return void
	 */
	public static function fromArray( array $Data, &$Entity ) : void;
}
