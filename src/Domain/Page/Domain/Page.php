<?php

namespace DDP\Domain\Page\Domain;

use DDP\Core\Domain\EntityBase;

class Page extends EntityBase
{
	private $_Route;
	private $_Title;
	private $_MetaKeywords;
	private $_MetaDescription;
	private $_Content;
	private $_ContentBlockId;

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
	public function getContent(): ?string
	{
		return $this->_Content;
	}

	/**
	 * @param mixed $Content
	 */
	public function setContent( $Content ): void
	{
		$this->_Content = $Content;
	}

	/**
	 * @return mixed
	 */
	public function getContentBlockId()
	{
		return $this->_ContentBlockId;
	}

	/**
	 * @param mixed $ContentBlockId
	 */
	public function setContentBlockId($ContentBlockId): void
	{
		$this->_ContentBlockId = $ContentBlockId;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		$Obj->route   = $this->getRoute();
		$Obj->title   = $this->getTitle();

		if( $this->getContent() )
		{
			$Obj->content = $this->getContent();
		}

		$Obj->meta_description = $this->getMetaDescription();
		$Obj->meta_keywords    = $this->getMetaKeywords();

		$Obj->content_block_id = $this->getContentBlockId();

		return $Obj;
	}

	/**
	 * @param array $Data
	 * @return EntityBase|Page
	 */
	public static function fromArray( array $Data )
	{
		$Page = new static;

		if( isset( $Data[ 'id' ] ) )
		{
			$Page->setIdentifier( $Data[ 'id' ] );
		}

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

		if( isset( $Data[ 'content_block_id' ] ) )
		{
			$Page->setContentBlockId( $Data[ 'content_block_id' ] );
		}

		if( isset( $Data[ 'contentBlock' ][ 'content' ] ) )
		{
			$Page->setContent(  $Data[ 'contentBlock' ][ 'content' ] );
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
