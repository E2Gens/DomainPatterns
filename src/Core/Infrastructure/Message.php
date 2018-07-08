<?php

namespace DDP\Core\Infrastructure;

use Neuron\Data\Validation\Email;

class Message implements IMessage
{
	private $_From;
	private $_To;
	private $_Subject;
	private $_Message;
	private $_AddressValidator;

	public function __construct()
	{
		$this->_AddressValidator = new Email();
	}
	/**
	 * @return mixed
	 */
	public function getMessage() : string
	{
		return $this->_Message;
	}

	/**
	 * @param mixed $Message
	 */
	public function setMessage( string $Message )
	{
		$this->_Message = $Message;
	}

	/**
	 * @return mixed
	 */
	public function getFrom() : string
	{
		return $this->_From;
	}

	/**
	 * @param mixed $From
	 * @return Message
	 *
	 * @throws \Exception - if email address is not valid.
	 */
	public function setFrom( string $From )
	{
		$this->checkAddress( $From );

		$this->_From = $From;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTo() : array
	{
		return $this->_To;
	}

	/**
	 * @param mixed $ToList
	 * @return Message
	 */
	public function setTo( array $ToList )
	{
		array_walk( $ToList, [ $this, 'checkAddress' ] );

		$this->_To = $ToList;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSubject() : string
	{
		return $this->_Subject;
	}

	/**
	 * @param mixed $Subject
	 * @return Message
	 */
	public function setSubject( $Subject )
	{
		$this->_Subject = $Subject;
		return $this;
	}

	/**
	 * @param string $From
	 * @throws \Exception
	 */
	protected function checkAddress( string $From )
	{
		if( !$this->_AddressValidator->isValid( $From ) )
		{
			throw new \Exception( "$From is not a valid email address" );
		}
	}

}
