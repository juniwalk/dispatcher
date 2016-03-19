<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\Tests\Files;

use Nette\Mail\Message;

final class TestMailer implements \Nette\Mail\IMailer
{
	/**
	 * @param Message  $message
	 * @throw Nette\Mail\SendException
	 */
	public function send(Message $message)
	{
		// decide how to handle this
	}
}
