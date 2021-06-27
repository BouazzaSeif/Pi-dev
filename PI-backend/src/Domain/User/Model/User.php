<?php
declare(strict_types=1);

namespace App\Domain\User\Model;

use App\Domain\User\Model\Events\PasswordChanged;
use Biig\Component\Domain\Model\DomainModel;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\User\Model\Events\Register;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 */
class User extends DomainModel implements UserInterface
{
    const EVENT_PASSWORD_CHANGED = 'password_changed';
    const EVENT_PREPARE_REGISTRATION = 'prepare_registration';
    /**
     * @ORM\Column(type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $registrationToken;

    /**
     * Encoded password
     * @ORM\Column(type="string")
     * @var string
     */
    private $password;

    /**
     * Encoded password
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $emailVerified;

    public function __construct(string $email, string $plainPassword)
    {
        $this->email = $email;
        $this->emailVerified = false;
        $this->setPlainPassword($plainPassword);
    }

    public function setPlainPassword(string $plainPassword): void
    {
        if (empty($plainPassword)) {
            return;
        }

        $event               = new PasswordChanged($this, $plainPassword, function ($password) {
            $this->password = $password;
        });
        $this->dispatch($event, self::EVENT_PASSWORD_CHANGED);
    }

    public function prepareRegistration(): void
    {
        $this->registrationToken = base64_encode(\random_bytes(30));
        $this->dispatch(new Register($this, $this->registrationToken), self::EVENT_PREPARE_REGISTRATION);
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getRegistrationToken(): ?string
    {
        return $this->registrationToken;
    }

    /**
     * @return bool
     */
    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    /**
     * @return void
     */
    public function verifyEmail(): void
    {
        $this->emailVerified = true;
        $this->registrationToken = null;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null; // Use bcrypt of PHP7 (cf security.yaml)
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
