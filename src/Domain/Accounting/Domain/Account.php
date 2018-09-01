<?php

namespace DDP\Domain\Accounting\Domain;

use DDP\Core\Domain\EntityBase;
use Neuron\Data\Validation\StringData;

class Account extends EntityBase
{
	private $_Name;

	public function __construct()
	{
		parent::__construct();

		$this->addMap(
			'Name',
			'name',
			new StringData()
		);
	}

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
	 * @param $Transaction
	 * @param array $Data
	 * @throws \Exception
	 *
	 * @deprecated
	 */
	public static function fromArray( &$Transaction, array $Data ): void
	{
		throw new \Exception( 'deprecated' );
	}
}
