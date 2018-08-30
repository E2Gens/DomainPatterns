<?php

namespace DDP\Core\Domain;

use Neuron\Data\Validation\ICollection;
use Neuron\Data\Validation\IValidator;

/**
 * Base class for constructing Validators for entity objects.
 * @package DDP\Core\Domain
 */

class ValidatorBase
{
	private $_Validators;
	private $_Violations;
	private $_Entity;

	public function __construct()
	{
		$this->_Violations = [];
	}

	/**
	 * Used to add information regarding which tests failed.
	 * @param string $Message
	 */
	protected function addViolation( string $Message )
	{
		$this->_Violations[] = $Message;
	}

	/**
	 * @param $Name
	 * @param IValidator $Validator
	 */
	public function add( $Name, IValidator $Validator )
	{
		$this->_Validators[ $Name ] = $Validator;
	}

	/**
	 * @return array
	 */
	public function getViolations(): array
	{
		return $this->_Violations;
	}

	/**
	 * @param $Entity
	 * @return bool
	 */
	public function isValid( $Entity ) : bool
	{
		$this->_Entity = $Entity;
		$Keys = array_keys( $this->_Validators );
		return array_reduce( $Keys, [ $this, 'reduceValid' ], true );
	}

	/**
	 * @param $Prev
	 * @param $Key
	 * @return bool
	 */
	protected function reduceValid( $Prev, $Key )
	{
		$Validator = $this->_Validators[ $Key ];

		if( !$Validator->isValid( $this->_Entity->$Key() ) )
		{
			$this->addViolation( get_class( $Validator)." validation failed for ".$Key.": ".$this->_Entity->$Key() );
			$Prev = false;
		}

		return $Prev;
	}
}
