<?php

namespace DDD\Infrastructure;

/**
 * Interface IRepository
 * @package DDD\Infrastructure
 *
 * Composite interface made up of read and write.
 */

interface IRepository extends IReadRepository, IWriteRepository
{
}
