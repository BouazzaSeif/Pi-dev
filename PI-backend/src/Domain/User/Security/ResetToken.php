<?php

namespace App\Domain\User\Security;

use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Token;

/**
 * Decorates the Token of library Lcobucci.
 */
class ResetToken
{
    public const MAIL_KEY = 'mail';

    /** @var Token */
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function getEmail()
    {
        return $this->token->getClaim(self::MAIL_KEY);
    }

    public function verify(Signer $signer, $key)
    {
        return $this->token->verify($signer, $key);
    }

    public function __toString()
    {
        return (string) $this->token;
    }
}
