<?php

namespace Truehero;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

abstract class AbstractClient
{
    protected $client;
    protected $proxy = null;
    protected $debug = false;
    protected $base_domain = null;
    protected $user_agent = null;
    protected $referer = null;
    protected $cookie_file;
    protected $additionalHeaders = [];

    /**
     * @return string
     */
    public function getUserAgent():? string
    {
        return $this->user_agent;
    }

    /**
     * @param string $user_agent
     */
    public function setUserAgent(string $user_agent): void
    {
        $this->user_agent = $user_agent;
    }

    /**
     * @return string
     */
    public function getReferer():? string
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer(string $referer): void
    {
        $this->referer = $referer;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getProxy() :? string
    {
        return $this->proxy;
    }

    /**
     * @param string $proxy
     */
    public function setProxy(string $proxy): void
    {
        $this->proxy = $proxy;
    }

    /**
     * @return bool
     */
    public function getDebug(): bool
    {
        return (bool)$this->debug;
    }

    /**
     * @param string $name
     */
    public function setCookieFile(string $name): void
    {
        $this->cookie_file = $name;
    }

    /**
     * @return string
     */
    public function getCookieFile() :? string
    {
        return $this->cookie_file;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    /**
     * @return mixed
     */
    public function getBaseDomain() :? string
    {
        return $this->base_domain;
    }

    /**
     * @param string $base_domain
     */
    public function setBaseDomain(string $base_domain): void
    {
        $this->base_domain = $base_domain;
    }

    public function setHeaders(array $headers)
    {
        $this->additionalHeaders = $headers;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (is_null($this->client)) {
            $options = [
                'base_uri' => $this->getBaseDomain(),
                'headers' => [
                    'Referer' => $this->getReferer() ?: $this->getBaseDomain(),
                    'User-Agent' => $this->getUserAgent(),
                    'Connection' => 'keep-alive',
                    'connect_timeout' => 3,
                    'timeout' => 5,
                ]
            ];

            if($this->getBaseDomain()) {
                $options['base_uri'] = $this->getBaseDomain();
                $options['headers']['Host'] = $this->getBaseDomain();
            }

            if($cookie_file = $this->getCookieFile()) {
                $jar = new FileCookieJar($cookie_file, true);
                $options['cookies'] = $jar;
            }

            if ($proxy = $this->getProxy()) {
                $options['proxy'] = $proxy;
            }

            if ($debug = $this->getDebug()) {
                $options['debug'] = $debug;
            }

            if($this->additionalHeaders) {
                foreach($this->additionalHeaders as $header => $value) {
                    $options['headers'][$header] = $value;
                }
            }

            $this->client = new Client($options);
        }
        return $this->client;
    }

    public function sendRequest(string $method, string $uri, array $options = [])
    {
        return $response = $this->getClient()->request($method, $uri, $options);
    }
}
