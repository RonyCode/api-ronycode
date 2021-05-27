<?php

namespace Api\Repository;

use Api\Model\Student;

interface InterfaceStudent
{
    public static function getALlStd(): array;

    public static function selectStd(Student $student): array;

    public static function deleteStd(Student $student): array;

    public static function saveStd(Student $student): array;


}