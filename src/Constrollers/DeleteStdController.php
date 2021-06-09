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
        isset($_POST['id']) ? $id = filter_var($request->getParsedBody()['id']) : $id = false;
        try {
            if (is_null($id) || $id === '' || empty($id) || $id === false) {
                throw new Exception();
            }

            $student = new Student($id, null, null, null, null, null, null, null, null, null, null);

            $deleteStd = (new RepoStudents())->deleteStd($student);
            return new Response(200, [], json_encode($deleteStd, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            http_response_code(404);
            $response = [
                'data' => false,
                'status' => 'error',
                'code' => 404,
                'message' => 'Não autenticado ou error nos verbos HTTPs'
            ];
            return new Response(404, [], json_encode($response, JSON_UNESCAPED_UNICODE));
        }
    }
}
