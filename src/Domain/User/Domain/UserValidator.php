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
		$this->add( 'email', new Validation\Email() );
		$this->add( 'name',  new Validation\Name() );
	}

	public function isValid( $User ) : bool
	{
		$Valid = true;

		if( !$this->_Validators[ 'email' ]->isValid( $User->getEmail() ) )
		{
			$this->_Violations[] = $User->getEmail().' is not a valid email address.';
			$Valid = false;
		}

		if( !$this->_Validators[ 'name' ]->isValid( $User->getName() ) )
		{
			$this->_Violations[] = $User->getName().' is not a valid name.';
			$Valid = false;
		}

		return $Valid;
	}
}
