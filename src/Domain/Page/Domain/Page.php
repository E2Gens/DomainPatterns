<?php

use DDP\Core\Domain\EntityBase;

class Page extends EntityBase
{
	private $_Route;
	private $_Title;
	private $_MetaKeywords;
	private $_MetaDescription;
	private $ContenbBlock;

	/**
	 * @return null|string
	 */
	public function getRoute(): ?string
	{
		return $this->_Route;
	}

	/**
	 * @param $Route
	 */
	public function setRoute( $Route ): void
	{
		$this->_Route = $Route;
	}

	/**
	 * @return null|string
	 */
	public function getTitle(): ?string
	{
		return $this->_Title;
	}

	/**
	 * @param mixed $Title
	 */
	public function setTitle( $Title ): void
	{
		$this->_Title = $Title;
	}

	/**
	 * @return null|string
	 */
	public function getMetaKeywords(): ?string
	{
		return $this->_MetaKeywords;
	}

	/**
	 * @param mixed $MetaKeywords
	 */
	public function setMetaKeywords( $MetaKeywords ): void
	{
		$this->_MetaKeywords = $MetaKeywords;
	}

	/**
	 * @return null|string
	 */
	public function getMetaDescription(): ?string
	{
		return $this->_MetaDescription;
	}

	/**
	 * @param mixed $MetaDescription
	 */
	public function setMetaDescription( $MetaDescription ): void
	{
		$this->_MetaDescription = $MetaDescription;
	}

	/**
	 * @return mixed
	 */
	public function getContenbBlock()
	{
		return $this->ContenbBlock;
	}

	/**
	 * @param mixed $ContenbBlock
	 */
	public function setContenbBlock( $ContenbBlock ): void
	{
		$this->ContenbBlock = $ContenbBlock;
	}

}
