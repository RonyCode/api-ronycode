<?php

use Api\Infra\GlobalConn;
use Api\Model\User;

require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../vendor/autoload.php";

$use = new User(null, 'RONY ANDERSON', null, null, null);

$idStudent = $_POST["id_student"];
$student = $_POST["name"];
$dayStudent = explode(",", $_POST["day_student"]);


//foreach ($dayStudent as $item) {
//    if (str_contains($item, "seg")) {
//        $arrSeg[] = $item;
//        $hour = implode(",", $arrSeg);
//    }
//    if (str_contains($item, "ter")) {
//        $arrTer[] = $item;
//        $ter = implode(",", $arrTer);
//    }
//    if (str_contains($item, "qua")) {
//        $arrQua[] = $item;
//        $qua = implode(",", $arrQua);
//    }
//    if (str_contains($item, "qui")) {
//        $arrQui[] = $item;
//        $qui = implode(",", $arrQui);
//    }
//    if (str_contains($item, "sex")) {
//        $arrSex[] = $item;
//        $sex = implode(",", $arrSex);
//    }
//}


$pdo = new GlobalConn();
$stmt = $pdo::conn();

