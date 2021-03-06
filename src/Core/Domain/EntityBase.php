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
	private $_Classes = [];

	protected function addMap( $Method, $Element, IValidator $Validator, string $Class = '' )
	{
		$this->_ArrayMap[ $Element ]   = $Method;
		$this->_Validators[ $Element ] = $Validator;

		if( $Class )
		{
			$this->_Classes[ $Element ] = $Class;
		}
	}

	public function __construct()
	{
		$this->_Deleted = false;

		$this->addMap( 'Identifier', 'id', new Integer() );

		$this->mapTimeStamps();
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

			if( ( $Result || $Result === 0 || $Result === 0.0 || $Result === false )
				&& !is_object( $Result ) && !is_array( $Result ) )
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
			if( $Value )
			{
				$this->validateMap( $Key, $Value );
			}

			if( array_key_exists( $Key, $this->_Classes ) )
			{
				$Class = $this->_Classes[ $Key ];

				$Object = new $Class;

				$Object->arrayMap( $Value );

				$Value = $Object;
			}

			if( array_key_exists( $Key, $this->_ArrayMap ) )
			{
				$this->mapSet( $Key, $Value );
			}
		}
	}

	/**
	 * @param \Neuron\Data\Validation\ICollection $Validator
	 * @param array $Violations
	 * @return bool
	 */
	public function validate( Validation\ICollection $Validator, array &$Violations ): bool
	{
		$Result     = $Validator->isValid( $this );
		$Violations = $Validator->getViolations();

		return $Result;
	}

	protected function mapTimeStamps(): void
	{
		if( property_exists( $this, '_CreatedAt' ) )
		{
			$this->addMap( 'CreatedAt', 'created_at', new Validation\DateTime() );
		}

		if( property_exists( $this, '_UpdatedAt' ) )
		{
			$this->addMap( 'UpdatedAt', 'updated_at', new Validation\DateTime() );
		}

		if( property_exists( $this, '_DeletedAt' ) )
		{
			$this->addMap( 'DeletedAt', 'deleted_at', new Validation\DateTime() );
		}
	}

	/**
	 * @param $Key
	 * @param $Value
	 * @throws \Exception
	 */
	protected function validateMap( $Key, $Value ): void
	{
		if( array_key_exists( $Key, $this->_Validators ) )
		{
			if( !$this->_Validators[ $Key ]->isValid( $Value ) )
			{
				throw new \Exception( "Validation error: " . $Key . " " . $Value );
			}
		}
	}

	/**
	 * @param $Key
	 * @param $Value
	 */
	protected function mapSet( $Key, $Value ): void
	{
		$Method = 'set' . $this->_ArrayMap[ $Key ];

		$this->$Method( $Value );
	}
}
