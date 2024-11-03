<?php

declare(strict_types=1);

namespace D4Sign;

use D4Sign\Exceptions\D4SignApiHttpException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;

class D4SignClient
{
    private string $tokenAPI;
    private string $cryptKey;
    private GuzzleClient $client;

    public function __construct(
        string $tokenAPI,
        string $cryptKey,
        string $baseUrl = 'https://sandbox.d4sign.com.br/api/v1'
    ) {
        $this->tokenAPI = $tokenAPI;
        $this->cryptKey = $cryptKey;
        $this->client = new GuzzleClient([
            'base_uri' => rtrim($baseUrl, '/') . '/',
        ]);
    }

    private function addQueryParams(array $params): array
    {
        return $params;
    }

    private function addHeaders(array $headers): array
    {
        return array_merge($headers, [
            'tokenAPI' => $this->tokenAPI,
            'cryptKey' => $this->cryptKey,
        ]);
    }

    private function requestInternal(array $options = []): array
    {
        $options['query'] = $this->addQueryParams($options['query'] ?? []);
        $options['headers'] = $this->addHeaders($options['headers'] ?? []);

        return $options;
    }

    private function request(string $method, string $uri, array $options = [], $async = false)
    {
        try {
            $options = $this->requestInternal($options);
            $request = new Request($method, $uri, $options['headers'] ?? []);

            if ($async) {
                $response = $this->client->sendAsync($request, $options)->wait();
            } else {
                $response = $this->client->send($request, $options);
            }
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        } catch (\Exception $e) {
            throw new D4SignApiHttpException($e->getMessage(), 0, $e);
        }

        return new Response($response->getStatusCode(), (string) $response->getBody(), $response->getHeaders());
    }

    public function get(string $uri, array $options = []): Response
    {
        return $this->request('GET', $uri, $options);
    }

    public function post(string $uri, array $options = []): Response
    {
        return $this->request('POST', $uri, $options);
    }

    public function postAsync(string $uri, array $options = []): Response
    {
        return $this->request('POST', $uri, $options, true);
    }

    public function put(string $uri, array $options = []): Response
    {
        return $this->request('PUT', $uri, $options);
    }

    public function delete(string $uri, array $options = []): Response
    {
        return $this->request('DELETE', $uri, $options);
    }

    public function options(string $uri, array $options = []): Response
    {
        return $this->request('OPTIONS', $uri, $options);
    }
}
