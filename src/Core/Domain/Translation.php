<?php

namespace DDP\Core\Domain;

use Neuron\Data\Validation;

class Translation extends EntityBase
{
	private $_LanguageId;
	private $_Tag;
	private $_Text;

	public function __construct()
	{
		parent::__construct();

		$this->addMap(
			'LanguageId',
			'language_id',
			new Validation\Integer()
		);

		$this->addMap(
			'Tag',
			'tag',
			new Validation\StringData()
		);

		$this->addMap(
			'Text',
			'text',
			new Validation\StringData()
		);
	}

	/**
	 * @return mixed
	 */
	public function getLanguageId()
	{
		return $this->_LanguageId;
	}

	/**
	 * @param mixed $LanguageId
	 * @return Translation
	 */
	public function setLanguageId( $LanguageId )
	{
		$this->_LanguageId = $LanguageId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getTag()
	{
		return $this->_Tag;
	}

	/**
	 * @param mixed $Tag
	 * @return Translation
	 */
	public function setTag( $Tag )
	{
		$this->_Tag = $Tag;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->_Text;
	}

	/**
	 * @param mixed $Text
	 * @return Translation
	 */
	public function setText( $Text )
	{
		$this->_Text = $Text;
		return $this;
	}
}
