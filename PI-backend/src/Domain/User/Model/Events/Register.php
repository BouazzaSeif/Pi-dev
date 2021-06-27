<?php

declare(strict_types=1);

namespace App\Domain\User\Model\Events;

use App\Domain\User\Model\User;
use Biig\Component\Domain\Event\DomainEvent;
use Symfony\Contracts\EventDispatcher\Event;

class Register extends DomainEvent
{
    /** @var string */
    private $token;

    public function __construct(User $subject, string $token, array $arguments = [], Event $originalEvent = null)
    {
        parent::__construct($subject, $arguments, $originalEvent);

        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }
}
