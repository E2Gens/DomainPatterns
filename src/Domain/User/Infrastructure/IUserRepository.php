<?php

namespace DDP\Domain\User\Infrastructure;

interface IUserRepository
{
	public function getAll( array $Params ): array;
	public function getById( $UserId );
	public function save( $User );
}
