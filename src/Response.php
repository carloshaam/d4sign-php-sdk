<?php

declare(strict_types=1);

namespace D4Sign;

class Response
{
    protected int $statusCode;
    protected $content;
    protected $headers;

    public function __construct(int $statusCode, $content, $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return json_decode($this->content, true);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function ok(): bool
    {
        return $this->getStatusCode() < 400;
    }

    public function __toString(): string
    {
        return '[Response] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }
}
