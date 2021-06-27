<?php
declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\User\Model\User;

interface Users
{
    public function save(User $user): void;

    public function findByEmail(string $email): ?User;

    public function findByRegistrationToken(string $registrationToken): ?User;
}
