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
	 * @param array $aParams
	 * @return mixed|void
	 *
	 * @Suppress(PHPMD.UnusedFormalParameter)
	 */
	public function open( array $aParams )
	{
	}

	protected function write( $Text, Log\Data $Data )
	{
		$this->Model->datetime = date( "[Y-m-d G:i:s]", $Data->_TimeStamp ) . ",$Data->_sLevel,$Data->_sText";
		$this->Model->text     = $Text;
		$this->Model->level    = $Data->Level;
	}
}
