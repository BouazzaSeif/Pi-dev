<?php

declare(strict_types=1);

namespace App\Infrastructure\Test\Mail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class SimpleMail
{
    /** @var string */
    private $subject;

    /** @var string */
    private $content;

    /** @var string */
    private $to;

    public function __construct(string $subject, string $content, string $to)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->to      = $to;
    }

    public static function createFromTemplatedEmail(TemplatedEmail $email)
    {
        // Stay simple for the moment
        $to = current($email->getTo());
        if (null === $to) {
            throw new \LogicException('The mail must have a "to"');
        }

        if (null === $email->getSubject()) {
            throw new \LogicException('The mail must have a "subject"');
        }

        if (!is_string($email->getHtmlBody())) {
            throw new \LogicException('The mail body must be a string');
        }

        return new self($email->getSubject(), $email->getHtmlBody(), $to->getAddress());
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    public function getUniqueKey(): string
    {
        return \sprintf('%s_%s',
            $this->to,
            $this->subject
        );
    }

    public function equals(SimpleMail $mail): bool
    {
        return $this->getUniqueKey() === $mail->getUniqueKey();
    }
}
