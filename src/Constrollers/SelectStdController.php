<?php


namespace Api\Constrollers;

use Api\Infra\Router;
use Api\Model\Student;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SelectStdController implements RequestHandlerInterface
{
    public function __construct()
    {
    }

    public function handle($request): ResponseInterface
    {
        $url = Router::normalizeUrl();
        try {
            if (is_null($url) || empty($url)) {
                throw new Exception();
            }
            $student = new Student(
                $url[0],
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            );

            $response = (new RepoStudents())->selectStd($student);
            return new Response(200, [], json_encode($response, JSON_PRETTY_PRINT));
        } catch (Exception) {
            echo 'Houve um erro de comunicação com o banco de dados, por favor verifique os metodos HTTPs';
        }
        http_response_code(404);
        return new Response(404, [], 'error');
    }
}
