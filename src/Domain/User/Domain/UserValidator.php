<?php

namespace DDP\Domain\User\Domain;

use Neuron\Data\Validation;
use Neuron\Data\Validation\ICollection;
use Neuron\Data\Validation\IValidator;

/**
 * Class UserValidator
 * @package DDP\Domain\User\Domain
 *
 * Validates the users name and email address.
 */
class UserValidator implements ICollection
{
	private $_Validators;
	private $_Violations;
	private $_User;

	public function add( $Name, IValidator $Validator )
	{
		$this->_Validators[ $Name ] = $Validator;
	}

	public function getViolations(): array
	{
		return $this->_Violations;
	}

	public function __construct()
	{
		$this->add( 'getEmail', new Validation\Email() );
		$this->add( 'getName',  new Validation\Name() );
	}

	public function isValid( $User ) : bool
	{
		$this->_User = $User;

		$Keys = array_keys( $this->_Validators );
		return array_reduce( $Keys, [ $this, 'reduceValid' ], true );
	}

	public function reduceValid( $Prev, $Key )
	{
		$Validator = $this->_Validators[ $Key ];

		if( !$Validator->isValid( $this->_User->$Key() ) )
		{
			$this->_Violations[] = get_class( $Validator)." validation failed for ".$this->_User->$Key();
			return false;
		}

		return $Prev;
	}
}
