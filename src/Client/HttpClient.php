<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Exceptions\D4SginUnauthorizedException;
use D4Sign\Exceptions\D4SignHttpClientException;
use D4Sign\Exceptions\D4SignRuntimeException;
use D4Sign\Utils\HttpCode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient implements HttpClientInterface
{
    private Client $client;
    private array $options;
    private string $bodyFormat;
    private array $defaultOptions;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
        $this->bodyFormat = 'json';
        $this->defaultOptions = [
            'base_uri' => $config['base_uri'] ?? null,
            'headers' => [
                'tokenAPI' => $config['headers']['tokenAPI'] ?? null,
                'cryptKey' => $config['headers']['cryptKey'] ?? null,
            ],
        ];
        $this->options = [
            'http_errors' => false,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function new(array $config = []): self
    {
        return new self($config);
    }

    /**
     * {@inheritdoc}
     */
    public function baseUrl(string $url): self
    {
        $this->defaultOptions['base_uri'] = rtrim($url, '/') . '/';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withOptions(array $options): self
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutRedirecting(): self
    {
        $this->options = array_merge_recursive($this->options, [
            'allow_redirects' => false,
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutVerifying(): self
    {
        $this->options = array_merge_recursive($this->options, [
            'verify' => false,
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function asJson(): self
    {
        $this->bodyFormat('json')->contentType('application/json');

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function asFormParams(): self
    {
        $this->bodyFormat('form_params')->contentType('application/x-www-form-urlencoded');

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function asMultipart(): self
    {
        $this->bodyFormat('multipart');

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function bodyFormat(string $format): self
    {
        $this->bodyFormat = $format;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function contentType(string $contentType): self
    {
        $this->withHeaders(['Content-Type' => $contentType]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function accept(string $header): self
    {
        $this->withHeaders(['Accept' => $header]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withHeaders(array $headers): self
    {
        $this->defaultOptions['headers'] = array_merge(
            $this->defaultOptions['headers'],
            $headers,
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withBasicAuth(string $username, string $password): self
    {
        $this->options = array_merge_recursive($this->options, [
            'auth' => [$username, $password],
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withDigestAuth(string $username, string $password): self
    {
        $this->options = array_merge_recursive($this->options, [
            'auth' => [$username, $password, 'digest'],
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCookies(string $cookies): self
    {
        $this->options = array_merge_recursive($this->options, [
            'cookies' => $cookies,
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function timeout(int $seconds): self
    {
        $this->options['timeout'] = $seconds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $uri, array $params = []): HttpResponseInterface
    {
        return $this->send('GET', $uri, [
            'query' => $params,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $uri, array $params = []): HttpResponseInterface
    {
        return $this->send('POST', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $uri, array $params = []): HttpResponseInterface
    {
        return $this->send('PUT', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $uri, array $params = []): HttpResponseInterface
    {
        return $this->send('DELETE', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function send(string $method, string $uri, array $params = [], array $headers = []): HttpResponseInterface
    {
        try {
            $query = parse_url($uri, PHP_URL_QUERY) ? $this->parseQueryParams($uri) : [];

            $response = $this->client->request(
                $method,
                $uri,
                $this->mergeOptions(['query' => $query], $params),
            );

            if ($response->getStatusCode() === HttpCode::UNAUTHORIZED) {
                throw new D4SginUnauthorizedException('Invalid or expired API key.');
            }

            return new HttpResponse(
                $response->getStatusCode(),
                (string)$response->getBody(),
                $response->getHeaders(),
            );
        } catch (GuzzleException $e) {
            throw new D4SignHttpClientException($e->getMessage(), $e->getCode(), $e);
        } finally {
            $this->resetRequest();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function mergeOptions(...$options): array
    {
        return array_merge_recursive($this->defaultOptions, $this->options, ...$options);
    }

    /**
     * {@inheritdoc}
     */
    public function parseQueryParams(string $url): array
    {
        $query = [];
        $components = parse_url($url);
        if (isset($components['query'])) {
            parse_str($components['query'], $query);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function resetRequest(): void
    {
        $this->options = [
            'http_errors' => false,
        ];
        $this->bodyFormat = 'json';
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $newOptions = []): HttpClientInterface
    {
        $this->defaultOptions = array_merge_recursive($this->defaultOptions, $newOptions);
        $this->options = array_merge_recursive($this->options, $newOptions);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withHandler(callable $handler): HttpClientInterface
    {
        $this->defaultOptions['handler'] = $handler;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function download(string $uri, string $destination): HttpResponseInterface
    {
        try {
            if (! is_writable(dirname($destination))) {
                throw new D4SignRuntimeException("Directory is not writable: " . dirname($destination));
            }

            $this->client->request('GET', $uri, [
                'sink' => $destination,
            ]);

            return new HttpResponse(
                HttpCode::OK,
                sprintf('File downloaded to %s', $destination),
                [],
            );
        } catch (GuzzleException $e) {
            throw new D4SignHttpClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
