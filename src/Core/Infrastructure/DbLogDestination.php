<?php

namespace DDP\Core\Infrastructure;

use Neuron\Log;
use Neuron\Log\Destination\DestinationBase;

class DbLogDestination extends DestinationBase
{
	private $_Model;
	public function __construct( Log\Format\IFormat $Format, \App\Log $Model )
	{
		parent::__construct( $Format );

		$this->_Model = $Model;
	}

	/**
	 * @return \App\Log
	 */
	public function getModel()
	{
		return $this->_Model;
	}

	/**
	 * @param array $aParams
	 * @return mixed|void
	 *
	 * @Suppress(PHPMD.UnusedFormalParameter)
	 */
	public function open( array $aParams ) : bool
	{
	}

	protected function write( string $Text, Log\Data $Data )
	{
		$Model           = $this->_Model->newInstance();
		$Model->datetime = date( "Y-m-d G:i:s", $Data->TimeStamp );
		$Model->text     = $Data->Text;
		$Model->type     = $Data->Level;

		$Model->save();
	}
}
