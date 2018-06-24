<?php

namespace DDP\API;

use Neuron\Data\Validation\IValidator;

class ValidationRegistry
{
	private $_Validations;

	public function get( $Class )
	{
		return $this->_Validations[ $Class ];
	}

	public function register( $Class, IValidator $Validator)
	{
		$this->_Validations[ $Class ] = $Validator;
	}

	public function validate( $Object, &$Violations )
	{
		$Validator = $this->get( get_class( $Object ) );

		return $Object->validate( $Validator, $Violations );
	}
}
