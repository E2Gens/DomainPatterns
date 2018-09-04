<?php

namespace DDP\Core\Domain;

use Neuron\Data\Validation\DateTime;
use Neuron\Data\Validation\Integer;
use Neuron\Data\Validation\StringData;

class Log extends EntityBase
{
	private $_DateTime;
	private $_Text;
	private $_Level;

	public function __construct()
	{
		parent::__construct();

		$this->addMap( 'DateTime', 'datetime', new DateTime() );
		$this->addMap( 'Text',     'text',     new StringData() );
		$this->addMap( 'Level',    'level',    new Integer() );
	}

	/**
	 * @return mixed
	 */
	public function getDateTime() : string
	{
		return $this->_DateTime;
	}

	/**
	 * @param mixed $DateTime
	 * @return Log
	 */
	public function setDateTime( string $DateTime )
	{
		$this->_DateTime = $DateTime;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getText() : string
	{
		return $this->_Text;
	}

	/**
	 * @param mixed $Text
	 * @return Log
	 */
	public function setText( string $Text )
	{
		$this->_Text = $Text;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLevel() : int
	{
		return $this->_Level;
	}

	/**
	 * @param mixed $Level
	 * @return Log
	 */
	public function setLevel( int $Level )
	{
		$this->_Level = $Level;
		return $this;
	}
}
