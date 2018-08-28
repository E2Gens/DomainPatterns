<?php

namespace DDP\Core\Domain;

interface IHashService
{
	public function hash( string $Data ) : string;
}
