<?php

namespace Truehero\Entities;

class Domain
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
     * @var boolean
     */
    private $keep;

    public function __construct(string $id,  string $name, bool $keep = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->keep = $keep;
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
     * @return bool
     */
    public function getKeep(): bool
    {
        return $this->keep;
    }

    /**
     * @return bool
     */
    public function isKeep()
    {
        return (bool)$this->getKeep();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'keep' => $this->getKeep(),
        ];
    }
}
