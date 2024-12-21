<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpResponseInterface;

class HttpResponse implements HttpResponseInterface
{
    private int $status;
    private string $body;
    private array $headers;

    public function __construct(int $status, string $body, array $headers)
    {
        $this->status = $status;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getJson(): array
    {
        try {
            return json_decode($this->body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \RuntimeException('Invalid JSON body: ' . $e->getMessage());
        }
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?array
    {
        $key = strtolower($name);
        foreach ($this->headers as $headerName => $headerValue) {
            if (strtolower($headerName) === $key) {
                return (array)$headerValue;
            }
        }

        return null;
    }

    public function hasHeader(string $name): bool
    {
        $key = strtolower($name);
        foreach ($this->headers as $headerName => $headerValue) {
            if (strtolower($headerName) === $key) {
                return true;
            }
        }

        return false;
    }

    public function getContentType(): ?string
    {
        return $this->getHeader('Content-Type')[0] ?? null;
    }

    public function getCookies(): array
    {
        return $this->getHeader('Set-Cookie') ?? [];
    }

    public function isSuccess(): bool
    {
        return $this->status >= 200 && $this->status < 300;
    }

    public function isCreated(): bool
    {
        return $this->status() >= 201 && $this->status() <= 299;
    }

    public function isRedirect(): bool
    {
        return $this->status() >= 300 && $this->status() <= 399;
    }

    public function isClientError(): bool
    {
        return $this->status >= 400 && $this->status < 500;
    }

    public function isServerError(): bool
    {
        return $this->status >= 500;
    }

    public function rawResponse(): array
    {
        return [
            'status' => $this->status(),
            'body' => $this->getBody(),
            'headers' => $this->getHeaders(),
        ];
    }
}
