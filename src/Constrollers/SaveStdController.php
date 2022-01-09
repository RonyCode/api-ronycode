<?php

namespace Api\Constrollers;

use Api\Helper\ResponseError;
use Api\Model\DayStudent;
use Api\Model\Student;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SaveStdController implements RequestHandlerInterface
{
    use ResponseError;

    public function handle(ServerRequestInterface $request): Response
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
            $grade = filter_var($_POST['grade'], FILTER_SANITIZE_STRING);
            $situation = filter_var($_POST['situation'], FILTER_SANITIZE_STRING);
            $datePayment = filter_var($_POST['date_payment'], FILTER_SANITIZE_STRING);
            $dayStudent = filter_var($_POST['day_student'], FILTER_SANITIZE_STRING);
            $contract_number = filter_var($_POST['contract_number'], FILTER_SANITIZE_STRING);

            $student = new Student(
                $id | null,
                $name,
                $phone,
                $email,
                $address,
                $birthday,
                $dayStudent,
                $contract_number,
                $datePayment,
                $grade,
                $situation
            );

            $addUser = (new RepoStudents())->saveStd($student);
            return new Response(200, [], json_encode($addUser, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            $this->responseCatchError('Não autenticado ou error nos verbos HTTPs');
        }
    }
}
