<?php

declare(strict_types=1);

namespace D4Sign\Webhook\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface WebhookServiceInterface
{
    /**
     * Lista webhooks associados a um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/listar-webhook-de-um-documento#listar-webhook-de-um-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento para o qual os webhooks devem ser listados.
     *
     * @return HttpResponseInterface Retorna uma resposta HTTP contendo a lista de webhooks para o documento especificado.
     */
    public function listWebhookToDocument(string $documentId): HttpResponseInterface;

    /**
     * Cria um webhook e o associa a um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/cadastrar-webhook-em-um-documento#cadastrar-webhook-em-um-documento Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento ao qual o webhook será vinculado.
     * @param array $fields Um array associativo contendo os detalhes de configuração do webhook.
     *
     * @return HttpResponseInterface Retorna uma resposta HTTP indicando o resultado do processo de criação do webhook.
     */
    public function createWebhookToDocument(string $documentId, array $fields): HttpResponseInterface;
}
