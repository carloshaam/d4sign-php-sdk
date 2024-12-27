<?php

declare(strict_types=1);

namespace D4Sign\Safe\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface SafeServiceInterface
{
    /**
     * Lista todos os cofres disponíveis na conta.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#listar-todos-os-cofres Documentação oficial
     *
     * @return HttpResponseInterface Retorna a resposta da API com a lista de cofres.
     */
    public function listSafes(): HttpResponseInterface;

    /**
     * Lista todos os documentos de um cofre específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#listar-todos-os-documentos-de-um-cofre-ou-pasta Documentação oficial
     *
     * @param string $safeId ID do cofre.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos do cofre.
     */
    public function listDocumentsBySafe(string $safeId, int $page = 1): HttpResponseInterface;

    /**
     * Lista documentos de um cofre numa pasta específica.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#listar-todos-os-documentos-de-um-cofre-ou-pasta Documentação oficial
     *
     * @param string $safeId ID do cofre.
     * @param string $folderId ID da pasta dentro do cofre.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos da pasta.
     */
    public function listDocumentsBySafeAndFolder(
        string $safeId,
        string $folderId,
        int $page = 1
    ): HttpResponseInterface;

    /**
     * Obtém lista de todas as pasta dentro do cofre.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#listar-pastas-do-cofre Documentação oficial
     *
     * @param string $safeId ID do cofre.
     *
     * @return HttpResponseInterface Retorna a resposta da API com os detalhes das pastas.
     */
    public function listFolderBySafe(string $safeId): HttpResponseInterface;

    /**
     * Cria uma nova pasta dentro de um cofre.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#criar-pasta-ou-subpasta-no-cofre Documentação oficial
     *
     * @param string $safeId ID do cofre onde a pasta será criada.
     * @param CreateFolderFieldsInterface $fields Dados necessários para a criação da pasta.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a criação da pasta.
     */
    public function createFolder(string $safeId, CreateFolderFieldsInterface $fields): HttpResponseInterface;

    /**
     * Renomeia uma pasta existente num cofre.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#renomear-pasta-ou-subpasta-do-cofre Documentação oficial
     *
     * @param string $safeId ID do cofre onde a pasta está localizada.
     * @param CreateFolderFieldsInterface $fields Dados necessários para renomear a pasta.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a renomeação.
     */
    public function renameFolder(string $safeId, CreateFolderFieldsInterface $fields): HttpResponseInterface;

    /**
     * Cria documentos em lote num cofre.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#criar-lote Documentação oficial
     *
     * @param array $fields Dados necessários para criar os documentos.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a criação dos documentos.
     */
    public function createDocumentBatch(array $fields): HttpResponseInterface;

    /**
     * Obtém o saldo da conta.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints#exibir-saldo-da-conta Documentação oficial
     *
     * @return HttpResponseInterface Retorna a resposta da API com o saldo disponível.
     */
    public function getAccountBalance(): HttpResponseInterface;
}
