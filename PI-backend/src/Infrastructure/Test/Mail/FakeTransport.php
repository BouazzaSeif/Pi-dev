<?php

declare(strict_types=1);

namespace App\Infrastructure\Test\Mail;

use Doctrine\Common\Cache\Cache;
use Nekland\Tools\StringTools;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\SmtpEnvelope;
use Symfony\Component\Mime\BodyRendererInterface;
use Symfony\Component\Mime\RawMessage;

class FakeTransport implements MailerInterface
{
    const KEY_SPOOL = 'app.email.spool';

    private $cache;

    private $renderer;

    /** @var SimpleMail|null */
    private $lastFlushed;

    public function __construct(Cache $cache, BodyRendererInterface $renderer)
    {
        $this->cache    = $cache;
        $this->renderer = $renderer;
    }

    public function send(RawMessage $mail, SmtpEnvelope $envelope = null): void
    {
        if (!$mail instanceof TemplatedEmail) {
            throw new \Exception(\sprintf('The class name "%s" can\'t be handled by "%s" class yet.', get_class($mail), __CLASS__));
        }

        if (empty($mail->getTo())) {
            throw new \Exception('This email haven\'t any recipients !');
        }

        // TemplatedEmail emails need to be rendered.
        // Symfony do the work when we call `send` method, via a listener, but we don't call it here for test purpose
        // Otherwise the content of emails can't be parsed in behat contexts
        $this->renderer->render($mail);
        $mail = SimpleMail::createFromTemplatedEmail($mail);

        $messages = $this->getAllMessages();

        $messages[] = $mail;
        $this->cache->save(self::KEY_SPOOL, $messages);
    }

    public function getLastEmail()
    {
        $messages  = $this->getAllMessages();
        $lastEmail = array_pop($messages);
        $this->cache->save(self::KEY_SPOOL, $messages);

        return $lastEmail;
    }

    public function getLastFlushed()
    {
        return $this->lastFlushed;
    }

    /**
     * @return SimpleMail[]
     */
    public function getAllMessages(): array
    {
        return $this->cache->contains(self::KEY_SPOOL)
            ? $this->cache->fetch(self::KEY_SPOOL)
            : []
        ;
    }

    public function flushAll()
    {
        $this->cache->delete(self::KEY_SPOOL);
    }

    public function flushOneByMail(string $emailToDelete): ?SimpleMail
    {
        return $this->flushByCallable(function (SimpleMail $mail) use ($emailToDelete) {
            return $emailToDelete === $mail->getTo();
        });
    }

    public function flushOneBySubject(string $subject): ?SimpleMail
    {
        return $this->flushByCallable(function (SimpleMail $mail) use ($subject) {
            return StringTools::contains($mail->getSubject(), $subject);
        });
    }

    private function flushByCallable(callable $shoudDelete): ?SimpleMail
    {
        if (!is_callable($shoudDelete)) {
            throw new \LogicException('Impossible to call your callback');
        }

        $messages = $this->getAllMessages();
        $deleted  = null;
        foreach ($messages as $index => $message) {
            if (true === $shoudDelete($message)) {
                $deleted           = $message;
                $this->lastFlushed = $message;
                unset($messages[$index]);
            }
        }

        $this->cache->save(self::KEY_SPOOL, $messages);

        return $deleted;
    }
}
