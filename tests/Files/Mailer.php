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
use Nette\Mail\SendException;

final class Mailer implements \Nette\Mail\IMailer
{
	/** @var bool */
	private static $shouldFail = FALSE;


	/**
	 * @param bool  $status
	 */
	public static function setShouldFail($status)
	{
		static::$shouldFail = (bool) $status;
	}


	/**
	 * @param  Message  $message
	 * @throws SendException
	 */
	public function send(Message $message)
	{
		if (static::$shouldFail) {
			throw new SendException;
		}
	}
}
