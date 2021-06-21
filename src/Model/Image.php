<?php

namespace Api\Model;

class Image
{
    private ?int $photoId;
    private ?string $photoName;
    private ?string $photoSize;
    private ?string $photoType;
    private ?string $photoExtension;
    private ?string $photoTmpName;
    private ?string $photoDir;
    private ?int $photoError;

    public function __construct($filesPost)
    {
        $this->photoName = pathinfo($filesPost['name'])['basename'];
        $this->photoTmpName = $filesPost['tmp_name'];
        $this->photoType = $filesPost['type'];
        $this->photoExtension = pathinfo($filesPost['name'])['extension'];
        $this->photoDir = DIR_IMG;
        $this->photoSize = $filesPost['size'];
        $this->photoError = $filesPost['error'];
    }

    public function getPhotoId(): ?int
    {
        return $this->photoId;
    }

    public function setPhotoId(?int $photoId): void
    {
        $this->photoId = $photoId;
    }

    public function getPhotoName(): ?string
    {
        return $this->photoName;
    }

    public function getPhotoSize(): ?string
    {
        return $this->photoSize;
    }

    public function getPhotoType(): ?string
    {
        return $this->photoType;
    }

    public function getPhotoExtension(): ?string
    {
        return $this->photoExtension;
    }

    public function getPhotoDir(): ?string
    {
        return $this->photoDir;
    }

    public function getPhotoError()
    {
        switch ($this->photoError) {
            case 0:
                echo 'Arquivo enviado com sucesso!';
                break;
            case 1:
                echo 'O arquivo enviado excede o limite definido na diretiva upload_max_filesize';
                break;
            case 2:
                echo 'O arquivo excede o limite definido em MAX_FILE_SIZE no formulário HTML';
                break;
            case 3:
                echo 'O upload do arquivo foi feito parcialmente';
                break;
            case 4:
                echo 'Nenhum arquivo foi enviado.';
                break;

            case 6:
                echo 'Pasta temporária ausênte.';
                break;
            case 7:
                echo 'Falha em escrever o arquivo em disco';
                break;
        }
        return $this;
    }

    public function getPhotoTmpName(): ?string
    {
        return $this->photoTmpName;
    }
}
