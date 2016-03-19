<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\DI;

final class DispatcherExtension extends \Nette\DI\CompilerExtension
{
	/** @var array */
	private $defaults = [
		'sender' => NULL,
	];


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);
		$wwwDir = $builder->parameters['wwwDir'];

		if (method_exists($this, 'validateConfig')) {
			$config = $this->validateConfig($this->defaults);
		}

		$builder->addDefinition($this->prefix('dispatcher'))
			->setClass('JuniWalk\Dispatcher\Dispatcher', [$wwwDir])
			->addSetup('setSender', (array) $config['sender']);
	}
}
