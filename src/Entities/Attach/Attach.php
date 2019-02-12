<?php

namespace Truehero\Entities\Message;

class Attach
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $temp_name;
    /**
     * @var int
     */
    private $size;
    /**
     * @var string
     */
    private $type;

    public function __construct(
        string $id,
        string $name,
        string $temp_name,
        int $size,
        string $type
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->temp_name = $temp_name;
        $this->size = $size;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTempName(): string
    {
        return $this->temp_name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
