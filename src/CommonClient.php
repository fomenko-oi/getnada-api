<?php

namespace Truehero;

use GuzzleHttp\Client;

class CommonClient extends AbstractClient implements ClientInterface
{
    const API_BASE_URL = 'https://getnada.com/api/v%d';
    const API_VERSION = 1;

    const DOMAINS_URL = 'domains';
    const INBOX_URL = 'inboxes/%s';
    const DOWNLOAD_FILE_URL = 'file/%s/%s';
    const MAILBOX_URL = 'u/%s/%s';

    public function __construct(int $version = self::API_VERSION)
    {
        $this->setBaseDomain(sprintf(self::API_BASE_URL, $version) . '/');
    }

    /**
     * @return array
     */
    public function domains(): array
    {
        $response = $this->sendRequest('GET', self::DOMAINS_URL);

        return json_decode($response->getBody());
    }

    /**
     * @param string $email
     * @return object
     */
    public function inbox(string $email): object
    {
        $response = $this->sendRequest('GET', sprintf(self::INBOX_URL, $email));

        return json_decode($response->getBody());
    }

    /**
     * @param string $messageId
     * @param string $fileId
     * @param string $path
     *
     * Download attach
     */
    public function downloadFile(string $messageId, string $fileId, string $path)
    {
        $requestUrl = sprintf(self::DOWNLOAD_FILE_URL, $messageId, $fileId);

        $this->sendRequest('GET', $requestUrl, [
            'save_to' => fopen($path, 'w+')
        ]);

        return $path;
    }

    public function mailbox(string $email, $time = null): object
    {
        $url = sprintf(self::MAILBOX_URL, $email, ($time ?: time()));
        $response = $this->sendRequest('GET', $url);

        return json_decode($response->getBody());
    }
}
