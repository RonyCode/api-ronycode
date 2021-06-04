<?php

namespace Api\Constrollers;

use Api\Helper\CheckAuth;
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
            $response = (new RepoStudents())->getAllStd();
            return new Response(200, [], json_encode($response, JSON_PRETTY_PRINT));
        } catch (Exception) {
            http_response_code(404);
            $response = [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Não autenticado ou error nos verbos HTTPs'
            ];
            return new Response(404, [], json_encode($response, JSON_PRETTY_PRINT));
        }
    }
}
