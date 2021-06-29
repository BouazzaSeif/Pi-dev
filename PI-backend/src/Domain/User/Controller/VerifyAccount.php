<?php
declare(strict_types=1);

namespace App\Domain\User\Controller;

use App\Application\Repository\Users;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyAccount
{
    public const REDIRECT_AFTER_VERIFY = 'http://localhost:4200/home';

    /** @var Users */
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(string $token)
    {
        if (null === ($user = $this->users->findByRegistrationToken($token))) {
            throw new NotFoundHttpException('');
        }

        $user->verifyEmail();
        $this->users->save($user);

        return new RedirectResponse(self::REDIRECT_AFTER_VERIFY);
    }
}
