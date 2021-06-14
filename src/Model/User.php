<?php

namespace Api\Model;

use Api\Helper\ValidateParams;

class User
{
    public function __construct(
        private ?int $id,
        private ?string $email,
        private ?string $pass,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return (new ValidateParams())->validateEmail($this->email);
    }

    public function getPass(): ?string
    {
        return (new ValidateParams())->validatePass($this->pass);
    }

    public function dataSerialize(): array
    {
        return get_object_vars($this);
    }
}
