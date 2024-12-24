<?php

declare(strict_types=1);

namespace D4Sign\Certificate;

use D4Sign\Certificate\Contracts\CertificateServiceInterface;
use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Exceptions\D4SignConnectException;

class CertificateService implements CertificateServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listCertificates(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->get("certificate/$documentId/list");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to list certificates for document ID "%s". Error: %s. Please check if the document ID is correct and the server is accessible.',
                    $documentId,
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCertificateToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("certificate/$documentId/add", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to add certificate to document ID "%s". Data submitted: %s. Error: %s. Check if the document ID and data are valid, and try again.',
                    $documentId,
                    json_encode($fields),
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }
}
