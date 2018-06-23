<?php

namespace DDD\Infrastructure;

interface IReadRepository
{
	public function getById( $Id );
	public function getAll() : array;
}
