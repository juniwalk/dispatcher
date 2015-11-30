<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher;

interface IDispatcher
{
	/**
	 * Dispatch email message to given recipients.
	 * @param IMessage  $message  Email message
	 */
	public function dispatch(IMessage $message);
}
