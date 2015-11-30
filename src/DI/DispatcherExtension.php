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
	/**
	 * Default configuration.
	 * @var array
	 */
	private $defaults = [
		'tplDir' => '%appDir%/controls/emails/{$fileName}.{$locale}.latte',
		'wwwDir' => '%wwwDir%',
		'from' => null,
	];


	/**
	 * Register extension into DI container.
	 */
	public function loadConfiguration()
	{
		// Get configuration with default values
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		// If validateConfig method is available for use
		if (method_exists($this, 'validateConfig')) {
			// Get the config validated for default values
			$config = $this->validateConfig($this->defaults);
			$config = $builder->expand($config);
		}

		$builder->addDefinition($this->prefix('dispatcher'))
			->setClass('JuniWalk\Dispatcher\Dispatcher', [$config]);
	}
}
