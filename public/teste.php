<?php

use Api\Model\Student;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../src/Helper/ValidateDate.php";
//closure ROTAS

//$rotas = function ($name) {
//    echo $name;
//};
//$name = 'Rony';
//
//call_user_func($rotas, $name);

$niv = new Student(
    null,
    'denis',
    '(63) 98127-0951',
    'denis@gmail.com',
    'sobradinho 2',
    '17/02/1985',
    'bacharelado em ciencias conabeis',
    'ensino superior',
    "28/05/2021",
    "12/12/2021",
    null
);

function setTableName($nameTable)
{
    return define(
        'DBNAMES',
        $nameTable
    );
}
setTableName('asdasdad');
var_dump(DBNAME);
var_dump(DBNAMES);