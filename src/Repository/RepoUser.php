<?php

namespace Api\Repository;

use Api\Infra\GlobalConn;
use Api\Model\User;
use Exception;
use Firebase\JWT\JWT;
use JetBrains\PhpStorm\Pure;
use PDOStatement;

class RepoUser extends GlobalConn
{
    public function __construct()
    {
    }

    private static function hidrateUserList(PDOStatement $stmt): array
    {
        $user = [];
        $userData = $stmt->fetchAll();
        foreach ($userData as $data) {
            $user[] = self::newObjUser($data)->dataSerialize();
        }
        return $user;
    }

    #[Pure] private static function newObjUser($data): User
    {
        return new User(
            $data['id'],
            $data['email'],
            $data['pass'],
        );
    }

    public function userAuth(User $user)
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $validHash = password_verify($user->getPass(), $row["pass"]);
                if ($validHash) {
                    return JWT::encode($row['email'], JWTKEY);
                }
            }
        } catch (Exception) {
            http_response_code(404);
            return [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                "message" => "Não autenticado, area restrita, verifique o login novamente"
            ];
        }
    }

    public function recoverPass(User $user)
    {
//        try {
        $stmt = self::conn()->prepare(
            "SELECT * FROM user WHERE email = :email"
        );
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $stmtHash = self::conn()->prepare(
                "SELECT * FROM user WHERE expiration_hash < now() - interval 1 day"
            );
            $stmtHash->execute();
            if ($stmtHash->rowCount() > 0) {
                $expirationHash = $stmtHash->fetch();
                $stmtExp = self::conn()->prepare(
                    'UPDATE user SET  
                hash = NULL ,
                expiration_hash = NULL WHERE expiration_hash= :expiration_hash'
                );
                $stmtExp->bindValue(":expiration_hash", $expirationHash['expiration_hash']);
                $stmtExp->execute();
                if ($stmtExp->rowCount() > 0) {
                    echo 'limpei o hash vencido';
                }
                echo 'nao tem hash para limpar';
            }

            $stmtUp = self::conn()->prepare(
                "UPDATE user SET
                hash = :hash, 
                expiration_hash = :expiration_hash 
                WHERE email = :email"
            );

            $stmtUp->bindValue(":email", $user->getEmail());
            $stmtUp->bindValue(":hash", password_hash($user->getEmail(), PASSWORD_ARGON2I));
            $stmtUp->bindValue(":expiration_hash", date('Y-m-d H:i:s'));
            $stmtUp->execute();
            if ($stmt->rowCount() > 0) {
                $validHash = password_verify($row['email'], $row["hash"]);
                if (!$validHash) {
                    throw new Exception();
                }
                echo 'passou segundo if ';
            }
        }
//        } catch (Exception) {
//            http_response_code(404);
//            return [
//                'data' => false,
//                'status' => 'error',
//                'code' => 404,
//                "message" => "Usuário não encontrado, verifique se o email está correto"
//            ];
//        }
    }

    public function addUser(User $user): array
    {
        try {
            $stmt = self::conn()->prepare(
                "INSERT INTO user (email, pass) VALUES(:email, :pass)"
            );
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':pass', password_hash($user->getPass(), PASSWORD_ARGON2I));
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return [
                    'data' => true,
                    'status' => 'success',
                    'code' => 200,
                    "message" => 'Usuário cadastrado com sucesso!'
                ];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            http_response_code(404);
            return [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Usuário já cadastrado ou não pode ser cadastrado com este email, tente novamente.'
            ];
        }
    }
}
