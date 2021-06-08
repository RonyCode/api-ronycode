<?php

namespace Api\Infra;

class Router
{
    private $path;
    private $controllers;
    private $controllersProtected;

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

    public function addRoute($path, array $controllers)
    {
        $this->path = $path;
        $this->controllers = $controllers;

        if (!array_key_exists($path, $controllers) && !array_values($controllers)) {
            header('Location: /api-ronycode/public/error');
        }
        return $controllers[$path];
    }
}
