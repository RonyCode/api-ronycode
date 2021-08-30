<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Load Composer's autoloader
require '../vendor/autoload.php';
//

$validate = new \Api\Model\Student(null,null,null,null,null,'17/02/1986','17/02/1986',1234567,'17/02/1800',null,'11/05/2000','17/02/2021','ativo',);

var_dump($validate->getAge());
var_dump($validate->getBirthday());
var_dump($validate->getDateExpiresContract());
var_dump($validate->getDatePayment());
var_dump($validate->getExpirationDate());
var_dump($validate->getRegistrationDate());
