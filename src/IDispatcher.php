<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher;

use Nette\Localization\ITranslator;

interface IDispatcher
{
	/**
	 * @param ITranslator|NULL  $translator
	 */
	public function setTranslator(ITranslator $translator = NULL);


	/**
	 * @return ITranslator|NULL
	 */
	public function getTranslator();


	/**
	 * @param string|NULL  $sender
	 */
	public function setSender($sender = NULL);


	/**
	 * @return string|NULL
	 */
	public function getSender();


	/**
	 * @param IMessageFactory  $messageFactory
	 * @throw InvalidMessageException
	 * @throw DispatchException
	 */
	public function dispatch(IMessageFactory $messageFactory);
}
