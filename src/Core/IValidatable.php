<?php

namespace DDP\Core;

use Neuron\Data\Validation;

interface IValidatable
{
	public function validate( Validation\ICollection $Validator, array &$Violations ) : bool;
}
