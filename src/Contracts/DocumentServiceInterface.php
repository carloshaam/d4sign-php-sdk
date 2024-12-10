<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

interface DocumentServiceInterface
{
    public function findAll(int $page = 1): ResponseInterface;

    public function findById(string $documentId): ResponseInterface;

    public function findDimensionsById(string $documentId): ResponseInterface;

    public function findStatusById(string $statusId, int $page = 1): ResponseInterface;

    public function uploadDocumentByIdSafe(string $safeId, array $fields): ResponseInterface;

    public function uploadRelatedDocumentById(string $documentId, array $fields): ResponseInterface;

    public function addHighlightById(string $documentId, array $fields): ResponseInterface;

    public function sendToSignerById(string $documentId, array $fields): ResponseInterface;

    public function cancelById(string $documentId, array $fields): ResponseInterface;

    public function downloadById(string $documentId, array $fields): ResponseInterface;

    public function resendToSignerById(string $documentId, array $fields): ResponseInterface;

    public function templates(): ResponseInterface;

    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): ResponseInterface;

    public function createDocumentFromWordTemplate(string $documentId, array $fields): ResponseInterface;

    public function generateDownloadLink(string $documentId, array $fields): ResponseInterface;
}
