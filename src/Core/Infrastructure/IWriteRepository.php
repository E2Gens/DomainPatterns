<?php

namespace DDP\Core\Infrastructure;

/**
 * Interface IWriteRepository
 * @package DDP\Core\Infrastructure
 *
 * Generic interface for repositories with write ability.
 */
interface IWriteRepository
{
	public function save( $Object );
}
