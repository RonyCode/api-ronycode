<?php

use Api\Infra\GlobalConn;
use Api\Model\User;

require __DIR__ . "/../src/Model/Student.php";
require __DIR__ . "/../vendor/autoload.php";

$use = new User(null, 'RONY ANDERSON', null, null, null);

$dayStudent = explode(",", $_POST["day_student"]);
$idStudent = $_POST["id_student"];
$student = $_POST["name"];

foreach ($dayStudent as $item) {
    if (str_contains($item, "seg")) {
        $arrSeg[] = $item;
        $seg = implode(",", $arrSeg);
    }
    if (str_contains($item, "ter")) {
        $arrTer[] = $item;
        $ter = implode(",", $arrTer);
    }
    if (str_contains($item, "qua")) {
        $arrQua[] = $item;
        $qua = implode(",", $arrQua);
    }
    if (str_contains($item, "qui")) {
        $arrQui[] = $item;
        $qui = implode(",", $arrQui);
    }
    if (str_contains($item, "sex")) {
        $arrSex[] = $item;
        $sex = implode(",", $arrSex);
    }
}
var_dump($seg);
var_dump($ter);
var_dump($qua);
var_dump($qui);
var_dump($sex);

$pdo = new GlobalConn();
$stmt = $pdo::conn();

$stmt1 = $stmt->prepare(
    "INSERT INTO day_student
    ( id_student, name, mon, tue, wed, thu, fri)
    VALUES
           (:id_student,
            :name,:mon,
            :tue,:wed,
            :thu,:fri)"
);
$stmt1->bindValue(":id_student", $idStudent);
$stmt1->bindValue(":name", $student);
$stmt1->bindValue(":mon", $seg);
$stmt1->bindValue(":tue", $ter);
$stmt1->bindValue(":wed", $qua);
$stmt1->bindValue(":thu", $qui);
$stmt1->bindValue(":fri", $sex);
$stmt1->execute();
