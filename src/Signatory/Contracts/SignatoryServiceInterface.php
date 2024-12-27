<?php

declare(strict_types=1);

namespace D4Sign\Signatory\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface SignatoryServiceInterface
{
    /**
     * Lista todos os signatários de um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#listar-signat%C3%A1rios-de-um-documento Documentação oficial
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de signatários.
     */
    public function listSignatories(string $documentId): HttpResponseInterface;

    /**
     * Lista todos os grupos associados a um cofre específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#listar-grupos-de-assinaturas Documentação oficial
     *
     * @param string $safeId ID do cofre.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de grupos.
     */
    public function listGroupsBySafe(string $safeId): HttpResponseInterface;

    /**
     * Cria uma lista de signatários para um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#cadastrar-signat%C3%A1rios Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param ListSignatoriesFieldsInterface $fields Dados necessários para criar os signatários.
     *
     * @return HttpResponseInterface Resposta HTTP contendo os dados dos signatários criados.
     */
    public function createSignatoryList(
        string $documentId,
        ListSignatoriesFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Atualiza o e-mail de um signatário em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#alterar-signat%C3%A1rio Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatoryEmailFieldsInterface $fields Dados contendo o novo e-mail do signatário.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatoryEmail(
        string $documentId,
        UpdateSignatoryEmailFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Atualiza o número de SMS de um signatário em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#alterar-n%C3%BAmero-do-sms Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatorySmsNumberFieldsInterface $fields Dados contendo o novo número de SMS.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatorySMSNumber(
        string $documentId,
        UpdateSignatorySmsNumberFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Atualiza o código de acesso de um signatário em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#alterar-c%C3%B3digo-de-acesso-do-signat%C3%A1rio Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatoryAccessCodeFieldsInterface $fields Dados contendo o novo código de acesso.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatoryAccessCode(
        string $documentId,
        UpdateSignatoryAccessCodeFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Remove um signatário de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#remover-signat%C3%A1rio Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param RemoveSignatoryFieldsInterface $fields Dados necessários para identificar o signatário a ser removido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeSignatory(string $documentId, RemoveSignatoryFieldsInterface $fields): HttpResponseInterface;

    /**
     * Adiciona um PIN principal a um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#adicionar-assinatura-posicionada-no-documento-principal-ou-anexo-com-pins-de-rubrica Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados contendo o PIN a ser adicionado.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addMainDocumentPin(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove o PIN principal de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#remover-assinatura-posicionada-ao-documento Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados necessários para identificar o PIN a ser removido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeMainDocumentPin(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Lista os PINs principais de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#listar-assinaturas-posicionadas-ao-documento Documentação oficial
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de PINs.
     */
    public function listMainDocumentPins(string $documentId): HttpResponseInterface;

    /**
     * Adiciona informações ao signatário de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#cadastrar-informa%C3%A7%C3%B5es-do-signat%C3%A1rio Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param CreateSignatoryInformationFieldsInterface $fields Dados contendo as informações adicionais.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addSignatoryInformation(
        string $documentId,
        CreateSignatoryInformationFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Define o tipo de assinatura de um signatário em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#cria%C3%A7%C3%A3o-de-nomenclatura-em-assinar-como Documentação oficial
     *
     * @param string $userId ID do usuário.
     * @param array $fields Dados contendo o tipo de assinatura a ser definido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addSignatorySignatureType(string $userId, array $fields): HttpResponseInterface;

    /**
     * Obtém detalhes de um grupo de signatários associado a um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#listar-detalhes-de-grupo-de-assinatura Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param string $groupId ID do grupo de signatários.
     *
     * @return HttpResponseInterface Resposta HTTP contendo os detalhes do grupo.
     */
    public function getSignatoryGroupDetails(string $documentId, string $groupId): HttpResponseInterface;

    /**
     * Copia o link de assinatura de um signatário específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#copiar-link-de-assinatura Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param string $signatoryId ID do signatário.
     *
     * @return HttpResponseInterface Resposta HTTP contendo o link de assinatura.
     */
    public function copySignatorySubscriptionLink(string $documentId, string $signatoryId): HttpResponseInterface;

    /**
     * Replica a posição da assinatura de um signatário para outros campos do documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#replicar-posi%C3%A7%C3%A3o-de-assinatura-em-todas-as-p%C3%A1ginas-de-um-documento-e-anexo Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados contendo as informações de replicação.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function replicateSignaturePosition(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove posições de assinatura replicadas de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-1#remover-posi%C3%A7%C3%B5es-de-assinatura-replicadas-no-documento-e-anexo Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados necessários para identificar as posições a serem removidas.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeReplicatedSignaturePositions(string $documentId, array $fields): HttpResponseInterface;
}
