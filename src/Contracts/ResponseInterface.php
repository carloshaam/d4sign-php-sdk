<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

interface ResponseInterface
{
    /**
     * Returns the response contents as a decoded array.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Returns the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Returns the response headers.
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Returns `true` if the status code is less than 400.
     *
     * @return bool
     */
    public function ok(): bool;

    /**
     * Returns the string representation of the response.
     *
     * @return string
     */
    public function __toString(): string;
}
