<?php

declare(strict_types=1);

namespace D4Sign\Webhook;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Webhook\Contracts\WebhookServiceInterface;

class WebhookService implements WebhookServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listWebhookToDocument(string $documentId): HttpResponseInterface
    {
        try {
            return $this->httpClient->get("documents/$documentId/webhooks");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to fetch webhooks for the document with ID "%s". Possible issues could involve an invalid document ID, a disruption in your network connection, or an issue with the D4Sign API servers. Detailed error message: "%s".',
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
    public function createWebhookToDocument(string $documentId, array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post("documents/$documentId/webhooks", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to create a webhook for the document with ID "%s". The provided payload was: %s. Ensure the document ID is correct and that the required fields are properly formatted. Additionally, double-check your network connection and the availability of the D4Sign API. Error details: "%s".',
                    $documentId,
                    json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
                    $e->getMessage(),
                ),
                $e->getCode(),
                $e,
            );
        }
    }
}
