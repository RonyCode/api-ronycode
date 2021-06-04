<?php


namespace Api\Constrollers;


use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $teste = (array)json_decode(file_get_contents('php://input'), true);
        echo "entrei na home" . json_encode($teste);

        var_dump($teste);
        return new Response(200, [], json_encode($teste));
    }
}
