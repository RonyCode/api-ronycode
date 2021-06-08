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

    public static function userAuth(User $user)
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $validHash = password_verify($user->getPass(), $row["pass"]);
                if (!$validHash) {
                    throw new Exception();
                }
                return JWT::encode($row['email'], JWTKEY);
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            http_response_code(404);
            return [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                "message" => "Não autenticado, verifique o login novamente"
            ];
        }
    }

    public static function addUser(User $user): array
    {
        try {
            $stmt = self::conn()->prepare(
                "INSERT INTO user (email, pass) VALUES (:email, :pass)"
            );
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':pass', password_hash($user->getPass(), PASSWORD_ARGON2I));
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return ['data' => true, 'status' => 'success', 'code' => 200];
            } else {
                throw new Exception();
            }
        } catch (Exception) {
            echo "ERROR: Usuário já cadastrado ou não pode ser cadastrado com este email, tente novamente <br/>";
            http_response_code(404);
            return ['data' => false, 'status' => 'error', 'code' => 404];
        }
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


}
