<?php

namespace Api\Constrollers;

use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetAllStdController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = RepoStudents::getAllStd();
            return new Response(200, [], json_encode($response, JSON_PRETTY_PRINT));
        } catch (Exception) {
            echo 'Houve um erro de comunicação com o banco de dados, por favor verifique os metódos HTTPs';
        }
        http_response_code(404);
        return new Response(404, []);
    }
}
