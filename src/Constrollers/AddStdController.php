<?php

namespace Api\Constrollers;

use Api\Model\Student;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddStdController implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = filter_var($request->getParsedBody()['name'], FILTER_SANITIZE_STRING);
        $pass = filter_var($request->getParsedBody()['pass'], FILTER_SANITIZE_STRING);
        try {
            if (is_null($name) || is_null($pass) || $name === '' || $pass === '' || empty($name) || empty($pass)) {
                throw new Exception();
            }

            $student = new Student(null, $name, $pass);
            $addUser = RepoStudents::addStd($student);
            return new Response(200, [], json_encode($addUser));
        } catch (Exception) {
            echo 'Houve um erro de comunicação com o banco de dados, por favor verifique os verbos HTTPs';
        }
        http_response_code(404);
        return new Response(404, []);
    }
}
