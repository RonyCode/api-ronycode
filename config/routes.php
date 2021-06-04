<?php

namespace config\routes;

use Api\Constrollers\AuthController;
use Api\Constrollers\DeleteStdController;
use Api\Constrollers\ErrorController;
use Api\Constrollers\GetAllStdController;
use Api\Constrollers\HomeController;
use Api\Constrollers\RecoverPassController;
use Api\Constrollers\RegisterLoginController;
use Api\Constrollers\SaveStdController;
use Api\Constrollers\SelectStdController;
use Api\Helper\CheckAuth;
use Api\Infra\Router;

$arrService =
    [
        '/' => HomeController::class,
        '/login' => AuthController::class,
        '/login/cadastrar' => RegisterLoginController::class,
        '/login/recuperar' => RecoverPassController::class,
        '/error' => ErrorController::class,

    ];

//if (CheckAuth::validToken()) {
    $arrServiceProtected =
        [
            '/aluno' => GetAllStdController::class,
            '/aluno/id/' . $id => SelectStdController::class,
            '/aluno/salvar' => SaveStdController::class,
            '/aluno/deletar' => DeleteStdController::class,
        ];
//}
$route = (new Router())->addRoute($url, $arrService);
$routeProtected = (new Router())->addRouteProtected($url, $arrServiceProtected);
$arrRoute = [$routeProtected, $route];
$routeNoNull = array_values(array_filter($arrRoute));
return $routeNoNull[0];
