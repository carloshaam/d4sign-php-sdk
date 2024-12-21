<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Signatory\Contracts\CreateSignatoryInformationFieldsInterface;
use D4Sign\Signatory\Contracts\ListSignatoriesFieldsInterface;
use D4Sign\Signatory\Contracts\RemoveSignatoryFieldsInterface;
use D4Sign\Signatory\Contracts\SignatoryServiceInterface;
use D4Sign\Signatory\Contracts\UpdateSignatoryAccessCodeFieldsInterface;
use D4Sign\Signatory\Contracts\UpdateSignatoryEmailFieldsInterface;
use D4Sign\Signatory\Contracts\UpdateSignatorySmsNumberFieldsInterface;

class SignatoryService implements SignatoryServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listSignatories(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$documentId/list");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing signers for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listGroupsBySafe(string $safeId): HttpResponse
    {
        try {
            return $this->httpClient->get("groups/$safeId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing groups for safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createSignatoryList(string $documentId, ListSignatoriesFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/createlist", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error creating signer list for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryEmail(string $documentId, UpdateSignatoryEmailFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changeemail", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer email in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatorySMSNumber(string $documentId, UpdateSignatorySmsNumberFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changesmsnumber", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer's SMS number in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryAccessCode(string $documentId, UpdateSignatoryAccessCodeFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changepasswordcode", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer access code in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeSignatory(string $documentId, RemoveSignatoryFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removeemaillist", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing signer from document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addpins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding PIN to document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removepins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing PIN from document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listMainDocumentPins(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$documentId/listpins");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing PINs for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatoryInformation(string $documentId, CreateSignatoryInformationFieldsInterface $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addinfo", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding information for signer of document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatorySignatureType(string $userId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$userId/addsignaturetype", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding signature type to signer in user $userId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatoryGroupDetails(string $documentId, string $groupId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$documentId/groupdetails/$groupId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error getting signer group details on document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function copySignatorySubscriptionLink(string $documentId, string $signatoryId): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/signaturelink/$signatoryId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error copying signature link from signatory $signatoryId into document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function replicateSignaturePosition(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addpinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error replicating signature position in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeReplicatedSignaturePositions(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removepinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing replicated signature positions in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
