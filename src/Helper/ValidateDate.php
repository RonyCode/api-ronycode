<?php

namespace Api\Helper;

use DateTimeImmutable;
use Exception;

class ValidateDate
{
    private string $date;

    public function __construct(private string|null $dateForDb)
    {
        try {
            $date = DateTimeImmutable::createFromFormat('d/m/Y', $this->dateForDb);
            if (!$date) {
                throw new Exception();
            } else {
                $this->date = $date->format('Y-m-d');
                return $date;
            }
        } catch (Exception) {
            echo "Houve um erro nos dados, por favor verifique o formato da data dever ser exatamente XX/XX/XXXX <br/>";
            return "error";
        }
    }

    public function toArrayValidateDb(): ?string
    {
        return $this->date;
    }
}
