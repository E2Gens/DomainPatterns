<?php

namespace DDP\Core;

use DDP\API\ValidationRegistry;
use DDP\Core\Domain\ValidatorBase;
use Neuron\Data\Validation;

/**
 * Used by ValidationRegistry to apply a Validator against the object.
 * @see ValidatorBase
 * @see ValidationRegistry
 *
 * @package DDP\Core
 */
interface IValidatable
{
	public function validate( Validation\ICollection $Validator, array &$Violations ) : bool;
}
