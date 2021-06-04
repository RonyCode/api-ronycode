<?php

namespace Api\Model;

use Api\Helper\ValidateDate;
use DateTime;
use Exception;

class Student
{
    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $phone,
        private ?string $email,
        private ?string $address,
        private ?string $birthday,
        private ?string $report,
        private ?string $grade,
        private ?string $registrationDate,
        private ?string $expirationDate,
        private ?string $result
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getBirthday(): ?string
    {
        return (new ValidateDate())->validateDateDb($this->birthday, 'm/d/Y', 'Y-m-d');
    }

    public function getPhone(): ?string
    {
        try {
            $regex = "/^\(?[1-9]{2}\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/";
            if (!preg_match($regex, $this->phone, $match)) {
                throw new Exception();
            }
            return $this->phone;
        } catch (Exception) {
            echo "Erro, numero de Telefone inválido, use exatamente esse formato (99) 99999-9999 <br/> \n ";
            exit();
        }
    }

    public function getAge(): ?string
    {
        try {
            $date = (new ValidateDate())->validateDateDb($this->birthday, 'm/d/Y', 'Y-m-d');
            if ($date === null) {
                throw new Exception();
            } else {
                $dateFormated = new DateTime($date);
                $interval = $dateFormated->diff(new DateTime(date('Y/m/d')));
                return $interval->format('%Y');
            }
        } catch (Exception) {
            echo "Erro, não foi possível pegar a idade atual <br/> \n ";

            exit();
        }
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function getRegistrationDate(): ?string
    {
        return (new ValidateDate())->validateDateDb($this->registrationDate, 'm/d/Y', 'Y-m-d');
    }

    public function getExpirationDate(): ?string
    {
        return (new ValidateDate())->validateDateDb($this->expirationDate, 'm/d/Y', 'Y-m-d');
    }

    public function getResult(): ?string
    {
        return $this->result;
    }
    public function dataSerialize(): array
    {
        return get_object_vars($this);
    }
}
