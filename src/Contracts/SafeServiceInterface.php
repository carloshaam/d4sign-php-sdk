<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

interface SafeServiceInterface
{
    public function findAll(): ResponseInterface;

    public function findAllDocumentByIdSafe(string $safeId, int $page = 1): ResponseInterface;

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1): ResponseInterface;

    public function findFolderById(string $safeId): ResponseInterface;

    public function createFolderById(string $safeId, array $fields): ResponseInterface;

    public function updateFolderById(string $safeId, array $fields): ResponseInterface;

    public function createBatche(array $fields): ResponseInterface;

    public function getBalance(): ResponseInterface;
}
