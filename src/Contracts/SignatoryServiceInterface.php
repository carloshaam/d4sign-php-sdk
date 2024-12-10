<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

interface SignatoryServiceInterface
{
    public function findAll(string $documentId): ResponseInterface;

    public function findGroupsByIdSafe(string $safeId): ResponseInterface;

    public function createSignatoryByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function updateEmailByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function updateSMSNumberByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function updateAccessCodeByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function removeByIdDocument(string $documentId, array $fields): ResponseInterface;

    /*public function addPinByIdMainDocument(string $documentId, array $fields): ResponseInterface;*/

    /*public function removePinByIdMainDocument(string $documentId, array $fields): ResponseInterface;*/

    /*public function findAllPinByIdMainDocument(string $documentId, array $fields): ResponseInterface;*/

    public function addInformationSignatoryByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function addSignatoryTypeByIdDocument(string $documentId, array $fields): ResponseInterface;

    public function findDetailGroupSignatoryByIdDocumentAndIdGroup(string $documentId, string $groupId, array $fields): ResponseInterface;
}
