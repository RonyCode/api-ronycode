<?php


namespace Api\Constrollers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        echo 'estou na user';
    }
}