<?php

namespace DDP\Core\Infrastructure;

use DDP\Core\Domain\Language;

class LanguageRepository
{
	private $_LanguageModel;

	public function __construct( \App\Language $Model )
	{
		$this->_LanguageModel = $Model;
	}

	public function getByName( string $Name ) : ?Language
	{
		$Lang = $this->_LanguageModel
			->where( 'name', $Name )
			->first();

		if( $Lang )
		{
			$Language = new Language();

			$Language->arrayMap( $Lang->toArray() );

			return $Language;
		}

		return null;
	}
}
