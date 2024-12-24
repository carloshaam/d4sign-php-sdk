<?php

declare(strict_types=1);

namespace D4Sign\Watcher;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Watcher\Contracts\WatcherServiceInterface;

class WatcherService implements WatcherServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listWatchersToDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->get("watcher/$documentId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Unable to retrieve watchers for the document with ID "%s". Error details: "%s". Ensure that the document ID is valid, the network connection is functioning, and the D4Sign API server is accessible.',
                    $documentId,
                    $e->getMessage(),
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addWatcherToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("watcher/$documentId/add", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Unable to add a watcher to the document with ID "%s". Submitted data: %s. Error details: "%s". Please verify that the document ID and submitted fields are correct. Check the network connection and API accessibility.',
                    $documentId,
                    json_encode($fields),
                    $e->getMessage(),
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeWatcherToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("watcher/$documentId/remove", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to remove the watcher from the document with ID "%s". Submitted data: %s. Error details: "%s". Ensure the document ID and data are accurate, verify the network connection, and check the API server status.',
                    $documentId,
                    json_encode($fields),
                    $e->getMessage(),
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAllWatchersToDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("watcher/$documentId/erase");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to remove all watchers from the document with ID "%s". Error details: "%s". Please confirm that the document ID is correct, check the connection, and ensure the API is accessible.',
                    $documentId,
                    $e->getMessage(),
                ),
                $e->getCode(),
                $e,
            );
        }
    }
}
