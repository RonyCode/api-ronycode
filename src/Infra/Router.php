<?php

namespace Api\Infra;

use Api\Helper\CheckAuth;
use Exception;

class Router
{
    private string $path;
    private array $controllers;

    public function __construct()
    {
    }

    public static function normalizeUrl(): array
    {
        $path = $_SERVER["PATH_INFO"] ?? '/';
        $urlArr = array_filter(array_values(explode('/', $path)));
        $url = '/' . implode('/', $urlArr);
        $id = '';
        if (count($urlArr) > 2) {
            $id = $urlArr[3];
        }

        return [$id, $url];
    }

    public function addRoute(string $path, array $controllers, string $nameRouteProtected)
    {
        try {
            $this->path = $path;
            $this->controllers = $controllers;

            foreach ($controllers as $key => $controller) {
                if (array_key_exists($path, $controller)) {
                    if ($key === $nameRouteProtected) {
                        CheckAuth::validToken() ===
                        false ? exit() : '';
                    }
                    return $controller[$path];
                }
            }
        } catch (Exception) {
            http_response_code(404);
            echo json_encode(
                [
                    'data' => false,
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Rota não encontrada'
                ]
            );
        }
    }
}
