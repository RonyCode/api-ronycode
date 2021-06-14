<?php

namespace Api\Constrollers;

use Api\Helper\ResponseError;
use Api\Model\User;
use Api\Repository\RepoUser;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthController implements RequestHandlerInterface
{
    use ResponseError;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        try {
            if (!isset($_POST) || $_POST == false || empty($_POST)) {
                throw new Exception();
            }
            $email = filter_var($request->getParsedBody()['email'], FILTER_VALIDATE_EMAIL);
            $pass = filter_var($request->getParsedBody()['pass'], FILTER_SANITIZE_STRING);
            $user = new User(null, $email, $pass);
            $response = (new RepoUser())->userAuth($user);
            return new Response(200, [], json_encode($response, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            $this->responseCatchError('Não autenticado ou error nos verbos HTTPs');
            exit;
        }
    }
}
