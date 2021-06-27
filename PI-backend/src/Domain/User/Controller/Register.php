<?php

declare(strict_types=1);

namespace App\Domain\User\Controller;

use App\Application\Repository\Users;
use App\Domain\User\Form\RegistrationType;
use App\Domain\User\Model\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Json\Json;

class Register
{
    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var Users */
    private $users;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(
        FormFactoryInterface $formFactory,
        Users $users,
        LoggerInterface $logger
    ) {
        $this->formFactory   = $formFactory;
        $this->users = $users;
        $this->logger        = $logger;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $form   = $this->formFactory->create(RegistrationType::class);

        /** @var string $bodyContent */
        $bodyContent = $request->getContent();
        $inputData   = Json::decode($bodyContent, Json::TYPE_ARRAY);
        $form->submit($inputData);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $user->prepareRegistration();
            $this->users->save($user);

            return new JsonResponse([
                'message' => 'User created',
            ]);
        }

        $this->logger->info('A user is struggling to register', ['errors' => (string) $form->getErrors()]);

        return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
    }
}
