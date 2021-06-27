<?php
declare(strict_types=1);

namespace App\Domain\User\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class ProtectedController
{
    public function __invoke()
    {
        return new JsonResponse('Yeaahh, vous avez accès au controller protégé par le firewall de Symfony ! :p');
    }
}
