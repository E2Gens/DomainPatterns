<?php

namespace DDP\Core\Infrastructure;

/**
 * Interface IReadRepository
 * @package DDP\Core\Infrastructure
 *
 * Generic interface for repositories with read ability.
 */
interface IReadRepository
{
	public function getById( $Id );
	public function getAll() : array;
}
