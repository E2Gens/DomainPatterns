<?php

namespace DDP\Core\Domain;

use DDP\Core\IValidatable;
use Neuron\Data\Validation\Integer;
use Neuron\Data\Validation\IValidator;
use Neuron\Data\Validation;

/**
 * Base class for entities.
 * @package App\DDD
 */

class EntityBase implements IEntity, IValidatable
{
	private $_Identifier;
	private $_Deleted;
	private $_IsNew;
	private $_ArrayMap;
	private $_Validators;

	protected function addMap( $Method, $Element, IValidator $Validator )
	{
		$this->_ArrayMap[ $Element ]   = $Method;
		$this->_Validators[ $Element ] = $Validator;
	}

	public function __construct()
	{
		$this->_Deleted = false;

		$this->addMap( 'Identifier', 'id', new Integer() );

		if( property_exists( $this, '_CreatedAt' ) )
		{
			$this->addMap( 'CreatedAt', 'created_at', new Validation\Date() );
		}

		if( property_exists( $this, '_UpdatedAt' ) )
		{
			$this->addMap( 'UpdatedAt', 'updated_at', new Validation\Date() );
		}

		if( property_exists( $this, '_DeletedAt' ) )
		{
			$this->addMap( 'DeletedAt', 'deleted_at', new Validation\Date() );
		}
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

		foreach( $this->_ArrayMap as $Data => $Var )
		{
			$Method = 'get'.$Var;

			$Result = $this->$Method();

			if( $Result )
			{
				$Obj->$Data = $Result;
			}
		}

		return $Obj;
	}

	/**
	 * @param $Entity
	 * @param array $Data
	 * @deprecated
	 */
	public static function fromArray( &$Entity, array $Data ) : void
	{
		if( isset( $Data[ 'id' ] ) )
		{
			$Entity->setIdentifier( $Data[ 'id' ] );
		}
	}

	/**
	 * @param array $Data
	 * @throws \Exception
	 */
	public function arrayMap( array $Data )
	{
		if( !count( $this->_ArrayMap ) )
		{
			throw new \Exception( "No automapper configuration for class." );
		}

		foreach( $Data as $Key => $Value )
		{
			if( array_key_exists( $Key, $this->_Validators ) )
			{
				if( !$this->_Validators[ $Key ]->isValid( $Value ) )
				{
					throw new \Exception( "Validation error: ".$Key." ".$Value );
				}
			}

			$Method = 'set'.$this->_ArrayMap[ $Key ];

			$this->$Method( $Value );
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
