<?php

namespace Api\Helper;

use DateTimeImmutable;
use Exception;

class ValidateDate
{
    private string $date;

    public function __construct()
    {
    }

    public function validateDateDb($objDate, $dateFormatMatch, $dateConverted): string
    {
        try {
            $date = DateTimeImmutable::createFromFormat($dateFormatMatch, $objDate);
            if (!$date) {
                throw new Exception();
            } else {
                return $date->format($dateConverted);
            }
        } catch (Exception) {
            return "Houve um erro nos dados, por favor verifique o formato da data
                dever ser exatamente XX/XX/XXXX <br/>";
        }
    }
}
