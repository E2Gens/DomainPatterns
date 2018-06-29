<?php

namespace DDP\API;

use DDP\Core\IValidatable;
use Neuron\Data\Validation\IValidator;

/**
 * Use to globally associate a validation object with a class.
 *
 * @see IValidatable
 * @see IValidator
 * @package DDP\API
 */
class ValidationRegistry
{
	private $_Validations;

	/**
	 * Get the validator object associated with the class name.
	 * @param $Class
	 * @return mixed
	 */
	public function get( $Class )
	{
		return $this->_Validations[ $Class ];
	}

	/**
	 * Associate a validator with a class.
	 * @param $Class
	 * @param IValidator $Validator
	 */
	public function register( $Class, IValidator $Validator)
	{
		$this->_Validations[ $Class ] = $Validator;
	}

	/**
	 * Giving this method an object (not class, it will figure that out) will
	 * cause it to run the validator on the class. If the validation fails,
	 * the Violations array will contain a list of the failed validations.
	 *
	 * @param IValidatable $Object
	 * @param $Violations If validation fails, this array is populated with descriptions of the failed validations.
	 * @return bool False if validation fails.
	 */
	public function validate( IValidatable $Object, &$Violations )
	{
		$Validator = $this->get( get_class( $Object ) );

		return $Object->validate( $Validator, $Violations );
	}
}
