<?php
declare(strict_types=1);

namespace App\Infrastructure\ORM\User;

use App\Application\Repository\Users;
use App\Domain\User\Model\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

class UserRepository implements Users
{
    /** @var ManagerRegistry */
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function save(User $user): void
    {
        $this->getEm()->persist($user);
        $this->getEm()->flush();
    }

    public function findByEmail(string $email): ?User
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->andWhere('u.emailVerified = true')
            ->setParameter('email', $email)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByRegistrationToken(string $registrationToken): ?User
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('u')
            ->from(User::class, 'u')
            ->where('u.registrationToken = :registrationToken')
            ->andWhere('u.emailVerified = false')
            ->setParameter('registrationToken', $registrationToken)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    private function getEm(): EntityManager
    {
        return $this->registry->getManager();
    }
}
