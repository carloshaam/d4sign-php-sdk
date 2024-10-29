<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi\Resources;

use Carloshaam\D4signApi\Config;
use Carloshaam\D4signApi\Exceptions\D4SignApiRequestException;

abstract class AbstractResource implements ResourceInterface
{
    protected Config $config;
    protected array $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    protected function request(
        string $method,
        string $endpoint,
        array $fields = null
    ) {
        $url = $this->getConfig()->getFullApiUrl($endpoint);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());

        if ($fields) {
            $data = json_encode($fields);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new D4SignApiRequestException("cURL Error: {$error}");
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode >= 400) {
            throw new D4SignApiRequestException(
                "HTTP Error: {$httpCode}, Response: {$response}"
            );
        }

        $decodedResponse = json_decode($response);

        if (! is_object($decodedResponse) && ! is_array($decodedResponse)) {
            throw new D4SignApiRequestException('API returned an unexpected response.');
        }

        return $decodedResponse;
    }
}
