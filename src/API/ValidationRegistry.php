<?php

namespace DDP\API;

use DDP\Core\IValidatable;
use Neuron\Data\Validation\IValidator;

class ValidationRegistry
{
	private $_Validations;

	/**
	 * @param $Class
	 * @return mixed
	 */
	public function get( $Class )
	{
		return $this->_Validations[ $Class ];
	}

	/**
	 * @param $Class
	 * @param IValidator $Validator
	 */
	public function register( $Class, IValidator $Validator)
	{
		$this->_Validations[ $Class ] = $Validator;
	}

	/**
	 * @param IValidatable $Object
	 * @param $Violations
	 * @return bool
	 */
	public function validate( IValidatable $Object, &$Violations )
	{
		$Validator = $this->get( get_class( $Object ) );

		return $Object->validate( $Validator, $Violations );
	}
}
