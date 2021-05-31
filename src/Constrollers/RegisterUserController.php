<?php

namespace Api\Constrollers;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RegisterUserController implements RequestHandlerInterface
{


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        echo 'entreei no cadastro';
        return new Response(200, []);
    }
}
