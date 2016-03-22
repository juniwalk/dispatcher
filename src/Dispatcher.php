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
use Nette\Application\UI\ITemplateFactory;
use Nette\Application\LinkGenerator;
use Nette\Mail\IMailer;
use Psr\Log\LoggerInterface;

final class Dispatcher implements IDispatcher
{
	/** @var string|NULL */
	private $wwwDir;

	/** @var ITemplateFactory */
	private $templateFactory;

	/** @var LinkGenerator */
	private $linkFactory;

	/** @var ITranslator|NULL */
	private $translator;

	/** @var LoggerInterface|NULL */
	private $logger;

	/** @var IMailer */
	private $mailer;

	/** @var string|NULL */
	private $sender;


	/**
	 * @param string|NULL       $wwwDir
	 * @param IMailer           $mailer
	 * @param ITemplateFactory  $templateFactory
	 * @param LinkGenerator     $linkFactory
	 */
	public function __construct($wwwDir = NULL, IMailer $mailer, ITemplateFactory $templateFactory, LinkGenerator $linkFactory)
	{
		$this->wwwDir = $wwwDir;
		$this->mailer = $mailer;
		$this->templateFactory = $templateFactory;
		$this->linkFactory = $linkFactory;
	}


	/**
	 * @param IMessageFactory  $messageFactory
	 * @throw InvalidMessageException
	 * @throw DispatchException
	 */
	public function dispatch(IMessageFactory $messageFactory)
	{
		$message = $messageFactory->create($this->createTemplate(), $this->wwwDir);

		if (!$message instanceof \Nette\Mail\Message) {
			throw new InvalidMessageException;
		}

		if (!empty($this->sender) && !$message->getFrom()) {
			$message->setFrom($this->sender);
		}

		try {
			$this->mailer->send($message);

		} catch (\Nette\Mail\SendException $e) {
			$this->logger && $this->logger->log('email', $e);
			throw new DispatchException(NULL, 0, $e);
		}
	}


	/**
	 * @param LoggerInterface|NULL  $logger
	 */
	public function setLogger(LoggerInterface $logger = NULL)
	{
		$this->logger = $logger;
	}


	/**
	 * @return LoggerInterface|NULL
	 */
	public function getLogger()
	{
		return $this->logger;
	}


	/**
	 * @param ITranslator|NULL  $translator
	 */
	public function setTranslator(ITranslator $translator = NULL)
	{
		$this->translator = $translator;
	}


	/**
	 * @return ITranslator|NULL
	 */
	public function getTranslator()
	{
		return $this->translator;
	}


	/**
	 * @param string|NULL  $sender
	 */
	public function setSender($sender = NULL)
	{
		$this->sender = $sender;
	}


	/**
	 * @return string|NULL
	 */
	public function getSender()
	{
		return $this->sender;
	}


	/**
	 * @return \Nette\Application\UI\ITemplate
	 */
	private function createTemplate()
	{
		$template = $this->templateFactory->createTemplate();
		$template->setTranslator($this->translator);
		$template->_control = $this->linkFactory;
		$template->wwwDir = $this->wwwDir;

		return $template;
	}
}
