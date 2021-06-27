<?php

declare(strict_types=1);

namespace App\Behat;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use App\Infrastructure\Test\Mail\FakeTransport;

class EmailContext implements KernelAwareContext
{
    use KernelDictionary;

    /**
     * @BeforeScenario @email
     * @AfterScenario @email
     */
    public function purgeSpool()
    {
        $this->getContainer()->get(FakeTransport::class)->flushAll();
    }

    /**
     * @Then I should receive an email
     * @Then I should receive ":n" emails
     */
    public function IShouldReceiveAnEmail(int $n = 1)
    {
        if (null !== $n) {
            $n = (int) $n;
        }

        /** @var FakeTransport $transport */
        $transport = $this->getContainer()->get(FakeTransport::class);

        \expect(count($transport->getAllMessages()))->toBe($n);
    }

    /**
     * @Then an email containing the subject :subject should be send
     */
    public function anEmailContainingTheSubjectShouldBeSend(string $subject)
    {
        $transport = $this->getContainer()->get(FakeTransport::class);
        $found     = $transport->flushOneBySubject($subject);

        if (!$found) {
            throw new \Exception(sprintf('No mail sended with placeholder subject "%s"', $subject));
        }

        return $found;
    }

    /**
     * @And An email must be sent to address :email
     * @Then An email must be sent to address :email
     */
    public function AnEmailMustBeSentToAddress(string $email)
    {
        $transport = $this->getContainer()->get(FakeTransport::class);
        $found     = $transport->flushOneByMail($email);

        if (!$found) {
            throw new \Exception(sprintf('No mail sended to the address "%s"', $email));
        }
    }
}
