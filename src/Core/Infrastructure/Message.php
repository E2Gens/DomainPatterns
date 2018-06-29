<?php

namespace DDP\Core\Infrastructure;

class Message implements IMessage
{
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
	private $_From;
	private $_To;
	private $_Subject;
	private $_Message;

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
	 */
	public function setFrom( string $From )
	{
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
	 * @param mixed $To
	 * @return Message
	 */
	public function setTo( array $To )
	{
		$this->_To = $To;
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

}
