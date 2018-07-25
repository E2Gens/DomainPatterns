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

	/**
	 * @return stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		$Obj->route = $this->getRoute();
		$Obj->title = $this->getTitle();

		$Obj->meta_description = $this->getMetaDescription();
		$Obj->meta_keywords    = $this->getMetaKeywords();
		$Obj->content_block    = $this->getContenbBlock();

		return $Obj;
	}

	/**
	 * @param array $Data
	 * @return EntityBase|Page
	 */
	public static function fromArray( array $Data )
	{
		$Page = new static;

		if( isset( $Data[ 'route' ] ) )
		{
			$Page->setRoute( $Data[ 'route' ] );
		}

		if( isset( $Data[ 'title' ] ) )
		{
			$Page->setTitle( $Data[ 'title' ] );
		}

		if( isset( $Data[ 'meta_description' ] ) )
		{
			$Page->setMetaDescription( $Data[ 'meta_description' ] );
		}

		if( isset( $Data[ 'meta_keywords' ] ) )
		{
			$Page->setMetaKeywords( $Data[ 'meta_keywords' ] );
		}

		return $Page;
	}

	/**
	 * @return object
	 */
	public function jsonSerialize()
	{
		$this->_Id = $this->getIdentifier();

		return (object)get_object_vars($this);
	}
}
