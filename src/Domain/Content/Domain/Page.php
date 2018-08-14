<?php

namespace DDP\Domain\Content\Domain;

use DDP\Core\Domain\EntityBase;

class Page extends EntityBase
{
	private $_Route;
	private $_Title;
	private $_MetaKeywords;
	private $_MetaDescription;
	private $_Content;
	private $_ContentBlockId;
	private $_ModifiedBy;

	/**
	 * @return null|string
	 */
	public function getRoute(): ?string
	{
		return $this->_Route;
	}

	/**
	 * @param $Route
	 * @return $this
	 */
	public function setRoute( $Route )
	{
		$this->_Route = $Route;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getTitle(): ?string
	{
		return $this->_Title;
	}

	/**
	 * @param $Title
	 * @return $this
	 */
	public function setTitle( $Title )
	{
		$this->_Title = $Title;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getMetaKeywords(): ?string
	{
		return $this->_MetaKeywords;
	}

	/**
	 * @param $MetaKeywords
	 * @return $this
	 */
	public function setMetaKeywords( $MetaKeywords )
	{
		$this->_MetaKeywords = $MetaKeywords;
		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getMetaDescription(): ?string
	{
		return $this->_MetaDescription;
	}

	/**
	 * @param $MetaDescription
	 * @return $this
	 */
	public function setMetaDescription( $MetaDescription )
	{
		$this->_MetaDescription = $MetaDescription;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getContent(): ?string
	{
		return $this->_Content;
	}

	/**
	 * @param $Content
	 * @return $this
	 */
	public function setContent( $Content )
	{
		$this->_Content = $Content;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getModifiedBy()
	{
		return $this->_ModifiedBy;
	}

	/**
	 * @param $ModifiedBy
	 * @return $this
	 */
	public function setModifiedBy( $ModifiedBy )
	{
		$this->_ModifiedBy = $ModifiedBy;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getContentBlockId()
	{
		return $this->_ContentBlockId;
	}

	/**
	 * @param $ContentBlockId
	 * @return $this
	 */
	public function setContentBlockId( $ContentBlockId )
	{
		$this->_ContentBlockId = $ContentBlockId;
		return $this;
	}

	/**
	 * @return \stdClass
	 */
	public function toStdClass(): \stdClass
	{
		$Obj = parent::toStdClass();

		if( $this->getRoute() )
		{
			$Obj->route = $this->getRoute();
		}

		if( $this->getTitle() )
		{
			$Obj->title = $this->getTitle();
		}

		if( $this->getContent() )
		{
			$Obj->content = $this->getContent();
		}

		if( $this->getMetaDescription() )
		{
			$Obj->meta_description = $this->getMetaDescription();
		}

		if( $this->getMetaKeywords() )
		{
			$Obj->meta_keywords = $this->getMetaKeywords();
		}

		if( $this->getContentBlockId() )
		{
			$Obj->content_block_id = $this->getContentBlockId();
		}

		if( $this->getModifiedBy() )
		{
			$Obj->modified_by = $this->getModifiedBy();
		}

		return $Obj;
	}

	/**
	 * @param $Page
	 * @param array $Data
	 */
	public static function fromArray( &$Page, array $Data ): void
	{
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

		if( isset( $Data[ 'modified_by' ] ) )
		{
			$Page->setModifiedBy( $Data[ 'modified_by' ] );
		}
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
