<?php

namespace Api\Repository;

use Api\Helper\ResponseError;
use Api\Infra\GlobalConn;
use Api\Infra\UploadImages;
use Api\Model\Image;
use Exception;

class RepoImages extends GlobalConn implements ImageInterface
{
    use ResponseError;

    public function __destruct()
    {

    }

    public function saveImg(Image $image): array
    {
        try {
            //     Create Directory with image before insert into MYSQL AND refresh old images
            //============================================================//
            array_map('unlink', glob("/var/www/html/api-ronycode/uploads/" . $image->getPhotoId() . '/*'));
            (new UploadImages())->saveImgResized($image, true);

            $stmt = self::conn()->prepare(
                'INSERT INTO images_profiles 
                (id_user, photo_name, src, size) 
                VALUES (:id_user, :photo_name, :src, :size )'
            );
            $stmt->bindValue(':id_user', $image->getPhotoId());
            $stmt->bindValue(':photo_name', $image->getPhotoNameRandomized());
            $stmt->bindValue(':src', $image->getPhotoSrc());
            $stmt->bindValue(':size', 'width_' .
                $image->getPhotoCustomWidth() . ' / ' .
                'heigth_' . $image->getPhotoCustomHeight());
            $stmt->execute();
            if ($stmt->rowCount() < 0) {
                throw new Exception();
            }
            $this->refreshImg($image);

            return [
                'data' => $image->getPhotoSrc(),
                'status' => 'success',
                'code' => 201,
                "message" => "Imagem <strong> " . $image->getPhotoName() . " </strong> salva com sucesso!"
            ];
        } catch (Exception) {
            $this->responseCatchError('Imagens com mesmo nome não aceito.');
        }
    }

    public function refreshImg(Image $image): array
    {
        try {
            $stmt = self::conn()->prepare("DELETE FROM images_profiles WHERE photo_name != :photo_name");
            $stmt->bindValue(':photo_name', $image->getPhotoNameRandomized());
            $stmt->execute();
            if ($stmt->rowCount() < 0) {
                throw new Exception();
            }

            return [
                'data' => true,
                'status' => 'success',
                'code' => 201,
                "message" => "Imagem <strong> " . $image->getPhotoNameRandomized() . " </strong> deletada com sucesso!"
            ];

        } catch (Exception) {
            $this->responseCatchError('Não foi possível deletar imagem.');
        }
    }
}
