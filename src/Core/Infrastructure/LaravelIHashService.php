<?php

namespace DDP\Core\Infrastructure;

use DDP\Core\Domain\IHashService;
use Illuminate\Support\Facades\Hash;

class LaravelIHashService implements IHashService
{
	public function hash( \string $Data ): \string
	{
		return Hash::make( $Data );
	}
}
