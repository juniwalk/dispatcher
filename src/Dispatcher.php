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

final class Dispatcher implements IDispatcher
{
	/** @var string */
	private $wwwDir;

	/** @var ITemplateFactory */
	private $templateFactory;

	/** @var LinkGenerator */
	private $linkFactory;

	/** @var ITranslator */
	private $translator;

	/** @var IMailer */
	private $mailer;

	/** @var string */
	private $sender;


	/**
	 * @param string            $wwwDir
	 * @param IMailer           $mailer
	 * @param ITemplateFactory  $templateFactory
	 * @param LinkGenerator     $linkFactory
	 * @param ITranslator|NULL  $translator
	 */
	final public function __construct($wwwDir, IMailer $mailer, ITemplateFactory $templateFactory, LinkGenerator $linkFactory, ITranslator $translator = NULL)
	{
		$this->wwwDir = $wwwDir;
		$this->mailer = $mailer;
		$this->templateFactory = $templateFactory;
		$this->linkFactory = $linkFactory;
		$this->translator = $translator;
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
	 * @return Nette\Application\UI\ITemplate
	 */
	public function createTemplate()
	{
		$template = $this->templateFactory->createTemplate();
		$template->setTranslator($this->translator);
		$template->add('_control', $this->linkFactory);
		$template->add('wwwDir', $this->wwwDir);

		return $template;
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

		if ($this->sender && !$message->getFrom()) {
			$message->setFrom($this->sender);
		}

		try {
			$this->mailer->send($message);

		} catch (\Nette\Mail\SendException $e) {
			throw new DispatchException(NULL, 0, $e);
		}
	}
}
