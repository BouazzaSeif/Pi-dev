<?php

namespace App\Domain\User\Security;

use App\Domain\User\Model\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

class ResetTokenGenerator
{
    /** @var Key */
    private $key;

    public function __construct(string $resetTokenSecretKey)
    {
        $this->key = new Key($resetTokenSecretKey);
    }

    public function buildToken(User $user): string
    {
        return (string) (new Builder())
            ->expiresAt((new \DateTime('+3 days'))->getTimestamp())
            ->withClaim(ResetToken::MAIL_KEY, $user->getEmail())
            ->getToken(new Sha256(), $this->key)
        ;
    }

    public function parse(string $token): ResetToken
    {
        return new ResetToken((new Parser())->parse($token));
    }

    public function isValid(ResetToken $token): bool
    {
        return $token->verify(new Sha256(), $this->key);
    }
}
