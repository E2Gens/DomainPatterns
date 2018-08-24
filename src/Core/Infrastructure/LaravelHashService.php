<?php

namespace DDP\Core\Infrastructure;

use DDP\Core\Domain\HashService;
use Illuminate\Support\Facades\Hash;

class LaravelHashService implements HashService
{
	public function hash( string $Data ): string
	{
		return Hash::make( $Data );
	}
}
