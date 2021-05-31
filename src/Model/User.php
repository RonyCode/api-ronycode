<?php

namespace Api\Model;

class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $pass,
        private string|null $recoverPass
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getRecoverPass(): ?string
    {
        return $this->recoverPass;
    }
}
