<?php

use Api\Model\Student;

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

$tat = $niv->jsonSerialize();
$tes = $niv->getAge();
$tes1 = $niv->getName();
$tes2 = $niv->getPhone();
$tes3 = $niv->getEmail();
$tes4 = $niv->getAddress();
$tes5 = $niv->getBirthday();
$tes6 = $niv->getReport();
$tes7 = $niv->getGrade();
$tes8 = $niv->getRegistrationDate();
$tes9 = $niv->getExpirationDate();
$tes10 = $niv->getResult();
echo json_encode($tes3);
