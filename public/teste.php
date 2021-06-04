<?php

use Api\Helper\JsonSerializer;
use Api\Infra\GlobalConn;
use Api\Model\Student;

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
$data = file_get_contents("php://input", false, stream_context_get_default(), 0, $_SERVER["CONTENT_LENGTH"]);
$data1 = json_decode($data);
var_dump($data1);


//$test2 = explode(':', $data);
//$test3 = explode(',', $test2[1]);
//$email = str_replace("\"",'', $test3[0]);
//$pass = str_replace("\"",'', $test3[1]);
//var_dump($email);
//var_dump($pass  );

$params = (array)json_decode(file_get_contents('php://input'), true);
var_dump($params);

