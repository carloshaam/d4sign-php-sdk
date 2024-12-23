<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Safe\Contracts\CreateFolderFieldsInterface;

class RenameFolderFields implements CreateFolderFieldsInterface
{
    private string $folderName;
    private string $uuidFolder;

    /**
     * @param string $folderName Nome da pasta ou subpasta.
     */
    public function __construct(string $folderName, string $uuidFolder)
    {
        $this->folderName = $folderName;
        $this->uuidFolder = $uuidFolder;
    }

    /**
     * Retorna os dados formatados para a API.
     *
     * @return array Dados no formato correto.
     */
    public function toArray(): array
    {
        return [
            'folder_name' => $this->folderName,
            'uuid_folder' => $this->uuidFolder,
        ];
    }
}
