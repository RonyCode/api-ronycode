<?php

namespace Api\Model;

class Image
{
    public function __construct(
        private ?int $photoId,
        private ?string $photoName,
        private ?string $photoSize,
        private ?string $photoType,

    )
    {
    }

}