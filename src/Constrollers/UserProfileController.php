<?php

namespace Api\Constrollers;

use Api\Helper\ResponseError;
use Api\Infra\UploadImages;
use Api\Model\Image;
use Exception;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserProfileController implements RequestHandlerInterface
{
    use ResponseError;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            isset($_GET['id']) ? $idPhoto = filter_var(
                $request->getQueryParams()['id'],
                FILTER_VALIDATE_INT
            )
                : throw new  Exception();
            isset($_FILES) ? $image =
                ($request->withUploadedFiles($_FILES['photo']))->getUploadedFiles()
                : throw new  Exception();


            $img = new Image($image, $idPhoto, 250, 250);
            $imgUploaded = (new UploadImages())->saveImgResized($img, true);
            var_dump($img->getPhotoNameUploaded());
            var_dump($img->getPhotoDir() . $img->getPhotoId());
//            $user = new User($idPhoto, null, null, null);
//            $response    = (new RepoUser())->selectUser($user);

            return new Response(200, [], json_encode($imgUploaded));
        } catch (Exception) {
            $this->responseCatchError('Ocorreu erro ao enviar arquivos,verifique o ID da imagem');
        }
    }
}
