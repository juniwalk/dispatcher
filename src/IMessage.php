<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher;

use Nette\Application\UI\ITemplate;

interface IMessage
{
	/**
	 * Get the name of the template file.
	 * @return string
	 */
	public function getTemplateName();


	/**
	 * Create email Message instance for the Dispatcher.
	 * @param  ITemplate  $html    Created template
	 * @param  string     $wwwDir  Path to www
	 * @return \Nette\Mailer\Message
	 */
	public function createMessage(ITemplate $html, $wwwDir = null);
}
