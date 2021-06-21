<?php

namespace Api\Repository;

use Api\Helper\ResponseError;
use Api\Infra\GlobalConn;
use Api\Model\Image;
use Exception;

class RepoImages extends GlobalConn implements ImageInterface
{
    use ResponseError;

    public function __construct()
    {
    }

    public function saveTmpImage(Image $image): array
    {
        try {
            move_uploaded_file($image->getPhotoTmpName(), $this->createDirImages($image));
            return [
                'data' => $image->getPhotoError(),
                'status' => 'success',
                'code' => 201,
                "message" => "Arquivo <strong>" . $image->getPhotoName() . "</strong> . enviado com sucesso!"
            ];
        } catch (Exception) {
            $this->responseCatchError(
                "Arquivo com extensão inválida, verifique o tipo de extensão, para uploads somente .PNG ou .JPEG"
            );
        }
    }

    private function createDirImages(Image $image): string
    {
        try {
            mkdir($image->getPhotoDir() . $image->getPhotoId(), 0777);
            return $image->getPhotoDir()
                . $image->getPhotoId() . '/'
                . md5(rand())
                . '_'
                . $image->getPhotoName();
        } catch (Exception) {
            $this->responseCatchError(
                "Não foi possível localizar diretório, verifique na raiz do diretório, folderName com barra ao final"
            );
        }
    }
}
