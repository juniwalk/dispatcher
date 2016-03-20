<?php

/**
 * TEST: Proper functionality of Dispatcher.
 * @testCase
 *
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher\Tests\Cases;

use JuniWalk\Dispatcher\IDispatcher;
use JuniWalk\Dispatcher\Tests\Files\Mailer;
use JuniWalk\Dispatcher\Tests\Files\MessageFactory;
use Tester\Assert;

require __DIR__.'/../bootstrap.php';

final class DispatcherTest extends \Tester\TestCase
{
	/** @var IDispatcher */
	private $dispatcher;


	public function testSender()
	{
		$dispatcher = $this->getDispatcher();

		Assert::same('John Doe <john.doe@example.com>', $dispatcher->getSender());
	}


	public function testDispatch()
	{
		$dispatcher = $this->getDispatcher();
		Mailer::setShouldFail(TRUE);

		Assert::exception(function () use ($dispatcher) {
			$dispatcher->dispatch(new MessageFactory);
		}, 'JuniWalk\Dispatcher\DispatchException');
	}


	/**
	 * @return IDispatcher
	 */
	private function getDispatcher()
	{
		if (isset($this->dispatcher)) {
			return $this->dispatcher;
		}

		return $this->dispatcher = createContainer()
			->getByType(IDispatcher::class);
	}
}

(new DispatcherTest)->run();
