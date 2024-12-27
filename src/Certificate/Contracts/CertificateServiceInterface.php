<?php

declare(strict_types=1);

namespace D4Sign\Certificate\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface CertificateServiceInterface
{
    /**
     * Recupera uma lista de certificados associados ao documento especificado.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-4#listar-certificado-definido Documentação oficial
     *
     * @param string $documentId O ID do documento para o qual recuperar certificados.
     *
     * @return HttpResponseInterface A resposta HTTP contendo a lista de certificados.
     */
    public function listCertificates(string $documentId): HttpResponseInterface;

    /**
     * Adiciona um certificado ao documento especificado usando os campos fornecidos.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-4#definir-certificado Documentação oficial
     *
     * @param string $documentId O identificador exclusivo do documento ao qual o certificado será adicionado.
     * @param array $fields Um array associativo contendo os campos necessários para adicionar o certificado.
     *
     * @return HttpResponseInterface Retorna uma resposta HTTP indicando o sucesso ou a falha da operação.
     */
    public function addCertificateToDocument(string $documentId, array $fields): HttpResponseInterface;
}
