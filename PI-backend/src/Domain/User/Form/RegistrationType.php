<?php
declare(strict_types=1);

namespace App\Domain\User\Form;

use App\Application\Repository\Users;
use App\Domain\User\Model\User;
use Biig\Component\Domain\Model\Instantiator\Instantiator;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordRequirements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RegistrationType extends AbstractType
{
    /** @var Users */
    private $users;

    /** @var Instantiator */
    private $domainInstantiator;

    public function __construct(Users $users, Instantiator $domainInstantiator)
    {
        $this->users = $users;
        $this->domainInstantiator = $domainInstantiator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'constraints' => [
                    new Callback(function (?string $email, ExecutionContextInterface $executionContext) {
                        if (empty($email)) {
                            return;
                        }

                        if (null !== $this->users->findByEmail($email)) {
                            $executionContext->addViolation('registration.email.already_register');
                        }
                    }),
                    new NotBlank([
                        'message' => 'registration.email.empty',
                    ]),
                    new Email([
                        'message' => 'registration.email.invalid',
                    ]),
                ],
            ])
            ->add('plainPassword', TextType::class, [
                'mapped'      => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'registration.plainPassword.empty',
                    ]),
                    new PasswordRequirements([
                        'minLength'             => 4,
                        'tooShortMessage'       => 'registration.plainPassword.tooShortMessage',
                        'requireNumbers'        => true,
                        'missingNumbersMessage' => 'registration.plainPassword.missingNumbersMessage',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class'      => User::class,
            'empty_data'      => function (FormInterface $form) {
                return $this->domainInstantiator->instantiateWithArguments(
                    User::class,
                    $form->get('email')->getData(),
                    $form->get('plainPassword')->getData()
                );
            },
        ]);
    }
}
