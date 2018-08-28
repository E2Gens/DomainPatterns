<?php

namespace DDP\Domain\User\Domain;

use DDP\Core\Domain\ValidatorBase;
use Neuron\Data\Validation;
use Neuron\Data\Validation\ICollection;

/**
 * Class UserValidator
 * @package DDP\Domain\User\Domain
 *
 * Validates the users name and email address.
 */
class UserValidator extends ValidatorBase implements ICollection
{
	public function __construct()
	{
		parent::__construct();

		$this->add( 'getEmail', new Validation\Email() );
		$this->add( 'getName',  new Validation\Name() );
	}
}
