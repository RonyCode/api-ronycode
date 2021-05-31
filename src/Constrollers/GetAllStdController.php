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
//            var_dump();
//            if (!CheckAuth::validToken()) {
//                throw new Exception();
//            }
            $response = (new RepoStudents())->getAllStd();
            return new Response(200, [], json_encode($response, JSON_PRETTY_PRINT));
        } catch (Exception) {
            echo 'Usuário não autenticado ou problema com banco de dados , 
            favor entrar em contato com admintrador do site!';
        }
        http_response_code(404);
        return new Response(404, []);
    }
}
