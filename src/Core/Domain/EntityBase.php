<?php

namespace DDP\Core\Domain;

use DDP\Core\IValidatable;

/**
 * Base class for entities.
 * @package App\DDD
 */

abstract class EntityBase implements IEntity, IValidatable
{
	private $_Identifier;
	private $_Deleted;

	public function __construct()
	{
		$this->_Deleted = false;
	}

	/**
	 * @return mixed
	 */
	public function getDeleted() : bool
	{
		return $this->_Deleted;
	}

	/**
	 * @param mixed $Deleted
	 */
	public function setDeleted( bool $Deleted ): void
	{
		$this->_Deleted = $Deleted;
	}

	/**
	 * @return mixed
	 */
	public function getIdentifier()
	{
		return $this->_Identifier;
	}

	/**
	 * @param mixed $Identifier
	 */
	public function setIdentifier( $Identifier ): void
	{
		$this->_Identifier = $Identifier;
	}

	/**
	 * @return \stdClass
	 * @SuppressWarnings("unused")
	 */
	public function toStdClass() : \stdClass
	{
		$Obj = new \stdClass();

		$Obj->id = $this->getIdentifier();

		// @todo: handle $_Deleted property

		return $Obj;
	}

	public function validate( \Neuron\Data\Validation\ICollection $Validator, array &$Violations ): bool
	{
		$Result     = $Validator->isValid( static::class );
		$Violations = $Validator->getViolations();

		return $Result;
	}
}
