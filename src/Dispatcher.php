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
    /**
     * Instance of the template factory.
     * @var ITemplateFactory
     */
    private $templateFactory;

    /**
     * Instance of the link generator.
     * @var LinkGenerator
     */
    private $linkFactory;

    /**
     * Instance of the translator.
     * @var ITranslator
     */
    private $translator;

    /**
     * Instance of the email sender.
     * @var IMailer
     */
    private $sender;


    private $appDir;
    private $wwwDir;


    /**
     * Collect all needed dependencies into properties.
     * @param IMailer           $sender           Email sender
     * @param ITemplateFactory  $templateFactory  Template factory
     * @param LinkGenerator     $linkFactory      Link generator
     * @param ITranslator       $translator       Translator instance
     */
    final public function __construct($appDir, $wwwDir, IMailer $sender, ITemplateFactory $templateFactory, LinkGenerator $linkFactory, ITranslator $translator)
    {
        $this->appDir = $appDir;
        $this->wwwDir = $wwwDir;
        $this->templateFactory = $templateFactory;
        $this->linkFactory = $linkFactory;
        $this->translator = $translator;
        $this->sender = $sender;
    }


    /**
     * Send created email message.
     * @param  IMessage  $message  Email message
     * @return void
     * @throws Exception
     */
    public function dispatch(IMessage $message)
    {
        // Convert IMessage instance for nette mailer
        $email = $this->convertMessage($message);

        // If returned value is not instance of Message
        if (!$email instanceof \Nette\Mail\Message) {
            throw new \UnexpectedValueException;
        }

        // If there is no sender information
        if (!$email->getFrom()) {
            // Insert our gloval sender information into each message
            $email->setFrom('info@ptproject.cz', 'PT Project');
        }

        // Dispatch the message using IMailer sender
        return $this->sender->send($email);
    }


    /**
     * Convert IMessage instance for nette mailer.
     * @param  IMessage  $message
     * @return \Nette\Mail\Message
     */
    private function convertMessage(IMessage $message)
    {
        // Create template instance using the type of the queued entry
        $template = $this->templateFactory->createTemplate();

        // Assign basic variables to the template
        $template->locale = $this->translator->getLocale();
        $template->translator = $this->translator;
        $template->_control = $this->linkFactory;

        // Set the path to the template file of the message
        $template->setFile(strtr($message::TEMPLATE, [
            '%appDir%'      => $this->appDir,
            '%fileName%'    => $message->getTemplateName(),
            '%locale%'      => $template->locale,
        ]));

        // Create nette mailer message from the IMessage instance
        return $message->createMessage($template, $this->wwwDir);
    }
}
