<?php

namespace Api\Repository;

use Api\Helper\ResponseError;
use Api\Helper\ValidateParams;
use Api\Infra\GlobalConn;
use Api\Model\DayStudent;
use Api\Model\Student;
use Exception;
use PDO;
use PDOStatement;

class RepoStudents extends GlobalConn implements StudentInterface
{
    use ResponseError;

    public function __construct()
    {
    }

    public function getAllDayStd()
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM day_student");
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            $stdDayStd = self::hidrateDayStdList($stmt);
            return ['data' => $stdDayStd, 'status' => 'success', 'code' => 200];
        } catch (Exception) {
            $this->responseCatchError("Não foi possível listar todos os dias dos alunos");
        }
    }

    private function hidrateDayStdList(PDOStatement $stmt): array
    {
        $dayStudent = [];
        $dayStdData = $stmt->fetchAll();
        foreach ($dayStdData as $data) {
            $dayStudent[] = self::newObjDayStudent($data)->dataDaySerialize();
        }
        return $dayStudent;
    }

    private function newObjDayStudent($data): DayStudent
    {
        return new DayStudent(
            $data["id_student"],
            $data["name"],
            $data["mon"],
            $data["tue"],
            $data["wed"],
            $data["thu"],
            $data["fri"],
        );

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

    private function newObjStudent($data): Student
    {
        $birthday = (new ValidateParams())
            ->dateFormatDbToBr($data['birthday']);
        $date_payment = (new ValidateParams())
            ->dateFormatDbToBr($data['date_payment']);
        return new Student(
            $data['id'],
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['address'],
            $birthday,
            $data['day_student'],
            $data['contract_number'],
            $date_payment,
            $data['grade'],
            $data['situation']
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

    public function saveStd(Student $student, DayStudent $dayStudent): array
    {
        if ($student->getId()) {
            return self::updateStd($student, $dayStudent);
        } else {
            return self::addStd($student, $dayStudent);
        }
    }

    private function updateStd(Student $student, DayStudent $dayStudent): array
    {
        try {
            $stmt = self::conn()->prepare(
                'UPDATE students SET 
                    name = :name ,
                    phone = :phone, 
                    email = :email, 
                    address = :address, 
                    birthday = :birthday,
                    grade = :grade, 
                    situation  = :situation,
                    date_payment = :date_payment,
                    day_student = :day_student,
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
            $stmt->bindValue(':situation', $student->getSituation(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_payment', $student->getDatePayment(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':day_student', $student->getDayStudent(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':contract_number', $student->getContractNumber(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            self::updDayStudent($dayStudent);
            return ['data' => true, 'status' => 'success', 'code' => 200];
        } catch (Exception) {
            $this->responseCatchError("Usuário não encontrado, email já cadastrado ou aluno já atualizado");
        }
    }

    private function updDayStudent(DayStudent $dayStudent): array
    {
        try {
            $stmt = self::conn()->prepare(
                'UPDATE day_student SET  
                    name = :name,
                    mon = :mon ,
                    tue = :tue ,
                    wed = :wed, 
                    thu = :thu,
                    fri = :fri  WHERE id_student = :id_student'
            );

            $stmt->bindValue(':id_student', $dayStudent->getIdStudent(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $dayStudent->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':mon', $dayStudent->getMon(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':tue', $dayStudent->getTue(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':wed', $dayStudent->getWed(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':thu', $dayStudent->getThu(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':fri', $dayStudent->getFri(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return [
                'data' => true,
                'status' => 'success',
                'code' => 200, "message" => "Dia do aluno cadastrado com sucesso!"
            ];
        } catch (Exception) {
            $this->responseCatchError(
                "Não foi possível atualizar dia do aluno, tente novamente."
            );
        }
    }

    private function addStd(Student $student, DayStudent $dayStudent): array
    {
        try {
            $stmt = self::conn()->prepare(
                "INSERT INTO students (  
                    name, 
                    phone ,
                    email , address , 
                    birthday ,
                    grade , 
                    situation,
                    date_payment ,
                    day_student ,
                    contract_number )  VALUES ( 
                                :name, :phone, :email, 
                                :address, :birthday, 
                                :grade,
                                :situation, :date_payment,:day_student,:contract_number) "
            );
            $stmt->bindValue(':name', $student->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':phone', $student->getPhone(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':email', $student->getEmail(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':address', $student->getAddress(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':birthday', $student->getBirthday(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':grade', $student->getGrade(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':situation', $student->getSituation(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':date_payment', $student->getDatePayment(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':day_student', $student->getDayStudent(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':contract_number', $student->getContractNumber(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            self::addDayStd($dayStudent);
            return ['data' => true, 'status' => 'success', 'code' => 200, "message" => "Cadastrado com sucesso!"];
        } catch (Exception) {
            $this->responseCatchError(
                "Usuário já cadastrado ou não pode ser cadastrado com este email, tente novamente."
            );
        }
    }

    private function addDayStd(DayStudent $dayStudent): array
    {
        try {
            $stmt = self::conn()->prepare(
                "INSERT INTO day_student (  
                    id_student,
                    name,mon ,
                    tue , wed , 
                    thu ,fri 
                    )  VALUES ( :id_student,
                                :name, :mon, 
                                :tue, :wed, 
                                :thu,:fri
                                ) "
            );
            $stmt->bindValue(':id_student', $dayStudent->getIdStudent(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $dayStudent->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':mon', $dayStudent->getMon(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':tue', $dayStudent->getTue(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':wed', $dayStudent->getWed(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':thu', $dayStudent->getThu(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':fri', $dayStudent->getFri(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return [
                'data' => true,
                'status' => 'success', 'code' => 200,
                "message" => "Dia do aluno cadastrado com sucesso!"
            ];
        } catch (Exception) {
            $this->responseCatchError(
                "Não foi possível cadastra dia do aluno, tente novamente."
            );
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
