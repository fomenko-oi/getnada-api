<?php

namespace Truehero\Entities\Message;

use Truehero\Entities\Attach\Attach;

class Message
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;
    /**
     * @var string
     */
    private $message;
    /**
     * @var Date
     */
    private $date;
    /**
     * @var Attach[]
     */
    private $attaches;

    public function __construct(
        string $id,
        string $from,
        string $to,
        string $message,
        Date $date,
        array $attaches = []
    ) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
        $this->date = $date;
        $this->attaches = $attaches;
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
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return Date
     */
    public function getDate(): Date
    {
        return $this->date;
    }

    /**
     * @return bool
     *
     * Does message has attached files
     */
    public function hasAttaches()
    {
        return count($this->attaches) > 0;
    }

    /**
     * @return array|Attach[]
     */
    public function getAttaches()
    {
        return $this->attaches;
    }

    /**
     * @return int
     */
    public function countAttaches()
    {
        return count($this->attaches);
    }
}
