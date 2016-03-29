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
use JuniWalk\Dispatcher\Tests\Files\MessageInvalidFactory;
use Nette\Localization\ITranslator;
use Tester\Assert;

require __DIR__.'/../bootstrap.php';

final class DispatcherTest extends \Tester\TestCase
{
	/** @var IDispatcher */
	private $dispatcher;


	public function testGetters()
	{
		$dispatcher = $this->getDispatcher();

		Assert::same('John Doe <john.doe@example.com>', $dispatcher->getSender());
		Assert::true($dispatcher->getTranslator() instanceof ITranslator);
	}


	public function testDispatch()
	{
		$dispatcher = $this->getDispatcher();
		Mailer::setShouldFail(FALSE);

		Assert::same(NULL, $dispatcher->dispatch(new MessageFactory));
	}


	public function testDispatchFailure()
	{
		$dispatcher = $this->getDispatcher();
		Mailer::setShouldFail(TRUE);

		Assert::exception(function () use ($dispatcher) {
			$dispatcher->dispatch(new MessageFactory);
		}, 'JuniWalk\Dispatcher\DispatchException');

		Assert::exception(function () use ($dispatcher) {
			$dispatcher->dispatch(new MessageInvalidFactory);
		}, 'JuniWalk\Dispatcher\InvalidMessageException');
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
