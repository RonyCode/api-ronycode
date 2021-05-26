<?php

namespace Api\Constrollers;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorController implements RequestHandlerInterface
{
    public function __construct()
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        header('Content-type: text/html; charset=utf-8');

        require __DIR__ . '/../Helper/error404.html';
        http_response_code(404);
        return new Response(404, []);
    }
}
