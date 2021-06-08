<?php

namespace Api\Constrollers;

use Api\Model\User;
use Api\Repository\RepoUser;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RecoverPassController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = $_POST['email'];
        $user = new User(null, $email, null);
        $response = (new RepoUser())->recoverPass($user);
        return new Response(200, []);
    }
}
