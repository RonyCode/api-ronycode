<?php

namespace Api\Constrollers;

use Api\Model\Image;
use Api\Repository\RepoImages;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserProfileController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        isset($_FILES) ? $image = ($request->withUploadedFiles($_FILES['photo']))->getUploadedFiles() : $image = null;
        var_dump($image);
        $img = new Image($image);
        $img->setPhotoId(1);
        var_dump($img);
        $response = (new RepoImages())->saveTmpImage($img);
        return new Response(200, [], $response);
    }
}