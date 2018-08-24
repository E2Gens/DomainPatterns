<?php

namespace DDP\Core\Domain;

interface HashService
{
	public function hash( string $Data ) : string;
}
