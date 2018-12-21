<?php

namespace DDP\Core\Infrastructure;

use DDP\Core\Domain\Language;
use DDP\Core\Domain\Translation;

class TranslationRepository
{
	private $_Language;
	private $_TranslationModel;

	public function __construct( Language $Language, \App\Translation $Model )
	{
		$this->_Language         = $Language;
		$this->_TranslationModel = $Model;
	}

	public function getText( string $Tag ) : ?string
	{
		$Trans = $this->_TranslationModel
			->where( 'tag', $Tag )
			->where( 'language_id', $this->_Language->getIdentifier() )
			->first();

		if( $Trans )
		{
			$Translation = new Translation();

			$Translation->arrayMap( $Trans->toArray() );

			return $Translation->getText();
		}

		return null;
	}
}
