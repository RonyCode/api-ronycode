<?php

namespace config\routes;

use Api\Constrollers\DeleteStdController;
use Api\Constrollers\ErrorController;
use Api\Constrollers\GetAllStdController;
use Api\Constrollers\LoginController;
use Api\Constrollers\SaveStdController;
use Api\Constrollers\SelectStdController;
use Api\Infra\Router;

$arrServices = [
    '/login' => LoginController::class,
    '/error' => ErrorController::class,
    '/aluno' => GetAllStdController::class,
    '/aluno/id/' . $id => SelectStdController::class,
    '/aluno/salvar' => SaveStdController::class,
    '/aluno/deletar' => DeleteStdController::class,
];

$routes = new Router();
return $service = $routes->addRoute($url, $arrServices);
