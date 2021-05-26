<?php

namespace Api\Model;

use Api\Helper\ValidateDate;
use DateTime;
use DateTimeImmutable;
use Exception;

class Student
{
    public function __construct(
        private int|null $id,
        private string|null $name,
        private string|null $phone,
        private string|null $email,
        private string|null $address,
        private string|null $birthday,
        private string|null $report,
        private string|null $grade,
        private string|null $registrationDate,
        private string|null $expirationDate,
        private string|null $result
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getBirthday(): ?string
    {
        $tes = new ValidateDate($this->birthday);
        $data = $tes->toArrayValidateDb();
        return $data;
    }

    public function getPhone(): ?string
    {
        try {
            $regex = "/^\([1-9]{2}\) (?:[2-8]|9[1-9])[0-9]{3}-[0-9]{4}$/";
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
        return self::calcAge($this->birthday);
    }

    private static function calcAge($birthday): string
    {
        try {
            $date =
                DateTimeImmutable::createFromFormat('d/m/Y', $birthday);
            if ($date === false) {
                throw new Exception();
            } else {
                $dateFormated = $date->format('d-m-Y');
                $date = new DateTime($dateFormated);
                $interval = $date->diff(new DateTime(date('Y/m/d')));
                $calcAge = $interval->format('%Y');
                return $calcAge;
            }
        } catch (Exception) {
            echo "Houve um erro nos dados, por favor verifique o formato das datas xx/xx/xxxx <br/>";
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
        $registrationDate = new ValidateDate($this->registrationDate);
        return $registrationDate->toArrayValidateDb();
    }

    public function getExpirationDate(): ?string
    {
        $expirationDate = new ValidateDate($this->expirationDate);
        return $expirationDate->toArrayValidateDb();
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
