<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

interface HttpResponseInterface
{
    public function status(): int;

    public function getBody(): string;

    public function getJson(): array;

    public function getHeaders(): array;

    public function getHeader(string $name): ?array;

    public function hasHeader(string $name): bool;

    public function getContentType(): ?string;

    public function getCookies(): array;

    public function isSuccess(): bool;

    public function isCreated(): bool;

    public function isRedirect(): bool;

    public function isClientError(): bool;

    public function isServerError(): bool;

    public function rawResponse(): array;
}
