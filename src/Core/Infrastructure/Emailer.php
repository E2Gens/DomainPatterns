<?php

namespace DDP\Core\Infrastructure;

/**
 * Generic emailer. Wraps php's mail function.
 * @package DDP\Core\Infrastructure
 */
class Emailer implements IEmailer
{
	public function send( IMessage $Message ): bool
	{
		$To = implode( ',', $Message->getTo() );

		return mail(
			$To,
			$Message->getSubject(),
			$Message->getMessage()
		);
	}
}
