<?php

namespace Tests\App\Domain\User\Rules;

use App\Domain\User\Model\Events\Register;
use App\Domain\User\Model\User;
use App\Domain\User\Rules\SendRegistrationEmail;
use Biig\Component\Domain\Event\DomainEvent;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class SendRegistrationEmailTest extends TestCase
{
    const MAIL_SENDER = 'yourMail@domain.fr';

    /** @var MailerInterface|ObjectProphecy */
    private $mailer;

    /** @var ObjectProphecy */
    private $event;

    /** @var SendRegistrationEmail */
    private $rule;

    protected function setUp()
    {
        $this->mailer = $this->prophesize(MailerInterface::class);
        $this->event  = $this->prophesize(Register::class);

        $this->rule = new SendRegistrationEmail($this->mailer->reveal(), self::MAIL_SENDER);
    }

    public function testItExitEarlyIfEventIsntRegister()
    {
        $event = $this->prophesize(DomainEvent::class);
        $event->getSubject()->shouldNotBeCalled();

        $this->rule->execute($event->reveal());
    }

    public function testItDontSendMailIfSubjectIsntUser()
    {
        $this->event->getSubject()->willReturn(new \stdClass())->shouldBeCalled();
        $this->mailer->send(Argument::any())->shouldNotBeCalled();

        $this->rule->execute($this->event->reveal());
    }

    public function testItSendMailWithGoodParametersToTwig()
    {
        $user = $this->prophesize(User::class);
        $user->getEmail()->willReturn('severus@rogue.fr')->shouldBeCalled();
        $this->event->getSubject()->willReturn($user->reveal())->shouldBeCalled();
        $this->event->getToken()->willReturn('Alohomora');
        $this->mailer->send(Argument::that(function (TemplatedEmail $email) use($user) {
            // Test the context sended to twig
            self::assertEquals(
                [
                    'registrationToken' => 'Alohomora',
                    'user' => $user->reveal(),
                ],
                $email->getContext()
            );

            // Test the recipients
            self::assertEquals(['severus@rogue.fr'], array_map(function (Address $address) {
                return $address->getAddress();
            }, $email->getTo()));

            // Test the from
            self::assertEquals([self::MAIL_SENDER], array_map(function (Address $address) {
                return $address->getAddress();
            }, $email->getFrom()));

            self::assertStringEndsWith('emails/registration.html.twig', $email->getHtmlTemplate());
            self::assertEquals('Vérification de votre mail', $email->getSubject());

            return true;
        }))->shouldBeCalled();

        $this->rule->execute($this->event->reveal());
    }
}
