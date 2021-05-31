<?php

use Api\Helper\DisplayErrorsOn;
use Api\Infra\Router;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';

/* REMOVE FOR PRODUCTION!!!*/
ini_set('html_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type:application/json');

[$id, $url] = Router::normalizeUrl();

$service = require __DIR__ . '/../config/routes.php';
session_start();

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$request = $creator->fromGlobals();
$classControladora = $service;
/** @var RequestHandlerInterface $controlador */
$controlador = new $classControladora();
$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}


echo $resposta->getBody();
