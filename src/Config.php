<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi;

class Config
{
    private string $apiUrl;
    private string $tokenApi;
    private ?string $cryptKey;
    private string $apiVersion;

    const DEFAULT_API_VERSION = 'v1';

    public function __construct(
        string $apiUrl,
        string $tokenApi,
        ?string $cryptKey = null,
        string $apiVersion = self::DEFAULT_API_VERSION
    ) {
        $this->setApiUrl($apiUrl);
        $this->setTokenApi($tokenApi);
        $this->setCryptKey($cryptKey);
        $this->setApiVersion($apiVersion);
    }

    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    public function getTokenApi(): string
    {
        return $this->tokenApi;
    }

    public function setTokenApi(string $tokenApi): void
    {
        $this->tokenApi = $tokenApi;
    }

    public function getCryptKey(): ?string
    {
        return $this->cryptKey;
    }

    public function setCryptKey(?string $cryptKey): void
    {
        $this->cryptKey = $cryptKey;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function setApiVersion(string $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }

    public function getFullApiUrl(string $endpoint): string
    {
        $url = "{$this->getApiUrl()}/{$this->getApiVersion()}/{$endpoint}?tokenAPI={$this->getTokenApi()}";

        if (! empty($this->getCryptKey())) {
            $url .= "&cryptKey={$this->getCryptKey()}";
        }

        return $url;
    }
}
