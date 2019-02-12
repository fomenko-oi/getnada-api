<?php

namespace Truehero\Entities\Message;

class Date
{
    const DEFAULT_FORMAT = 'd-m-Y G:i:s';

    /**
     * @var int
     */
    private $timestamp;
    /**
     * @var string
     */
    private $date;

    public function __construct(int $timestamp, string $date)
    {
        $this->timestamp = $timestamp;
        $this->date = $date;
    }

    public function getTextDate()
    {
        return $this->date;
    }

    public function getDate()
    {
        return $this->format(self::DEFAULT_FORMAT);
    }

    public function format($format)
    {
        return date($format, $this->timestamp);
    }
}
