<?php

namespace DDP\Core\Domain;

use Neuron\Data\Validation;

class Language extends EntityBase
{
	private $_Name;

	public function __construct()
	{
		parent::__construct();

		$this->addMap(
			'Name',
			'name',
			new Validation\StringData()
		);
	}

	/**
	 * @return mixed
	 */
	public function getName() : string
	{
		return $this->_Name;
	}

	/**
	 * @param mixed $Name
	 * @return Language
	 */
	public function setName( string $Name ) : Language
	{
		$this->_Name = $Name;
		return $this;
	}
}
