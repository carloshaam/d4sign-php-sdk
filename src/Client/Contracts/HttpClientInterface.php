<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

/**
 * Interface HttpClientInterface
 *
 * Define um contrato padrão para clientes HTTP, permitindo a execução de requisições
 * configuráveis com suporte para múltiplas opções de configuração, personalização de autenticação,
 * manipulação de cabeçalhos e mais.
 *
 * Este contrato segue o padrão Fluent API, permitindo o encadeamento de métodos
 * para configurar e executar requisições de maneira simples e intuitiva.
 */
interface HttpClientInterface
{
    /**
     * Cria uma nova instância do cliente HTTP com as opções de configuração fornecidas.
     *
     * @param array $config Um array associativo contendo configurações como:
     *     - `base_uri` (string): A URL base para todas as requisições.
     *     - `headers` (array): Cabeçalhos padrão enviados com todas as requisições.
     *     - `timeout` (int): Tempo limite da requisição em segundos.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client = HttpClientInterface::new([
     *     'base_uri' => 'https://api.example.com',
     *     'headers' => ['Authorization' => 'Bearer token123'],
     *     'timeout' => 30
     * ]);
     * ```
     */
    public static function new(array $config = []): self;

    /**
     * Define uma URL base para todas as requisições subsequentes.
     *
     * @param string $url A URL base da API, por exemplo, `https://api.example.com`.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->baseUrl('https://api.example.com');
     * ```
     */
    public function baseUrl(string $url): self;

    /**
     * Adiciona ou altera opções do cliente HTTP.
     *
     * @param array $options Um array associativo contendo opções adicionais.
     *     Opções comuns incluem:
     *     - `timeout`: Tempo limite da requisição.
     *     - `http_errors`: Indica se as exceções HTTP devem ser lançadas automaticamente.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withOptions(['timeout' => 60]);
     * ```
     */
    public function withOptions(array $options): self;

    /**
     * Configura para desabilitar redirecionamentos automáticos nas requisições HTTP.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withoutRedirecting();
     * ```
     */
    public function withoutRedirecting(): self;

    /**
     * Permite ignorar a verificação de certificados SSL (útil para ambientes de testes).
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withoutVerifying();
     * ```
     */
    public function withoutVerifying(): self;

    /**
     * Define o envio de dados no formato JSON.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->asJson()->post('/endpoint', ['key' => 'value']);
     * ```
     */
    public function asJson(): self;

    /**
     * Define o envio de dados como parâmetros de formulário (application/x-www-form-urlencoded).
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->asFormParams()->post('/endpoint', ['key' => 'value']);
     * ```
     */
    public function asFormParams(): self;

    /**
     * Define o envio de dados como multipart/form-data (geralmente usado para uploads).
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->asMultipart()->post('/upload', [
     *     ['name' => 'file', 'contents' => fopen('/path/to/file', 'r')]
     * ]);
     * ```
     */
    public function asMultipart(): self;

    /**
     * Define o formato do corpo da requisição.
     *
     * @param string $format O formato desejado (ex.: 'json', 'form_params', 'multipart').
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->bodyFormat('json');
     * ```
     */
    public function bodyFormat(string $format): self;

    /**
     * Define o cabeçalho `Content-Type` para a requisição.
     *
     * @param string $contentType O valor do cabeçalho Content-Type.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->contentType('application/xml');
     * ```
     */
    public function contentType(string $contentType): self;

    /**
     * Define o cabeçalho `Accept` para a requisição.
     *
     * @param string $header O valor do cabeçalho Accept.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->accept('application/json');
     * ```
     */
    public function accept(string $header): self;

    /**
     * Adiciona um conjunto de cabeçalhos à requisição.
     *
     * @param array $headers Um array associativo contendo cabeçalhos (ex.: `['Authorization' => 'Bearer token']`).
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withHeaders([
     *     'Authorization' => 'Bearer token123',
     *     'X-Custom-Header' => 'value'
     * ]);
     * ```
     */
    public function withHeaders(array $headers): self;

    /**
     * Configura autenticação básica para a requisição.
     *
     * @param string $username Nome de usuário.
     * @param string $password Senha.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withBasicAuth('user', 'password');
     * ```
     */
    public function withBasicAuth(string $username, string $password): self;

    /**
     * Configura autenticação digest para a requisição.
     *
     * @param string $username Nome de usuário.
     * @param string $password Senha.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withDigestAuth('user', 'password');
     * ```
     */
    public function withDigestAuth(string $username, string $password): self;

    /**
     * Define cookies para a requisição.
     *
     * @param string $cookies String contendo cookies no formato correto.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withCookies('sessionId=abc123; userId=42');
     * ```
     */
    public function withCookies(string $cookies): self;

    /**
     * Define o tempo limite da requisição.
     *
     * @param int $seconds Tempo limite em segundos.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->timeout(10);
     * ```
     */
    public function timeout(int $seconds): self;

    /**
     * Faz uma requisição GET.
     *
     * @param string $uri Caminho ou endpoint.
     * @param array $params Parâmetros de consulta (query string).
     *
     * @return HttpResponseInterface
     *
     * Exemplo:
     * ```php
     * $response = $client->get('/users', ['page' => 1]);
     * ```
     */
    public function get(string $uri, array $params = []): HttpResponseInterface;

    /**
     * Faz uma requisição POST.
     *
     * @param string $uri Caminho ou endpoint.
     * @param array $params Parâmetros enviados no corpo.
     *
     * @return HttpResponseInterface
     *
     * Exemplo:
     * ```php
     * $response = $client->post('/users', ['name' => 'John Doe']);
     * ```
     */
    public function post(string $uri, array $params = []): HttpResponseInterface;

    /**
     * Faz uma requisição HTTP PUT para um endpoint especificado.
     *
     * Tipicamente utilizado para atualizar recursos já existentes na API.
     *
     * @param string $uri Caminho ou URI do recurso desejado.
     * @param array $params Dados a serem enviados no corpo da requisição.
     *
     * @return HttpResponseInterface Retorna uma abstração da resposta HTTP.
     *
     * Exemplo:
     * ```php
     * $response = $client->put('/users/123', [
     *     'name' => 'John Doe',
     *     'email' => 'john.doe@example.com',
     * ]);
     * echo $response->getBody();
     * ```
     */
    public function put(string $uri, array $params = []): HttpResponseInterface;

    /**
     * Faz uma requisição HTTP DELETE para remover recursos de um endpoint especificado.
     *
     * Tipicamente utilizado para exclusões de registros ou recursos.
     *
     * @param string $uri Caminho ou URI do recurso desejado.
     * @param array $params Parâmetros adicionais que podem ser enviados na requisição.
     *
     * @return HttpResponseInterface Retorna uma abstração da resposta HTTP.
     *
     * Exemplo:
     * ```php
     * $response = $client->delete('/users/123');
     * if ($response->getStatusCode() === 204) {
     *     echo 'Usuário removido com sucesso!';
     * }
     * ```
     */
    public function delete(string $uri, array $params = []): HttpResponseInterface;

    /**
     * Envia uma requisição HTTP personalizada com o método e o endpoint desejados.
     *
     * Permite controle total sobre verbos HTTP, cabeçalhos, parâmetros e outras opções configuráveis.
     *
     * @param string $method O verbo HTTP da requisição (ex.: GET, POST, PUT, DELETE).
     * @param string $uri Caminho ou URI completa do recurso.
     * @param array $params Dados do corpo (ex.: JSON, formulários ou consulta).
     * @param array $headers Cabeçalhos adicionais enviados com a requisição.
     *
     * @return HttpResponseInterface Retorna a resposta encapsulada.
     *
     * Exemplo:
     * ```php
     * $response = $client->send('PATCH', '/users/123', [
     *     'json' => ['email' => 'newemail@example.com']
     * ], [
     *     'Authorization' => 'Bearer token123',
     * ]);
     * echo $response->getBody();
     * ```
     */
    public function send(string $method, string $uri, array $params = [], array $headers = []): HttpResponseInterface;

    /**
     * Mescla um ou mais conjuntos de opções em um único array de configuração
     * a ser usado na requisição.
     *
     * @param mixed ...$options Arrays associativos de opções a serem mesclados.
     *
     * @return array Retorna as opções resultantes da mesclagem.
     *
     * Exemplo:
     * ```php
     * $options = $client->mergeOptions(['timeout' => 30], ['headers' => ['Accept' => 'application/json']]);
     * print_r($options);
     * ```
     */
    public function mergeOptions(...$options): array;

    /**
     * Analisa os parâmetros de consulta (query string) de uma URL e os retorna
     * como um array associativo.
     *
     * @param string $url A URL a ser processada.
     *
     * @return array Retorna os parâmetros de consulta extraídos.
     *
     * Exemplo:
     * ```php
     * $queryParams = $client->parseQueryParams('https://example.com/api?key=value&page=2');
     * print_r($queryParams); // ['key' => 'value', 'page' => 2]
     * ```
     */
    public function parseQueryParams(string $url): array;

    /**
     * Reseta o cliente HTTP, removendo configurações temporárias
     * (como cabeçalhos customizados ou configurações de autenticação específicas).
     *
     * Depois do reset, o cliente volta às configurações padrão.
     *
     * @return void
     *
     * Exemplo:
     * ```php
     * $client->withHeaders(['X-Custom-Header' => 'value']);
     * $client->resetRequest();
     * ```
     */
    public function resetRequest(): void;

    /**
     * Atualiza a configuração padrão do cliente, mesclando novas opções
     * ao estado atual.
     *
     * @param array $newOptions Configurações (como cabeçalhos extras, tempo limite, etc.).
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->updateConfiguration([
     *     'headers' => ['X-New-Header' => 'headerValue']
     * ]);
     * ```
     */
    public function updateConfiguration(array $newOptions = []): self;

    /**
     * Define um manipulador (handler) customizado para processar requisições.
     *
     * Isso permite, por exemplo, adicionar middlewares ou interceptar requisições
     * e respostas para modificar partes específicas.
     *
     * @param callable $handler Um manipulador customizado.
     *
     * @return self
     *
     * Exemplo:
     * ```php
     * $client->withHandler(function ($request, $options) {
     *     // Manipular logger, middlewares, ou transformações personalizadas.
     * });
     * ```
     */
    public function withHandler(callable $handler): self;

    /**
     * Faz o download de um arquivo da URL especificada e salva no destino indicado.
     *
     * @param string $uri A URL do arquivo a ser baixado.
     * @param string $destination Caminho completo onde o arquivo será salvo.
     *
     * @return HttpResponseInterface Retorna uma resposta indicando sucesso ou falha.
     *
     * Exemplo:
     * ```php
     * $response = $client->download('https://example.com/file.zip', '/path/to/save/file.zip');
     * if ($response->getStatusCode() === 200) {
     *     echo 'Download realizado com sucesso!';
     * }
     * ```
     */
    public function download(string $uri, string $destination): HttpResponseInterface;
}
