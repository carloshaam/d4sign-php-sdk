<?php

declare(strict_types=1);

namespace D4Sign\Document\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface DocumentServiceInterface
{
    /**
     * Lista todos os documentos disponíveis.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#listar-todos-os-documentos Documentação oficial
     *
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos listados.
     */
    public function listDocuments(int $page = 1): HttpResponseInterface;

    /**
     * Obtém os detalhes de um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#listar-um-documento-espec%C3%ADfico Documentação oficial
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Retorna a resposta da API com os detalhes do documento.
     */
    public function getDocumentDetails(string $documentId): HttpResponseInterface;

    /**
     * Obtém as dimensões de um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#get-documentsuuid-documentdimensions Documentação oficial
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Retorna as dimensões do documento em formato JSON.
     */
    public function getDocumentDimensions(string $documentId): HttpResponseInterface;

    /**
     * Lista documentos com base na fase especificada.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#listar-todos-os-documentos-de-uma-fase Documentação oficial
     *
     * @param int $statusId ID da fase.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna os documentos que correspondem à fase informada.
     */
    public function listDocumentsByPhase(int $statusId, int $page = 1): HttpResponseInterface;

    /**
     * Faz o upload de um novo documento para um cofre específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#upload-de-um-documento-principal Documentação oficial
     *
     * @param string $safeId ID do cofre onde o documento será enviado.
     * @param UploadDocumentFieldsInterface $fields Objeto contendo os dados necessários para o upload.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o upload do documento.
     */
    public function uploadDocumentToSafe(string $safeId, UploadDocumentFieldsInterface $fields): HttpResponseInterface;

    /**
     * Faz o upload de um documento relacionado a um documento existente.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#upload-de-um-documento-anexo-ao-principal Documentação oficial
     *
     * @param string $documentId ID do documento principal onde o documento será enviado.
     * @param UploadDocumentFieldsInterface $fields Objeto contendo os dados necessários para o upload.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o upload.
     */
    public function uploadRelatedDocument(
        string $documentId,
        UploadDocumentFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Adiciona um destaque em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#destacar-cl%C3%A1usulas Documentação oficial
     *
     * @param string $documentId ID do documento ao qual será adicionado o destaque.
     * @param HighlightFieldsInterface $fields Objeto contendo os dados necessários para o destaque.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a adição do destaque.
     */
    public function addDocumentHighlight(string $documentId, HighlightFieldsInterface $fields): HttpResponseInterface;

    /**
     * Envia um documento para os signatários.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#enviar-documento-para-assinatura Documentação oficial
     *
     * @param string $documentId ID do documento a ser enviado.
     * @param SendToSignersFieldsInterface $fields Objeto contendo os dados necessários para envio aos signatários.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o envio.
     */
    public function sendDocumentToSigners(
        string $documentId,
        SendToSignersFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Cancela um documento em processo de assinatura.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#cancelar-um-documento Documentação oficial
     *
     * @param string $documentId ID do documento a ser cancelado.
     * @param CancelDocumentFieldsInterface $fields Objeto contendo os dados de cancelamento.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o cancelamento.
     */
    public function cancelDocument(string $documentId, CancelDocumentFieldsInterface $fields): HttpResponseInterface;

    /**
     * Faz o download de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-de-um-documento Documentação oficial
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-em-formato-pdfa Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param DownloadDocumentFieldsInterface|null $fields Configurações do download (como formato ou opções adicionais).
     *
     * @return HttpResponseInterface Retorna uma URL final para download do documento.
     */
    public function downloadDocument(
        string $documentId,
        ?DownloadDocumentFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Reenvia o documento para os signatários.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#reenviar-link-de-assinatura Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados do reenvio (e-mails, mensagens, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API após o reenvio.
     */
    public function resendDocumentToSigners(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Lista os modelos de documentos disponíveis.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#listar-templates Documentação oficial
     *
     * @return HttpResponseInterface Retorna a lista de modelos cadastrados.
     */
    public function listTemplates(): HttpResponseInterface;

    /**
     * Cria um documento a partir de um modelo HTML.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#documento-a-partir-do-template-html Documentação oficial
     *
     * @param string $documentId ID do modelo.
     * @param array $fields Dados necessários para preencher o modelo.
     *
     * @return HttpResponseInterface Retorna a resposta da API com o novo documento criado.
     */
    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Cria um documento a partir de um modelo Word.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#documento-a-partir-do-template-word Documentação oficial
     *
     * @param string $documentId ID do modelo.
     * @param array $fields Dados necessários para preencher o modelo.
     *
     * @return HttpResponseInterface Retorna a resposta da API com o novo documento criado.
     */
    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Faz o download de um arquivo zip com os arquivos preenchido com os campos fornecidos.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-de-documentos-e-certificados-de-assinaturas-desmembrados Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Um array associativo contendo os campos e seus respectivos valores para preenchimento no documento.
     *
     * @return HttpResponseInterface Retorna o documento preenchido no formato apropriado.
     */
    public function downloadDocumentWithFields(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Define as posições X e Y das rubricas em um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#posicionamento-xy-de-rubricas Documentação oficial
     *
     * @param string $safeId ID do cofre.
     * @param array $fields Array contendo os dados das posições das rubricas.
     *
     * @return HttpResponseInterface Retorna a resposta indicando o resultado da operação.
     */
    public function setXYPositionOfHeadingsInDocument(string $safeId, array $fields): HttpResponseInterface;

    /**
     * Gera um link para download de um documento.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-de-um-documento Documentação oficial
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-em-formato-pdfa Documentação oficial
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-documentos-base-64 Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param DownloadDocumentFieldsInterface|null $fields Configurações do link de download (como validade, senha, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API com o link gerado.
     */
    public function generateDocumentDownloadLink(
        string $documentId,
        ?DownloadDocumentFieldsInterface $fields
    ): HttpResponseInterface;

    /**
     * Lista os documentos separados e certificados associados a um documento específico.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#download-de-documentos-e-certificados-de-assinaturas-desmembrados Documentação oficial
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Retorna a lista de documentos separados e certificados associados ao ID fornecido.
     */
    public function listSplitDocumentsAndCertificates(string $documentId): HttpResponseInterface;

    /**
     * Faz o upload de um documento grande associado a um identificador seguro.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#upload-de-big-file---documento-principal-acima-de-20mb Documentação oficial
     *
     * @param string $safeId ID do cofre.
     * @param UploadDocumentFieldsInterface $fields Os campos relacionados ao upload do documento.
     *
     * @return HttpResponseInterface Retorna a resposta HTTP após o processo de upload.
     */
    public function uploadLargeDocument(string $safeId, UploadDocumentFieldsInterface $fields): HttpResponseInterface;

    /**
     * Agenda um documento para assinatura com os campos especificados.
     *
     * @link https://docapi.d4sign.com.br/docs/endpoints-2#agendamento-de-envio-de-documentos-para-assinatura Documentação oficial
     *
     * @param string $documentId ID do documento.
     * @param array $fields Os campos a serem preenchidos ou revisados no documento.
     *
     * @return HttpResponseInterface Retorna a resposta da operação de agendamento.
     */
    public function scheduleDocumentForSignature(string $documentId, array $fields): HttpResponseInterface;
}
