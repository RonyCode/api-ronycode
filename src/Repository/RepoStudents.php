<?php

namespace Api\Repository;

use Api\Helper\ResponseError;
use Api\Helper\ValidateParams;
use Api\Infra\GlobalConn;
use Api\Model\Student;
use Exception;
use JetBrains\PhpStorm\Pure;
use PDO;
use PDOStatement;

class RepoStudents extends GlobalConn implements StudentInterface
{
    use ResponseError;

    public function __construct()
    {
    }

    public function getAllStd(): array
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM students");
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            $student = self::hidrateStdList($stmt);
            return ['data' => $student, 'status' => 'success', 'code' => 200];
        } catch (Exception) {
            $this->responseCatchError("Não foi possível listar todos os alunos");
        }
    }

    private function hidrateStdList(PDOStatement $stmt): array
    {
        $student = [];
        $stdData = $stmt->fetchAll();
        foreach ($stdData as $data) {
            $student[] = self::newObjStudent($data)->dataSerialize();
        }
        return $student;
    }

    #[Pure] private function newObjStudent($data): Student
    {
        $birthday = (new ValidateParams())
            ->dateFormatDbToBr($data['birthday']);
        $registrationDate = (new ValidateParams())
            ->dateFormatDbToBr($data['registration_date']);
        $expiration_date = (new ValidateParams())
            ->dateFormatDbToBr($data['expiration_date']);
        return new Student(
            $data['id'],
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['address'],
            $birthday,
            $data['report'],
            $data['grade'],
            $registrationDate,
            $expiration_date,
            $data['result']
        );
    }

    public function selectStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('SELECT * FROM students WHERE id = :id LIMIT 20');
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $student = self::hidrateStdList($stmt);
                return ['data' => $student, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            $this->responseCatchError("Usuário não encontrado, ou não cadastrado");
        }
    }

    public function saveStd(Student $student): array
    {
        if ($student->getId()) {
            return self::updateStd($student);
        } else {
            return self::addStd($student);
        }
    }

    private function updateStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare(
                'UPDATE students SET 
                    name = :name , phone = :phone, 
                    email = :email, address = :address, 
                    birthday = :birthday,
                    report = :report, grade = :grade, 
                    registration_date = :registration_date,
                    expiration_date = :expiration_date, 
                    result = :result WHERE id = :id'
            );
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $student->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':phone', $student->getPhone(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':email', $student->getEmail(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':address', $student->getAddress(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':birthday', $student->getBirthday(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':report', $student->getReport(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':grade', $student->getGrade(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':registration_date', $student->getRegistrationDate(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':expiration_date', $student->getExpirationDate(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':result', $student->getResult(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return ['data' => true, 'status' => 'success', 'code' => 200];
        } catch (Exception) {
            $this->responseCatchError("Usuário não encontrado, ou já atualizado");
        }
    }

    private function addStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare(
                "INSERT INTO students (
               name, phone, email, 
                address, birthday,report,
                grade, registration_date, 
                expiration_date, result)  VALUES ( 
                                :name, :phone, :email, 
                                :address, :birthday,:report, 
                                :grade, :registration_date,
                                :expiration_date, :result) "
            );
            $stmt->bindValue(':name', $student->getName());
            $stmt->bindValue(':phone', $student->getPhone());
            $stmt->bindValue(':email', $student->getEmail());
            $stmt->bindValue(':address', $student->getAddress());
            $stmt->bindValue(':birthday', $student->getBirthday());
            $stmt->bindValue(':report', $student->getReport());
            $stmt->bindValue(':grade', $student->getGrade());
            $stmt->bindValue(':registration_date', $student->getRegistrationDate());
            $stmt->bindValue(':expiration_date', $student->getExpirationDate());
            $stmt->bindValue(':result', $student->getResult());
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return ['data' => true, 'status' => 'success', 'code' => 200, "message" => "Cadastrado com sucesso!"];
        } catch (Exception) {
            $this->responseCatchError("Usuário já cadastrado ou não pode ser cadastrado com este email, tente novamente.");
        }
    }

    public function deleteStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('DELETE FROM students WHERE id = :id');
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return ['data' => true, 'status' => 'success', 'code' => 200];
        } catch (Exception) {
            $this->responseCatchError("Usuário não encontrado, ou já deletado.");
        }
    }
}
