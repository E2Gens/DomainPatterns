<?php

use PHPUnit\Framework\TestCase;
use DDP\API\ValidationRegistry;

class MockValidator implements \Neuron\Data\Validation\ICollection
{
	public function isValid( $data ) : bool
	{
		return false;
	}

	public function add( $Name, \Neuron\Data\Validation\IValidator $Validator )
	{
	}

	public function getViolations(): array
	{
		return [ 'Failed' ];
	}
}

class MockValidatable implements \DDP\Core\IValidatable
{
	public function validate( \Neuron\Data\Validation\ICollection $Validator, array &$Violations ): bool
	{
		$Result     = $Validator->isValid( true );
		$Violations = $Validator->getViolations();

		return $Result;
	}
}

class ValidationRegistryTest extends TestCase
{
	public function testRegister()
	{
		$Registry    = new ValidationRegistry();
		$Validator   = new MockValidator();
		$Validatable = new MockValidatable();

		$Registry->register( get_class( $Validatable ), $Validator );

		$Temp = $Registry->get( get_class( $Validatable ) );

		$this->assertEquals(
			$Validator,
			$Temp
		);
	}

	public function testValidate()
	{
		$Registry    = new ValidationRegistry();
		$Validator   = new MockValidator();
		$Validatable = new MockValidatable();

		$Registry->register( get_class( $Validatable ), $Validator );

		$Violations = [];

		$Result = $Registry->validate( $Validatable, $Violations );

		$this->assertFalse( $Result );

		$this->assertContains(
			'Failed',
			$Violations
		);
	}
}
