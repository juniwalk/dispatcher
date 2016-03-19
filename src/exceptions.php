<?php

/**
 * @author    Martin Procházka <juniwalk@outlook.cz>
 * @package   Dispatcher
 * @link      https://github.com/juniwalk/Dispatcher
 * @copyright Martin Procházka (c) 2015
 * @license   MIT License
 */

namespace JuniWalk\Dispatcher;

abstract class RuntimeException extends \RuntimeException
{
}


abstract class LogicException extends \LogicException
{
}


final class DispatchException extends RuntimeException
{
}


final class InvalidMessageException extends LogicException
{
}
