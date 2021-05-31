<?php

namespace Api\Constrollers;

use Api\Model\User;
use Api\Repository\RepoUser;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {


        var_dump($_POST);
        try {
            isset($_POST['email']) ? $email = filter_var(
                $request->getParsedBody()['email'],
                FILTER_SANITIZE_EMAIL
            ) : $email = null;
            isset($_POST['pass']) ? $pass = filter_var(
                $request->getParsedBody()['pass'],
                FILTER_SANITIZE_STRING
            ) : $pass = null;
            if ($email === false || $pass == false || $email === null || $pass === null) {
                throw new Exception();
            }
            $user = new User(null, $email, $pass);
            $response = RepoUser::userAuth($user);
            return new Response(200, [], $response['data']);
        } catch (Exception) {
            echo 'Login não autorizado verifique seu login e senha e tente novamente';
        }
//        http_response_code(404);
        return new Response(200, []);
    }
}
