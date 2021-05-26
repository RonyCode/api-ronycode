<?php

namespace Api\Constrollers;

use Api\Model\Student;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SaveStdController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_var($request->getParsedBody()['id'], FILTER_VALIDATE_INT);
        $name = filter_var($request->getParsedBody()['name'], FILTER_SANITIZE_STRING);
        $phone = filter_var($request->getParsedBody()['phone'], FILTER_SANITIZE_STRING);
        $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_STRING);
        $address = filter_var($request->getParsedBody()['address'], FILTER_SANITIZE_STRING);
        $birthday = filter_var($request->getParsedBody()['birthday'], FILTER_SANITIZE_STRING);
        $report = filter_var($request->getParsedBody()['report'], FILTER_SANITIZE_STRING);
        $grade = filter_var($request->getParsedBody()['grade'], FILTER_SANITIZE_STRING);
        $registrationDate = filter_var($request->getParsedBody()['registration_date'], FILTER_SANITIZE_STRING);
        $expirationDate = filter_var($request->getParsedBody()['expiration_date'], FILTER_SANITIZE_STRING);
        $result = filter_var($request->getParsedBody()['result'], FILTER_SANITIZE_STRING);
        try {
            if ($id === false) {
                $student = new Student(
                    null,
                    $name,
                    $phone,
                    $email,
                    $address,
                    $birthday,
                    $report,
                    $grade,
                    $registrationDate,
                    $expirationDate,
                    $result
                );
                $addUser = RepoStudents::addStd($student);
                return new Response(200, [], json_encode($addUser));
            } else {
                $student = new Student(
                    $id,
                    $name,
                    $phone,
                    $email,
                    $address,
                    $birthday,
                    $report,
                    $grade,
                    $registrationDate,
                    $expirationDate,
                    $result
                );

                $updateStd = RepoStudents::updateStd($student);
                return new Response(200, [], json_encode($updateStd));
            }
        } catch (Exception) {
            echo 'Houve um erro de comunicação com o banco de dados, por favor verifique os verbos HTTPs';
        }
        http_response_code(404);
        return new Response(404, []);
    }
}
