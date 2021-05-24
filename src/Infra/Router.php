<?php

namespace Api\Infra;

class Router
{
    private $url;
    private $service;

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

    public function addRoute($url, array $service)
    {
        $this->url = $url;
        $this->service = $service;


        if (!array_key_exists($url, $service)) {
            header('Location: /projeto/public/error');
        }
        return $service[$url];
    }
}
