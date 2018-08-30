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
	 * @return mixed
	 */
	public function getIsNew()
	{
		return $this->_IsNew || !$this->getIdentifier();
	}

	/**
	 * @param mixed $IsNew
	 */
	public function setIsNew( $IsNew ): void
	{
		$this->_IsNew = $IsNew;
	}

	/**
	 * @return \stdClass
	 * @SuppressWarnings("unused")
	 */
	public function toStdClass() : \stdClass
	{
		$Obj = new \stdClass();

		$Obj->id = $this->getIdentifier();

		return $Obj;
	}

	/**
	 * @param $Entity
	 * @param array $Data
	 */
	public static function fromArray( &$Entity, array $Data ) : void
	{
		if( isset( $Data[ 'id' ] ) )
		{
			$Entity->setIdentifier( $Data[ 'id' ] );
		}
	}

	/**
	 * @param \Neuron\Data\Validation\ICollection $Validator
	 * @param array $Violations
	 * @return bool
	 */
	public function validate( \Neuron\Data\Validation\ICollection $Validator, array &$Violations ): bool
	{
		$Result     = $Validator->isValid( $this );
		$Violations = $Validator->getViolations();

		return $Result;
	}
}
