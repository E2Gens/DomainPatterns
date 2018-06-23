<?php

namespace DDP\Core\Infrastructure;

interface IReadRepository
{
	public function getById( $Id );
	public function getAll() : array;
}
