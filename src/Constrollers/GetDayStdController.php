<?php

namespace Api\Constrollers;

use Api\Helper\ResponseError;
use Api\Repository\RepoStudents;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetDayStdController implements RequestHandlerInterface
{
    use ResponseError;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $getDayStd = (new RepoStudents())->getAllDayStd();
            return new Response(200, [], json_encode($getDayStd, JSON_UNESCAPED_UNICODE));
        } catch (Exception) {
            $this->responseCatchError('Não autenticado ou error nos verbos HTTPs');
        }
    }
}
