<?php

declare(strict_types=1);

namespace D4Sign\Tag;

use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Tag\Contracts\TagServiceInterface;

class TagService implements TagServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listTagsByDocument(string $documentId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("tags/$documentId", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing tags from document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addTagToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/add", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding tag to document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeTagToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/remove", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing tag from $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
