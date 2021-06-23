<?php

namespace config\routes;

use Api\Constrollers\AuthController;
use Api\Constrollers\DeleteStdController;
use Api\Constrollers\ErrorController;
use Api\Constrollers\GetAllStdController;
use Api\Constrollers\RecoverPassController;
use Api\Constrollers\RegisterLoginController;
use Api\Constrollers\ResetPassController;
use Api\Constrollers\SaveStdController;
use Api\Constrollers\SelectStdController;
use Api\Constrollers\UserProfileController;
use Api\Infra\Router;

$routesProtected = 'Protected';
$arrayRotas = [
    "routes" => [
        '/login' => AuthController::class,
        '/login/cadastrar' => RegisterLoginController::class,
        '/login/recuperar' => RecoverPassController::class,
        '/login/resetar' => ResetPassController::class,
        '/error' => ErrorController::class
    ],
    $routesProtected => [
        '/aluno' => GetAllStdController::class,
        '/aluno/id/' . $id => SelectStdController::class,
        '/aluno/salvar' => SaveStdController::class,
        '/aluno/deletar' => DeleteStdController::class,
        '/usuario/perfil' => UserProfileController::class

    ],
];
return (new Router())->addRoute($url, $arrayRotas, $routesProtected);
