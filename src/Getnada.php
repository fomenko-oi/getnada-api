<?php

namespace Truehero;

use GuzzleHttp\Client;
use Truehero\Entities\Domain;
use Truehero\Entities\Attach\Attach;
use Truehero\Entities\Message\Date;
use Truehero\Entities\Message\Message;

class Getnada
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(?ClientInterface $client = null)
    {
        if(!$client) {
            $client = new CommonClient(1);
        }

        $this->client = $client;
    }

    /**
     * @return Domain[]
     */
    public function domains(): array
    {
        $domains = [];

        foreach($this->client->domains() as $domain) {
            $domains[] = new Domain(
                $domain->_id,
                $domain->name,
                isset($domain->keep) ? (bool)$domain->keep : false
            );
        }

        return $domains;
    }

    /**
     * @param string $email
     * @return Message[]
     */
    public function inbox(string $email): array
    {
        $messages = [];

        foreach($this->client->inbox($email)->msgs as $message) {
            $attaches = [];

            if($message->at) {
                foreach ($message->at as $attach) {
                    $attaches[] = new Attach(
                        $attach->uid,
                        $attach->name,
                        $attach->temp_name,
                        $attach->size,
                        $attach->type
                    );
                }
            }

            $messages[] = new Message(
                $message->uid,
                $message->f,
                $message->ib,
                $message->s,
                new Date($message->r, $message->rf),
                $attaches
            );
        }

        return $messages;
    }

    /**
     * @param Message $message
     * @param Attach $attach
     * @param string $path
     *
     * Save attach by original name
     */
    public function downloadFile(Message $message, Attach $attach, string $path)
    {
        return $this->client->downloadFile(
            $message->getId(),
            $attach->getId(),
            "{$path}/{$attach->getName()}"
        );
    }

    /**
     * @param string $email
     * @return bool
     *
     * Does mailbox has new unread emails
     */
    public function hasNew(string $email): bool
    {
        return (bool)$this->client->mailbox($email)->new;
    }

    /**
     * @param Domain[] $domains
     * @return string
     */
    public function randomEmail(array $domains)
    {
        $domain = $domains[array_rand($domains)];

        return Utils::randomWord() . '@' . $domain->getName();
    }
}
