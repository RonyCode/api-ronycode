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
        try {
            if (!isset($_POST) || $_POST == false || empty($_POST)) {
                throw new Exception();
            }
            isset($_POST['id']) ? $id = filter_var($_POST['id'], FILTER_VALIDATE_INT) : $id = null;
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $birthday = filter_var($_POST['birthday'], FILTER_SANITIZE_STRING);
            $report = filter_var($_POST['report'], FILTER_SANITIZE_STRING);
            $grade = filter_var($_POST['grade'], FILTER_SANITIZE_STRING);
            $registrationDate = filter_var($_POST['registration_date'], FILTER_SANITIZE_STRING);
            $expirationDate = filter_var($_POST['expiration_date'], FILTER_SANITIZE_STRING);
            $result = filter_var($_POST['result'], FILTER_SANITIZE_STRING);

            $student = new Student(
                $id | null,
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
            $addUser = (new RepoStudents())->saveStd($student);
            return new Response(200, [], json_encode($addUser, JSON_UNESCAPED_UNICODE));
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
