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
        $id = filter_var($request->getParsedBody()['id']);

        try {
            if (is_null($id) || $id === '' || empty($id)) {
                throw new Exception();
            }

            $student = new Student($id, null, null, null, null, null, null, null, null, null, null);

            $deleteStd = RepoStudents::deleteStd($student);
            return new Response(200, [], json_encode($deleteStd, JSON_PRETTY_PRINT));
        } catch (Exception) {
            echo 'Houve um erro de comunicação com o banco de dados, por favor verifique os metódos HTTPs';
        }
        http_response_code(404);
        return new Response(404, [], 'error');
    }
}