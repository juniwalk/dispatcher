<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\Tests\Files;

use Nette\Mail\SendException;
use Tester\Assert;

final class Logger extends \Psr\Log\AbstractLogger
{
	/**
	 * @param mixed   $level
	 * @param string  $message
	 * @param array   $context
	 */
	public function log($level, $message, array $context = [])
	{
		Assert::true($message instanceof SendException);
		Assert::same('email', $level);
	}
}
