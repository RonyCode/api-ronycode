<?php

use Api\Helper\JsonSerializer;
use Api\Infra\GlobalConn;
use Api\Model\Student;
use Api\Helper\ResponseError;


require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../src/Helper/ValidateParams.php";
require __DIR__ . "/../vendor/autoload.php";
//closure ROTAS

//$rotas = function ($name) {
//    echo $name;
//};
//$name = 'Rony';
//
//call_user_func($rotas, $name);
$pdo = GlobalConn::conn();

$niv = new Student(
    null,
    'denis@sd345%$#$==+++<pre/>',
    '(63)981270951',
    'denis@gmail.com',
    'sobradinho 2',
    '17/02/1985',
    'bacharelado em ciencias conabeis',
    'ensino superior',
    "28/05/2021",
    "12/12/2021",
    null
);

//$user = new \Api\Model\User(null, 'rony@gmail.com', '17028PAR');

//var_dump($user->getEmail());
//var_dump($niv->getName());
//var_dump($niv->getBirthday());

