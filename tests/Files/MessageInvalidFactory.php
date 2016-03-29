<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\Tests\Files;

use Nette\Application\UI\ITemplate;
use Tester\Assert;

final class MessageInvalidFactory implements \JuniWalk\Dispatcher\IMessageFactory
{
	/**
	 * @param  ITemplate  $html
	 * @param  string     $wwwDir
	 * @return Nette\Mailer\Message
	 */
	public function create(ITemplate $html, $wwwDir = NULL)
	{
		return $this;
	}
}
