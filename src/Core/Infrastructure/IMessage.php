<?php

namespace DDP\Core\Infrastructure;

interface IMessage
{
	public function getFrom() : string;
	public function getTo() : array;
	public function getSubject() : string;
	public function getMessage() : string;
}
