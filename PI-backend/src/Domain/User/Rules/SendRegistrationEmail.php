<?php
declare(strict_types=1);

namespace App\Domain\User\Rules;

use App\Domain\User\Model\Events\Register;
use App\Domain\User\Model\User;
use Biig\Component\Domain\Event\DomainEvent;
use Biig\Component\Domain\Rule\DomainRuleInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendRegistrationEmail implements DomainRuleInterface
{
    /** @var MailerInterface */
    private $mailer;

    /** @var string */
    private $mailerSender;

    public function __construct(MailerInterface $mailer, string $mailerSender)
    {
        $this->mailer = $mailer;
        $this->mailerSender = $mailerSender;
    }

    /**
     * @param DomainEvent $event
     */
    public function execute(DomainEvent $event)
    {
        if (!$event instanceof Register) {
            return;
        }

        $subject = $event->getSubject();
        if (!$subject instanceof User) {
            return;
        }

        $mail = (new TemplatedEmail())
            ->htmlTemplate('emails/registration.html.twig')
            ->subject('Vérification de votre mail')
            ->from($this->mailerSender)
            ->to($subject->getEmail())
            ->context([
                'registrationToken' => $event->getToken(),
                'user' => $subject,
            ])
        ;

        $this->mailer->send($mail);
    }

    /**
     * Returns an array of event or a string it listen on.
     *
     * @return array|string
     */
    public function on()
    {
        return User::EVENT_PREPARE_REGISTRATION;
    }
}
