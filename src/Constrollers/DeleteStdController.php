<?php

namespace Api\Constrollers;

use Api\Model\Student;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteStdController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            if (!isset($_POST) || $_POST == false || empty($_POST)) {
                throw new Exception();
            }
            $id = filter_var($request->getParsedBody()['id'], FILTER_SANITIZE_NUMBER_INT);
            $student = new Student($id, null, null, null, null, null, null, null, null, null, null);

            $deleteStd = (new RepoStudents())->deleteStd($student);
            return new Response(200, [], json_encode($deleteStd, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            http_response_code(404);
            echo json_encode([
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Não autenticado ou error nos verbos HTTPs'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}
