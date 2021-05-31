<?php

use Api\Helper\JsonSerializer;
use Api\Infra\GlobalConn;
use Api\Model\Student;
use Firebase\JWT\JWT;

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

try {
    $jwt = JWT::decode(
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.InJvbnlAdGVzdGUi.0enzB1l9IG_Ig2ZOUE6MGQv0x3scMxUV0jyD88d_dzo',
        JWTKEY,
        ['HS256']
    );
    if (!$jwt) {
        throw new Exception();
    }
    var_dump($jwt);

} catch (Exception) {
    echo 'Token inválido';
}
