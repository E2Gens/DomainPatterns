<?php

namespace DDP\Domain\User\Domain;

use Neuron\Data\Validation\ICollection;
use Neuron\Data\Validation\IValidator;

class UserValidator implements ICollection
{
	private $_Validators;

	public function add( $Name, IValidator $Validator )
	{
	}

	public function getViolations(): array
	{
	}

	public function __construct()
	{

	}

	public function isValid( $Object )
	{

	}
}
