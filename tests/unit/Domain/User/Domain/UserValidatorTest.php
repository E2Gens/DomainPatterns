<?php

use PHPUnit\Framework\TestCase;
use DDP\Domain\User\Domain\UserValidator;

class UserValidatorTest extends TestCase
{

	public function testIsValid()
	{
		$User = new \DDP\Domain\User\Domain\UserWithRoles();

		$UserValidator = new UserValidator();

		$User->setName( 'Lee Jones' );
		$User->setEmail( 'lee@dragonflyrg.com' );

		$this->assertTrue(
			$UserValidator->isValid( $User )
		);
	}

	public function testInvalid()
	{
		$User = new \DDP\Domain\User\Domain\UserWithRoles();

		$UserValidator = new UserValidator();

		$User->setName( 'Lee Jones' );
		$User->setEmail( 'dragonflyrgcom' );

		$this->assertFalse(
			$UserValidator->isValid( $User )
		);

		$User->setName( 'Lee Jones1111' );
		$User->setEmail( 'lee@dragonflyrg.com' );

		$this->assertFalse(
			$UserValidator->isValid( $User )
		);

	}
	public function testGetViolations()
	{
		$User = new \DDP\Domain\User\Domain\UserWithRoles();

		$UserValidator = new UserValidator();

		$User->setName( 'Lee Jones111' );
		$User->setEmail( 'dragonflyrgcom' );

		$this->assertFalse(
			$UserValidator->isValid( $User )
		);

		$Violations = $UserValidator->getViolations();

		var_dump( $Violations );
		$this->assertContains(
			"Neuron\Data\Validation\Name validation failed for getName: Lee Jones111",
			$Violations
		);

		$this->assertContains(
			"Neuron\Data\Validation\Email validation failed for getEmail: dragonflyrgcom",
			$Violations
		);
	}
}
