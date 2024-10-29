<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi\Resources\v1;

use Carloshaam\D4signApi\Config;
use Carloshaam\D4signApi\Exceptions\D4SignApiRequestException;
use Carloshaam\D4signApi\Resources\AbstractResource;

class Documents extends AbstractResource
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * Recupera todos os documentos.
     * O resultado será de 500 documentos por páginas.
     *
     * @return array An array of documents.
     * @throws D4SignApiRequestException
     */
    public function getAll(): array
    {
        return $this->request('GET', 'documents');
    }

    /**
     * Retorna as informações de um documento com base no UUID fornecido.
     *
     * @param string $documentId O UUID do documento.
     *
     * @return array Uma matriz contendo as informações do documento.
     * @throws D4SignApiRequestException
     */
    public function getByUuid(string $documentId): array
    {
        return $this->request('GET', "documents/{$documentId}");
    }

    /**
     * Esse objeto retornara as dimensões por páginas de um documento.
     *
     * @param string $documentId O UUID do documento.
     *
     * @return array Uma matriz contendo as dimensões do documento.
     * @throws D4SignApiRequestException
     */
    public function getDimensionsByUuid(string $documentId): array
    {
        return $this->request('GET', "/documents/{$documentId}/dimensions");
    }

    /**
     * Esse objeto retornará todos os documentos que estiverem na fase informada.
     * O resultado será de 500 documentos por páginas.
     *
     * @return array An array of documents.
     * @throws D4SignApiRequestException
     */
    public function getStatusByUuid(string $stepId): array
    {
        return $this->request('GET', "/documents/{$stepId}/status");
    }

    /**
     * Realizará o UPLOAD do seu documento em um cofre específico, identificado pelo UUID.
     * O documento será criado usando um ID seguro fornecido.
     *
     * @param string $safeId O UUID do cofre onde o documento será criado.
     * @param array{file: string, uuid_folder: string} $fields
     *
     * @return array{uuid: string} Retorna o UUID.
     * @throws D4SignApiRequestException
     */
    public function uploadByUuidSafe(string $safeId, array $fields): array
    {
        return $this->request('POST', "/documents/{$safeId}/upload", $fields);
    }

    /**
     * Realizará o UPLOAD do seu documento para os servidores da D4Sign e ficará anexo ao documento principal.
     * UPLOAD de um documento anexo ao principal
     *
     * @param string $mainDocumentId
     * @param array{file: string} $fields
     *
     * @return array{message: string} Mensagem.
     * @throws D4SignApiRequestException
     */
    public function uploadslaveByUuidMainDocument(string $mainDocumentId, array $fields): array
    {
        return $this->request('POST', "/documents/{$mainDocumentId}/uploadslave", $fields);
    }

    /**
     * Realizará o UPLOAD do seu documento para os servidores da D4Sign e ficará anexo ao documento principal.
     * UPLOAD de um documento principal (Binário)
     *
     * @param string $safeId
     * @param array{
     *     base64_binary_file: string,
     *     mime_type: string,
     *     name: string,
     *     uuid_folder: string
     * } $fields
     *
     * @return array{uuid: string} Retorna o UUID.
     * @throws D4SignApiRequestException
     */
    public function uploadbinaryByUuidSafe(string $safeId, array $fields): array
    {
        return $this->request('POST', "/documents/{$safeId}/uploadbinary", $fields);
    }

    /**
     * Realizará o UPLOAD do seu documento para os servidores da D4Sign e ficará anexo ao documento principal.
     * UPLOAD de um documento anexo ao principal (Binário)
     *
     * @param string $masterDocumentId
     * @param array{
     *     base64_binary_file: string,
     *     mime_type: string,
     *     name: string
     * } $fields
     *
     * @return array{message: string} Mensagem.
     * @throws D4SignApiRequestException
     */
    public function uploadslavebinaryByUuidMasterDocument(string $masterDocumentId, array $fields): array
    {
        return $this->request('POST', "/documents/{$masterDocumentId}/uploadbinary", $fields);
    }

    /**
     * Realizará o UPLOAD do seu documento para os servidores da D4Sign e ficará anexo ao documento principal.
     * UPLOAD de um hash de documento (HASH)
     *
     * @param string $safeId
     * @param array{
     *     sha256: string,
     *     sha512: string,
     *     name: string,
     *     uuid_folder: string
     * } $fields
     *
     * @return array{uuid: string} Retorna o UUID.
     * @throws D4SignApiRequestException
     */
    public function uploadhashByUuidSafe(string $safeId, array $fields): array
    {
        return $this->request('POST', "/documents/{$safeId}/uploadhash", $fields);
    }
}
