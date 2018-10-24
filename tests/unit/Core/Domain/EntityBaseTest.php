<?php

use DDP\Core\Domain\EntityBase;
use PHPUnit\Framework\TestCase;

class TestSubEntity extends EntityBase
{
	private $_Name;

	public function __construct()
	{
		parent::__construct();

		$this->addMap( 'Name', 'name', new \Neuron\Data\Validation\StringData() );
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->_Name;
	}

	/**
	 * @param mixed $Name
	 * @return TestSubEntity
	 */
	public function setName( $Name )
	{
		$this->_Name = $Name;
		return $this;
	}
}

class TestEntity extends EntityBase
{
	private $_SubEntity;

	public function __construct()
	{
		parent::__construct();

		$this->addMap(
			'SubEntity',
			'sub_entity',
			new \Neuron\Data\Validation\ArrayData(),
			TestSubEntity::class
		);
	}

	/**
	 * @return mixed
	 */
	public function getSubEntity() : TestSubEntity
	{
		return $this->_SubEntity;
	}

	/**
	 * @param mixed $SubEntity
	 * @return TestEntity
	 */
	public function setSubEntity( TestSubEntity $SubEntity )
	{
		$this->_SubEntity = $SubEntity;
		return $this;
	}
}


class EntityBaseTest extends TestCase
{
	public function testArrayMapPass()
	{
		$Entity = new TestEntity();

		$Data[ 'id' ] = 1;

		$Data[ 'sub_entity' ] = [
			'name' => 'Test Name'
		];

		$Entity->arrayMap( $Data );

		$this->assertEquals(
			$Entity->getIdentifier(),
			1
		);

		$this->assertEquals(
			$Entity->getSubEntity()->getName(),
			'Test Name'
		);

	}

	public function testArrayMapFail()
	{
		$Entity = new EntityBase();

		$Data[ 'id' ] = 'poop';

		$Result = true;

		try
		{
			$Entity->arrayMap( $Data );
		}
		catch( Exception $Exception )
		{
			$Result = false;
		}

		$this->assertFalse( $Result );
	}
}
