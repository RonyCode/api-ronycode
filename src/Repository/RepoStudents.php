<?php

namespace Api\Repository;

use Api\Infra\GlobalConn;
use Api\Model\Student;
use Exception;
use PDO;

class RepoStudents extends GlobalConn implements InterfaceStudent
{

    public function __construct()
    {
    }

    public static function getAllStd(): array
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM students");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $student = self::hidrateStdList($stmt, null);
                return ['data' => $student, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            echo "ERROR: Não foi possível executar essa solicitação </br>";
            http_response_code(404);
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
    }

    public static function selectStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('SELECT * FROM students WHERE id = :id LIMIT 20');
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $student = self::hidrateStdList($stmt, $student->getId());
                return ['data' => $student, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            echo "ERROR: Usuário não encontrado, ou não cadastrado </br>";
            http_response_code(404);
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
    }

    private static function hidrateStdList(\PDOStatement $stmt, int $id = null): array
    {
        if ($id) {
            $data = $stmt->fetch();
            $student[] = new Student($data['id'], $data['name'], $data['password']);
            return $student;
        } else {
            $dataStdList = $stmt->fetchAll();
            $student = [];
            foreach ($dataStdList as $data) {
                $student[] = new Student($data['id'], $data['name'], $data['password']);
            }
            return $student;
        }
    }

    public static function addStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('INSERT INTO students (name, password) VALUES (:name, :pass)');
            $stmt->bindValue(':name', $student->getName());
            $stmt->bindValue(':pass', $student->getPass());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['data' => true, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            echo "ERROR: Usuário já cadastrado ou não pode ser cadastrado, tente novamente <br/>";
            http_response_code(404);
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
    }

    public static function deleteStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('DELETE FROM students WHERE id = :id');
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['data' => true, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception('Usuário não encontrado, ou já deletado');
            }
        } catch (Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
    }

    public static function updateStd(Student $student): array
    {
        try {
            $stmt = self::conn()->prepare('UPDATE students SET name = :name , password = :pass WHERE id = :id');
            $stmt->bindValue(':id', $student->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $student->getName(), PDO::PARAM_STR_CHAR);
            $stmt->bindValue(':pass', $student->getPass(), PDO::PARAM_STR_CHAR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['data' => true, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception('Usuário não encontrado, ou já atualizado');
            }
        } catch (Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
    }
}
