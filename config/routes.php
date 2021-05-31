<?php

namespace config\routes;

use Api\Constrollers\AuthController;
use Api\Constrollers\DeleteStdController;
use Api\Constrollers\ErrorController;
use Api\Constrollers\GetAllStdController;
use Api\Constrollers\RecoverPassController;
use Api\Constrollers\RegisterUserController;
use Api\Constrollers\SaveStdController;
use Api\Constrollers\SelectStdController;
use Api\Infra\Router;

if (true === true) {
    $arrService =
        [
            '/login' => AuthController::class,
            '/login/cadastrar' => RegisterUserController::class,
            '/login/recuperar' => RecoverPassController::class,
            '/error' => ErrorController::class,
            '/aluno' => GetAllStdController::class,
            '/aluno/id/' . $id => SelectStdController::class,
            '/aluno/salvar' => SaveStdController::class,
            '/aluno/deletar' => DeleteStdController::class,
        ];
}
return (new Router())->addRoute($url, $arrService);
