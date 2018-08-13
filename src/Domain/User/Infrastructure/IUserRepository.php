<?php

namespace DDP\Domain\User\Infrastructure;

interface IUserRepository
{
	public function getUserModel();
	public function getAll( &$Entity, array $Params ): array;
	public function getById( $UserId );
	public function save( $User );
}
