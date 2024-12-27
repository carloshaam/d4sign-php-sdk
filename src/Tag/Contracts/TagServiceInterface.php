<?php

declare(strict_types=1);

namespace D4Sign\Tag\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface TagServiceInterface
{
    /**
     * Lista as tags do documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#listar-as-tags-do-documento Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com a lista de cofres.
     */
    public function listTagsByDocument(string $documentId, int $page = 1): HttpResponseInterface;

    /**
     * Adiciona uma tag ao documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#adicionar-tags-no-documento Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Campos da tag a serem adicionados ao documento.
     *
     * @return HttpResponseInterface Retorna a resposta da API indicando o resultado da operação.
     */
    public function addTagToDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove uma tag de um documento especificado.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#remover-tags-do-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento do qual a tag será removida.
     * @param array $fields Os detalhes da tag a ser removida.
     *
     * @return HttpResponseInterface A resposta após tentar remover a tag do documento.
     */
    public function removeTagFromDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove todas as tags associadas a um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#remover-todas-as-tags-do-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento.
     *
     * @return HttpResponseInterface A resposta da API indicando o status da operação.
     */
    public function removeAllTagsFromDocument(string $documentId): HttpResponseInterface;

    /**
     * Adiciona uma tag "Urgent" ao documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#adicionar-tag-urgente-ao-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento.
     *
     * @return HttpResponseInterface A resposta da API indicando o status da operação.
     */
    public function addUrgentTagToDocument(string $documentId): HttpResponseInterface;

    /**
     * Remove a tag "Urgent" de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-3#remover-tag-urgente-do-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento.
     *
     * @return HttpResponseInterface A resposta da API indicando o status da operação.
     */
    public function removeUrgentTagFromDocument(string $documentId): HttpResponseInterface;
}
