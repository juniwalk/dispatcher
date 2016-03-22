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
	 * @param IMessageFactory  $messageFactory
	 * @throw InvalidMessageException
	 * @throw DispatchException
	 */
	public function dispatch(IMessageFactory $messageFactory);
}
