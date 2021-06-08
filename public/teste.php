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

date_default_timezone_set('America/Araguaina');


$stmt = $pdo->prepare(
    "UPDATE user SET
                        hash = :hash, 
                expiration_hash = :expiration_hash 
                WHERE email = :email"
);
var_dump(date('Y-m-d H:i:s'));
$stmt->bindValue(":email", 'rony@teste');
$stmt->bindValue(":hash", password_hash('rony@teste', PASSWORD_ARGON2I));
$stmt->bindValue(":expiration_hash", date('Y-m-d H:i:s'));
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    echo " mudou as infos";
}
