<?php

namespace Api\Repository;

use Api\Helper\JwtHandler;
use Api\Helper\ResponseError;
use Api\Helper\TemplateEmail;
use Api\Infra\EmailForClient;
use Api\Infra\GlobalConn;
use Api\Model\User;
use Exception;
use JetBrains\PhpStorm\Pure;
use PDOStatement;

class RepoUser extends GlobalConn implements UserInterface
{
    use ResponseError, TemplateEmail;

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

    public function userAuth(User $user): string
    {
        try {
            $stmt = self::conn()->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindValue(":email", $user->getEmail());
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            $row = $stmt->fetch();
            $validHash = password_verify($user->getPass(), $row["pass"]);
            if ($validHash) {
                return (new JwtHandler())->jwtEncode(
                    'localhost/api-ronycode/public/ by Ronycode',
                    $row['email']
                );
            }
        } catch (Exception) {
            $this->responseCatchError("Não autenticado, area restrita, verifique o login novamente");
        }
    }

    public function recoverPass(User $user): array
    {
        try {
            $stmtUp = self::conn()->prepare(
                "UPDATE user SET hash = :hash, 
                date_hash = :date_hash WHERE email = :email"
            );
            $stmtUp->bindValue(":email", $user->getEmail());
            $stmtUp->bindValue(":hash", password_hash($user->getEmail(), PASSWORD_ARGON2I));
            $stmtUp->bindValue(":date_hash", date('Y-m-d H:i:s'));
            $stmtUp->execute();
            if ($stmtUp->rowCount() <= 0) {
                throw new Exception();
            }
            $stmt = self::conn()->prepare(
                "SELECT * FROM user WHERE email = :email"
            );
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            $row = $stmt->fetch();
            $mail = (new EmailForClient())
                ->add(
                    SUBJET_MAIL,
                    $this->bodyEmail($row['hash']),
                    $row['email'],
                    FROM_NAME_MAIL
                )
                ->send();
            return [
                'data' => $mail,
                'status' => 'success',
                'code' => 201,
                "message" => "Email enviado para recuperar sua senha"
            ];

        } catch (Exception) {
            $this->responseCatchError("Usuário não encontrado, verifique se o email está correto");
        }
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
            if ($stmt->rowCount() <= 0) {
                throw new Exception();
            }
            return [
                'data' => true,
                'status' => 'success',
                'code' => 200,
                "message" => 'Usuário cadastrado com sucesso!'
            ];
        } catch (Exception) {
            $this->responseCatchError(
                'Usuário já cadastrado ou não pode ser cadastrado com este email, tente novamente.'
            );
        }
    }
}
