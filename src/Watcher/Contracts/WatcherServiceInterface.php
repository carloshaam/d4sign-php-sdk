<?php

declare(strict_types=1);

namespace D4Sign\Watcher\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface WatcherServiceInterface
{
    /**
     * Lista os "watchers" associados a um determinado documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-5#listar-observadores-do-documento Documentação oficial
     *
     * @param string $documentId O ID do documento a ser consultado.
     *
     * @return HttpResponseInterface A resposta HTTP contendo a lista de watchers.
     */
    public function listWatchersToDocument(string $documentId): HttpResponseInterface;

    /**
     * Adiciona "watcher" a um determinado documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-5#adicionar-observador-no-documento Documentação oficial
     *
     * @param string $documentId O ID do documento ao qual os watchers serão adicionados.
     * @param array $fields Os dados dos watchers a serem adicionados.
     *
     * @return HttpResponseInterface A resposta HTTP indicando o sucesso ou falha da operação.
     */
    public function addWatcherToDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove "watcher" específicos de um determinado documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-5#remover-observador-do-documento Documentação oficial
     *
     * @param string $documentId O ID do documento do qual os watchers serão removidos.
     * @param array $fields Os dados dos watchers a serem removidos.
     *
     * @return HttpResponseInterface A resposta HTTP indicando o sucesso ou falha da operação.
     */
    public function removeWatcherToDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove todos os "watchers" de um determinado documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-5#remover-todos-os-observadores-do-documento Documentação oficial
     *
     * @param string $documentId O ID do documento do qual todos os watchers serão removidos.
     *
     * @return HttpResponseInterface A resposta HTTP indicando o sucesso ou falha da operação.
     */
    public function removeAllWatchersToDocument(string $documentId): HttpResponseInterface;
}
