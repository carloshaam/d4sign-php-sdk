<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Safe\Contracts\CreateFolderFieldsInterface;
use D4Sign\Safe\Contracts\SafeServiceInterface;

class SafeService implements SafeServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listSafes(): HttpResponse
    {
        try {
            return $this->httpClient->get('safes');
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Error listing safes: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsBySafe(string $safeId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$safeId/safe", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing documents from safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsBySafeAndFolder(string $safeId, string $folderId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$safeId/safe/$folderId", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing documents from folder $folderId in safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listFolderBySafe(string $safeId): HttpResponse
    {
        try {
            return $this->httpClient->get("folders/$safeId/find");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error getting folder list from safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createFolder(string $safeId, CreateFolderFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("folders/$safeId/create", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error creating folder in safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renameFolder(string $safeId, CreateFolderFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("folders/$safeId/rename", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error renaming folder in safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createDocumentBatch(array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post('batches', $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Error creating documents in batch: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountBalance(): HttpResponse
    {
        try {
            return $this->httpClient->get('account/balance');
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Error getting account balance: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
