<?php

namespace Api\Constrollers;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResetPassController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        var_dump($request->getQueryParams()['hash']);
        var_dump($_GET);

        return new Response(200, [], 'teste');
    }
}
