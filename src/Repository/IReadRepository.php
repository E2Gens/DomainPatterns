<?php

namespace DDD;

interface IReadRepository
{
	public function getById( $Id );
	public function getAll() : array;
}