<?php

namespace Api\Model;

class Student
{
    public function __construct(
        public int|null $id,
        public string $name,
        public string $pass
    ) {
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'password' => $this->pass
        ];
    }
}
