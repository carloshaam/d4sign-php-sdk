<?php

declare(strict_types=1);

namespace D4Sign\Services;

class SafeService extends BaseService
{
    public function findAll()
    {
        return $this->get('safes');
    }

    public function findAllDocumentByIdSafe(string $safeId, int $page = 1)
    {
        return $this->get("documents/{$safeId}/safe", ['query' => ['pg' => $page]]);
    }

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1)
    {
        return $this->get("documents/{$safeId}/safe/{$folderId}", ['query' => ['pg' => $page]]);
    }

    public function findFolderById(string $safeId)
    {
        return $this->get("folders/{$safeId}/find");
    }

    public function createFolderById(string $safeId, array $fields)
    {
        return $this->post("folders/{$safeId}/create", [
            'json' => $fields,
        ]);
    }

    public function updateFolderById(string $safeId, array $fields)
    {
        return $this->post("folders/{$safeId}/rename", [
            'json' => $fields,
        ]);
    }

    public function createBatche(array $fields)
    {
        return $this->post('batches', [
            'json' => $fields,
        ]);
    }

    public function getBalance()
    {
        return $this->get('account/balance');
    }
}