<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\UpdateSignatoryAccessCodeFieldsInterface;

class UpdateSignatoryAccessCodeFields implements UpdateSignatoryAccessCodeFieldsInterface
{
    private string $email;
    private ?string $passwordCode = null;
    private ?string $keySigner = null;

    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O e-mail do signatário '$email' não é válido.");
        }

        $this->email = $email;
    }

    public function setPasswordCode(string $passwordCode): self
    {
        $this->passwordCode = $passwordCode;

        return $this;
    }

    public function setKeySigner(string $keySigner): self
    {
        $this->keySigner = $keySigner;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password-code' => $this->passwordCode,
            'key-signer' => $this->keySigner,
        ];
    }
}
