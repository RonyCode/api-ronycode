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
        $registration_date = (new ValidateParams())
            ->dateFormatDbToBr($data['registration_date']);
        $date_expires_contract = (new ValidateParams())
            ->dateFormatDbToBr($data['date_expires_contract']);
        $date_payment = (new ValidateParams())
            ->dateFormatDbToBr($data['date_payment']);
        return new Student(
            $data['id'],
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['address'],
            $birthday,
            $date_expires_contract,
            $data['contract_number'],
            $date_payment,
            $data['grade'],
            $registration_date,
            $data['situation'],
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
                    grade = :grade, 
                    registration_date = :registration_date,
                    situation  = :situation,
                    date_payment = :date_payment,
                    date_expires_contract = :date_expires_contract,
                    contract_number = :contract_number
                    WHERE id = :id'
            );
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $student->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':phone', $student->getPhone(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':email', $student->getEmail(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':address', $student->getAddress(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':birthday', $student->getBirthday(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':grade', $student->getGrade(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':registration_date', $student->getRegistrationDate(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':situation', $student->getSituation(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_payment', $student->getDatePayment(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_expires_contract', $student->getDateExpiresContract(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':contract_number', $student->getContractNumber(), PDO::PARAM_STR_CHAR);
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
                      name, 
                    phone ,
                    email , address , 
                    birthday ,
                    grade , 
                    registration_date ,
                    situation,
                    date_payment ,
                    date_expires_contract ,
                    contract_number )  VALUES ( 
                                :name, :phone, :email, 
                                :address, :birthday, 
                                :grade, :registration_date,
                                :situation, :date_payment,:date_expires_contract,:contract_number) "
            );
            $stmt->bindValue(':name', $student->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':phone', $student->getPhone(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':email', $student->getEmail(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':address', $student->getAddress(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':birthday', $student->getBirthday(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':grade', $student->getGrade(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':registration_date', $student->getRegistrationDate(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':situation', $student->getSituation(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_payment', $student->getDatePayment(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_expires_contract', $student->getDateExpiresContract(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':contract_number', $student->getContractNumber(), PDO::PARAM_STR_CHAR);
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
