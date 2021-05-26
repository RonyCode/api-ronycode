<?php

namespace config\routes;

use Api\Constrollers\AddStdController;
use Api\Constrollers\DeleteStdController;
use Api\Constrollers\ErrorController;
use Api\Constrollers\GetAllStdController;
use Api\Constrollers\LoginController;
use Api\Constrollers\SaveStdController;
use Api\Constrollers\SelectStdController;
use Api\Constrollers\UpdateStdController;
use Api\Infra\Router;

$arrServices = [
    '/login' => LoginController::class,
    '/error' => ErrorController::class,
    '/aluno' => GetAllStdController::class,
    '/aluno/seleciona/' . $id => SelectStdController::class,
    '/aluno/salva' => SaveStdController::class,
    '/aluno/adiciona' => AddStdController::class,
    '/aluno/deleta' => DeleteStdController::class,
    '/aluno/atualiza' => UpdateStdController::class
];

$routes = new Router();
return $service = $routes->addRoute($url, $arrServices);
