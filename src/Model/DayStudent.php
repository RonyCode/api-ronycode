<?php

namespace Api\Model;

class DayStudent
{
    public function __construct(
        private ?int $idStudent,
        private ?string $name,
        private ?string $mon,
        private ?string $tue,
        private ?string $wed,
        private ?string $thu,
        private ?string $fri,
    ) {
    }


    /**
     * @return int|null
     */
    public function getIdStudent(): ?int
    {
        return $this->idStudent;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getMon(): ?string
    {
        return $this->mon;
    }

    /**
     * @return string|null
     */
    public function getTue(): ?string
    {
        return $this->tue;
    }

    /**
     * @return string|null
     */
    public function getWed(): ?string
    {
        return $this->wed;
    }

    /**
     * @return string|null
     */
    public function getThu(): ?string
    {
        return $this->thu;
    }

    /**
     * @return string|null
     */
    public function getFri(): ?string
    {
        return $this->fri;
    }
    public function dataDaySerialize(): array
    {
        return get_object_vars($this);
    }
}
