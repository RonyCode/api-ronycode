<?php

namespace Api\Constrollers;

use Api\Helper\GetParsedBodyJson;
use Api\Model\User;
use Api\Repository\RepoUser;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RegisterLoginController implements RequestHandlerInterface
{


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $_POST = (new GetParsedBodyJson())->getParsedPost($request);
        try {
            if (!isset($_POST['data']) === false) {
                throw new Exception();
            }
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
            $user = new User(null, $email, $pass);
            $response = (new RepoUser())->addUser($user);
            return new Response(200, [], json_encode($response, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            http_response_code(404);
            $response = [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Não autenticado ou error nos verbos HTTPs'
            ];
            return new Response(200, [], json_encode($response, JSON_UNESCAPED_UNICODE));
        }
    }
}
