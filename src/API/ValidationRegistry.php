<?php

namespace DDP\API;

use Neuron\Data\Validation\IValidator;

class ValidationRegistry
{
	private $_Validations;

	public function get( $Class )
	{
		echo 'get class: '.$Class;
		return $this->_Validations[ $Class ];
	}

	public function register( $Class, IValidator $Validator)
	{
		echo 'register class: '. $Class;
		$this->_Validations[ $Class ] = $Validator;
	}

	public function validate( $Object, &$Violations )
	{
		$Validator = $this->get( get_class( $Object ) );

		return $Object->validate( $Validator, $Violations );
	}
}
