<?php

namespace Api\Helper;

class DisplayErrorsOn
{
    /*Mode Dev Display_errors*/

    public static function on(): void
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
}
