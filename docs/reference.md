# Referência do D4Sign SDK para PHP

Abaixo está uma tabela resumindo as classes/interfaces e suas descrições, baseadas nos arquivos fornecidos.

| **Nome da Classe**                    | **Descrição**                                                                                               |
|---------------------------------------|-------------------------------------------------------------------------------------------------------------|
| **`CertificateServiceInterface`**     | Interface que define contrato(s) para serviços relacionados a certificados.                                 |
| **`HttpClientInterface`**             | Interface para operações relacionadas ao cliente HTTP, oferecendo uma API fluente para requisições.         |
| **`HttpResponseInterface`**           | Interface que representa uma resposta HTTP, incluindo status, cabeçalhos e corpo.                           |
| **`CertificateService`**              | Implementação da interface `CertificateServiceInterface`.                                                   |
| **`D4SignClient`**                    | Cliente central para interagir com a API D4Sign utilizando um `HttpClient`.                                 |
| **`HttpClient`**                      | Implementação do cliente HTTP baseado no Guzzle, aderindo à interface `HttpClientInterface`.                |
| **`HttpResponse`**                    | Implementação da interface `HttpResponseInterface` representando respostas HTTP.                            |
| **`CancelDocumentFieldsInterface`**   | Interface para formatação dos campos de cancelamento de documentos na API D4Sign.                           |
| **`DocumentServiceInterface`**        | Interface para gerenciamento de documentos (upload, download, cancelamento, etc.) via API.                  |
| **`DownloadDocumentFieldsInterface`** | Interface para formatação das solicitações de download de documentos para a API D4Sign.                     |
| **`HighlightFieldsInterface`**        | Interface para formatação dos campos de destaque para operações em documentos.                              |
| **`SendToSignersFieldsInterface`**    | Interface para formatação dos campos ao enviar documentos para signatários.                                 |
| **`UploadDocumentFieldsInterface`**   | Interface para formatação dos campos para upload de documentos na API.                                      |
| **`CancelDocumentFields`**            | Implementação da interface `CancelDocumentFieldsInterface` para o payload da operação de cancelamento.      |
| **`DocumentService`**                 | Implementação das operações relacionadas a documentos, aderindo à interface `DocumentServiceInterface`.     |
| **`DownloadDocumentFields`**          | Implementação da interface `DownloadDocumentFieldsInterface` para configuração de downloads.                |
| **`HighlightFields`**                 | Implementação da interface `HighlightFieldsInterface` com configurações de destaque.                        |
| **`UploadDocumentFields`**            | Implementação para criação de solicitações de upload, aderindo à interface `UploadDocumentFieldsInterface`. |
| **`SendToSignersFields`**             | Implementação para configurar o payload para envio de documentos aos signatários.                           |
| **`D4SginUnauthorizedException`**     | Exceção personalizada para tratar erros de autorização na API D4Sign.                                       |
| **`D4SignConnectException`**          | Exceção personalizada para tratar problemas de conexão com a API D4Sign.                                    |
| **`D4SignHttpClientException`**       | Exceção personalizada para tratar problemas relacionados ao cliente HTTP.                                   |
| **`D4SignInvalidArgumentException`**  | Exceção personalizada para validar argumentos passados aos métodos.                                         |

Essa tabela oferece uma visão geral sobre os papéis e responsabilidades de cada arquivo/classe para facilitar o
entendimento de suas finalidades dentro do sistema.
