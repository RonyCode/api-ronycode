<?php

namespace Api\Helper;

use DateTime;
use DateTimeImmutable;
use Exception;

class ValidateParams
{
    use ResponseError;

    private string $date;

    public function __construct()
    {
    }

    public function dateFormatDbToBr($objDate): string
    {
        try {
            $date = DateTimeImmutable::createFromFormat('Y-m-d', $objDate);
            if (!$date) {
                throw new Exception();
            } else {
                return $date->format('d/m/Y');
            }
        } catch (Exception) {
            $this->responseCatchError("Os dados referente a data dever ser 
            exatamente assim XXXX-XX-XX vindo do banco de dados.");
        }
    }

    public function validateEmail(string $email): string
    {
        try {
            $valitedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            $valitedEmail === false ? throw new Exception() : '';
            return $valitedEmail;
        } catch (Exception) {
            $this->responseCatchError('Email inválido, favor digitar um email válido');
        }
    }

    public function validatePass(string $pass): string
    {
        try {
            $regex = "/^\S*(?=\S{8,})(?=\S*[a-zA-Z])(?=\S*[\d])\S*$/";
            if (!preg_match($regex, $pass, $match)) {
                throw new Exception();
            }
            return $pass;
        } catch (Exception) {
            $this->responseCatchError("Erro, senha dever ter pelo menos 1 letra, 1 numero e no mínimo 8 caracteres.");
        }
    }

    public function validateName(string $name): string
    {
        try {
            if (!ctype_alpha($name)) {
                throw new Exception();
            }
            return $name;
        } catch (Exception) {
            $this->responseCatchError("Digite apenas letras, nome com números ou caracteres especiais não aceito.");

        }
    }

    public function validateAddress(string $address): string
    {
        try {
            if (!ctype_alnum($address)) {
                throw new Exception();
            }
            return $address;
        } catch (Exception) {
            $this->responseCatchError("Digite apenas letras ou numeros, caracteres especiais não serão aceitos");
        }
    }

    public function validatePhone(string $phone): string
    {
        try {
            $regex = "/^\(?[1-9]{2}\)? ?(?:[2-8]|9[1-9])[0-9]{3}\-?[0-9]{4}$/";
            if (!preg_match($regex, $phone, $match)) {
                throw new Exception();
            }
            return $phone;
        } catch (Exception) {
            $this->responseCatchError("Error: numero de Telefone inválido, use exatamente esse formato (99) 99999-9999.");
        }
    }

    public function validateAge(string $birthday): string
    {
        try {
            $this->date = $birthday;
            $date = $this->dateFormatBrToDb($birthday);

            if ($date === null) {
                throw new Exception();
            } else {
                $dateFormated = new DateTime($date);
                $interval = $dateFormated->diff(new DateTime(date('Y/m/d')));
                return $interval->format('%Y');
            }
        } catch (Exception) {
            $this->responseCatchError('"Os dados referente a data dever ser exatamente neste formato XX/XX/XXXX.');
        }
    }

    public function dateFormatBrToDb($objDate): string
    {
        try {
            $date = DateTimeImmutable::createFromFormat('d/m/Y', $objDate);
            if (!$date) {
                throw new Exception();
            } else {
                return $date->format('Y-m-d');
            }
        } catch (Exception) {
            $this->responseCatchError('"Os dados referente a data dever ser exatamente neste formato XX/XX/XXXX.');
        }
    }

    public function validateBirthday(string $birthday): string
    {
        try {
            return $this->dateFormatBrToDb($birthday);
        } catch (Exception) {
            $this->responseCatchError('"Os dados referente a data dever ser exatamente neste formato XX/XX/XXXX.');
        }
    }
}