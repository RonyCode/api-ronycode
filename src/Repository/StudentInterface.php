<?php

namespace Api\Repository;

use Api\Model\Student;

interface StudentInterface
{
    public function getALlStd(): array;

    public function selectStd(Student $student): array;

    public function deleteStd(Student $student): array;

    public function saveStd(Student $student): array;
}
