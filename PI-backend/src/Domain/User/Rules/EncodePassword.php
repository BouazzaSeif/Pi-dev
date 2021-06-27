<?php

declare(strict_types=1);

namespace App\Domain\User\Rules;

use App\Domain\User\Model\Events\PasswordChanged;
use App\Domain\User\Model\User;
use Biig\Component\Domain\Event\DomainEvent;
use Biig\Component\Domain\Rule\DomainRuleInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class EncodePassword implements DomainRuleInterface
{
    /** @var EncoderFactoryInterface */
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function on()
    {
        return User::EVENT_PASSWORD_CHANGED;
    }

    public function execute(DomainEvent $event)
    {
        if (!$event instanceof PasswordChanged) {
            return;
        }

        /** @var User $user */
        $user = $event->getSubject();

        $encoder = $this->encoderFactory->getEncoder($user);
        $event->setPassword($encoder->encodePassword($event->getPlainPassword(), $user->getSalt()));
    }
}
