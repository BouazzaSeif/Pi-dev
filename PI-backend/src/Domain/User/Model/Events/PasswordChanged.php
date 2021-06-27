<?php

declare(strict_types=1);

namespace App\Domain\User\Model\Events;

use Biig\Component\Domain\Event\DomainEvent;

class PasswordChanged extends DomainEvent
{
    /** @var callable */
    private $setPassword;

    /** @var string */
    private $plainPassword;

    public function __construct($subject, string $plainPassword, callable $setPassword)
    {
        parent::__construct($subject);
        $this->setPassword   = $setPassword;
        $this->plainPassword = $plainPassword;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPassword($password)
    {
        $setPassword = $this->setPassword;
        $setPassword($password);
    }
}
