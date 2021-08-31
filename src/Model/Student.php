<?php

namespace Api\Model;

use Api\Helper\ValidateParams;

class Student
{
    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $phone,
        private ?string $email,
        private ?string $address,
        private ?string $birthday,
        private ?string $dateExpiresContract,
        private ?int $contractNumber,
        private ?string $datePayment,
        private ?string $grade,
        private ?string $registrationDate,
        private ?string $situation
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return (new ValidateParams())->validateName($this->name);
    }

    public function getEmail(): ?string
    {
        return (new ValidateParams())->validateEmail($this->email);
    }

    public function getAddress(): ?string
    {
        return (new ValidateParams())->validateAddress($this->address);
    }

    public function getBirthday(): ?string
    {
        return (new ValidateParams())->validateBirthday($this->birthday);
    }

    public function getPhone(): ?string
    {
        return (new ValidateParams())->validatePhone($this->phone);
    }

    public function getAge(): ?string
    {
        return (new ValidateParams())->validateAge($this->birthday);
    }

    public function getDateExpiresContract(): ?string
    {
        return (new ValidateParams())->dateFormatBrToDb($this->dateExpiresContract);
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function getRegistrationDate(): ?string
    {
        return (new ValidateParams())->dateFormatBrToDb($this->registrationDate);
    }


    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function dataSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getDatePayment(): ?string
    {
        return (new ValidateParams())->dateFormatBrToDb($this->datePayment);
    }

    public function getContractNumber(): ?int
    {
        return (new ValidateParams())->validateInteger($this->contractNumber);
    }

}
