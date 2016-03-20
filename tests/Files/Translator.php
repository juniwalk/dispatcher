<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\Tests\Files;

final class Translator implements \Nette\Localization\ITranslator
{
	/**
	 * @param  string    $message
	 * @param  int|NULL  $count
	 * @return string
	 */
	public function translate($message, $count = NULL)
	{
		return $message;
	}
}
