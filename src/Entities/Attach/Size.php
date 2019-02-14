<?php

namespace Truehero\Entities\Attach;

use Truehero\Utils;

class Size
{
    /**
     * @var int
     */
    private $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function format()
    {
        return Utils::formatBytes($this->size);
    }
}
