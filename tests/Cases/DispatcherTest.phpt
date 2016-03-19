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

use JuniWalk\Dispatcher\Tests\Files;
use Tester\Assert;

require __DIR__.'/../bootstrap.php';

final class DispatcherTest extends \Tester\TestCase
{

}

(new DispatcherTest)->run();
