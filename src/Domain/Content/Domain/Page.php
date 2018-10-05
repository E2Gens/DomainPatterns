<?php

namespace DDP\Domain\Content\Domain;

use DDP\Core\Domain\EntityBase;
use DDP\Core\Domain\TimestampsTrait;
use Neuron\Data\Validation\Integer;
use Neuron\Data\Validation\StringData;

class Page extends EntityBase
{
	use TimestampsTrait;

	public function __construct()
	{
		$this->addMap( 'Route', 				'route', 					new StringData() );
		$this->addMap( 'Title', 		  	   'title',					new StringData() );
		$this->addMap( 'MetaKeywords', 	'meta_keywords', 		new StringData() );
		$this->addMap( 'MetaDescription', 'meta_description', 	new StringData() );
		$this->addMap( 'Content', 			'content',			 	new StringData() );
		$this->addMap( 'ModifiedBy',  		'modified_by',		 	new Integer() );
		$this->addMap( 'ContentBlockId',  'content_block_id',	new Integer() );
	}

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
	 * @param string $Route
	 * @return $this
	 */
	public function setRoute( ?string $Route )
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
	public function setTitle( ?string $Title )
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
	public function setContent( ?string $Content )
	{
		$this->_Content = $Content;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getModifiedBy(): ?int
	{
		return $modified_bythis->_ModifiedBy;
	}

	/**
	 * @param $ModifiedBy
	 * @return $this
	 */
	public function setModifiedBy( ?int $ModifiedBy )
	{
		$this->_ModifiedBy = $ModifiedBy;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getContentBlockId(): ?int
	{
		return $this->_ContentBlockId;
	}

	/**
	 * @param $ContentBlockId
	 * @return $this
	 */
	public function setContentBlockId( ?int $ContentBlockId )
	{
		$this->_ContentBlockId = $ContentBlockId;
		return $this;
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

		if( isset( $Data[ 'created_at' ] ) )
		{
			$Page->setCreatedAt( $Data[ 'created_at' ] );
		}

		if( isset( $Data[ 'updated_at' ] ) )
		{
			$Page->setUpdatedAt( $Data[ 'updated_at' ] );
		}

		if( isset( $Data[ 'deleted_at' ] ) )
		{
			$Page->setDeletedAt( $Data[ 'deleted_at' ] );
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
