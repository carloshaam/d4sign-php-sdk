<?php

declare(strict_types=1);

namespace D4Sign\Tag;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Tag\Contracts\TagServiceInterface;

class TagService implements TagServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
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
                "Failed to list tags for document ID $documentId. Error: " . $e->getMessage(),
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
                "Failed to add a tag to document ID $documentId. Error: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeTagFromDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/remove", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Failed to remove a specified tag from document ID $documentId. Error: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAllTagsFromDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/erase");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Failed to remove all tags from document ID $documentId. Error: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addUrgentTagToDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/addurgent");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Failed to add the 'Urgent' tag to document ID $documentId. Error: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeUrgentTagFromDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("tags/$documentId/addremoveurgent");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Failed to remove the 'Urgent' tag from document ID $documentId. Error: " . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
