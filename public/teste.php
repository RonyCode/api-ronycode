<?php

use Api\Helper\JsonSerializer;
use Api\Infra\GlobalConn;
use Api\Model\User;
use Api\Repository\RepoUser;

require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../src/Helper/ValidateDate.php";
require __DIR__ . "/../vendor/autoload.php";
//closure ROTAS

//$rotas = function ($name) {
//    echo $name;
//};
//$name = 'Rony';
//
//call_user_func($rotas, $name);

$pdo = GlobalConn::conn();

$niv = new User(null, 'rony@teste', '123');
$test = (RepoUser::addUser($niv));


