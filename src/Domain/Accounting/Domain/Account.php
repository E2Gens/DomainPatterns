<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;

class Account extends EntityBase
{
	private $_Name;

	/**
	 * @return mixed
	 */
	public function getName(): string
	{
		return $this->_Name;
	}

	/**
	 * @param mixed $Name
	 * @return Account
	 */
	public function setName( string $Name )
	{
		$this->_Name = $Name;
		return $this;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getName() )
		{
			$Obj->name = $this->getName();
		}

		return $Obj;
	}

	/**
	 * @param $Transaction
	 * @param array $Data
	 */
	public static function fromArray( &$Transaction, array $Data ): void
	{
		parent::fromArray( $Transaction, $Data );

		if( isset( $Data[ 'name' ] ) )
		{
			$Transaction->setName( $Data[ 'name' ] );
		}
	}
}
