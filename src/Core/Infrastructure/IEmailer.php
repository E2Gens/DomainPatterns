<?php

namespace DDP\Core\Infrastructure;

interface IEmailer
{
	public function send( IMessage $Message ) : bool;
}
