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
	 * @param string|NULL  $sender
	 */
	public function setSender($sender = NULL);


	/**
	 * @return string|NULL
	 */
	public function getSender();


	/**
	 * @return Nette\Application\UI\ITemplate
	 */
	public function createTemplate();


	/**
	 * @param IMessageFactory  $messageFactory
	 * @throw InvalidMessageException
	 * @throw DispatchException
	 */
	public function dispatch(IMessageFactory $messageFactory);
}
