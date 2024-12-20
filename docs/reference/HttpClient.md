# Documentação da Classe HttpClient

A classe `HttpClient` é uma implementação de cliente HTTP no namespace `D4Sign\Client`. Essa classe oferece uma
interface completa para execução de requisições HTTP configuráveis com suporte para diferentes métodos HTTP (GET, POST,
PUT, DELETE), formatos de corpo da requisição, autenticação, e mais.
Ela utiliza a biblioteca externa **GuzzleHttp** para lidar com as requisições e fornece uma API fluida (Fluent API) para
configuração e envio de requisições.

## Índice

- [Visão Geral]()
- [Requisitos]()
- [Construtor]()
- [Métodos Estáticos]()
    - [new]()

- [Métodos Públicos]()
    - [baseUrl]()
    - [withOptions]()
    - [withoutRedirecting]()
    - [withoutVerifying]()
    - [asJson]()
    - [asFormParams]()
    - [asMultipart]()
    - [withHeaders]()
    - [withBasicAuth]()
    - [withDigestAuth]()
    - [withCookies]()
    - [timeout]()
    - [Métodos HTTP]()
        - [get]()
        - [post]()
        - [put]()
        - [delete]()

- [Tratamento de Exceções]()

## Visão Geral

A classe `HttpClient` fornece uma interface para criar e enviar requisições HTTP de maneira consistente e customizável.
Os desenvolvedores podem criar instâncias da classe diretamente ou usar o método estático `new()` para inicialização
rápida.
Entre suas funcionalidades, incluem-se:

- Configuração de cabeçalhos e autenticação.
- Personalização de formatos de corpo da requisição (JSON, Form Params, Multipart, etc.).
- Controle de redirecionamentos e verificação SSL.
- Métodos para envio de requisições (`GET`, `POST`, `PUT`, `DELETE`).

## Requisitos

- **Versão do PHP:** 7.4+
- **Dependência:** [GuzzleHttp]()

## Construtor

### Sintaxe

``` php
public function __construct(array $config = [])
```

### Parâmetros

- **`config`** _(array)_: Configuração inicial para o cliente HTTP. Pode incluir:
    - `base_uri`: URI base para as requisições.
    - `headers`: Array de cabeçalhos HTTP padrão, incluindo _`tokenAPI`_ e _`cryptKey`_ para autenticação.

### Comportamento

Cria uma instância de `HttpClient` e configura os valores padrão, incluindo URI base e cabeçalhos. O cliente utiliza o
GuzzleHttp internamente.

### Exemplo

``` php
use D4Sign\Client\HttpClient;

$client = new HttpClient([
    'base_uri' => 'https://api.exemplo.com',
    'headers' => [
        'tokenAPI' => 'seu-token',
        'cryptKey' => 'sua-chave',
    ],
]);
```

## Métodos Estáticos

### new

#### Descrição

Cria uma instância do `HttpClient` utilizando sintaxe fluida.

#### Sintaxe

``` php
public static function new(array $config = []): self
```

#### Parâmetros

- **`config`** _(array)_: Configuração (opcional) para inicialização do cliente.

#### Exemplo

``` php
$http = HttpClient::new()->baseUrl('https://api.exemplo.com');
```

## Métodos Públicos

### baseUrl

#### Descrição

Define a URL base para as requisições HTTP.

#### Sintaxe

``` php
public function baseUrl(string $url): self
```

#### Parâmetros

- **`url`** _(string)_: A URL base para o cliente.

#### Exemplo

``` php
$http = HttpClient::new()
    ->baseUrl('https://api.exemplo.com');
```

### withOptions

#### Descrição

Adiciona opções customizadas ao cliente HTTP.

#### Sintaxe

``` php
public function withOptions($options): self
```

#### Parâmetros

- **`options`** _(array)_: Conjunto de opções adicionais para as requisições.

#### Exemplo

``` php
$http = HttpClient::new()
    ->withOptions(['timeout' => 10]); // Define um timeout para as requisições
```

### withoutRedirecting

#### Descrição

Desativa redirecionamentos automáticos no Guzzle.

#### Sintaxe

``` php
public function withoutRedirecting(): self
```

### withoutVerifying

#### Descrição

Desativa a verificação do certificado SSL.

#### Sintaxe

``` php
public function withoutVerifying(): self
```

### asJson

#### Descrição

Configura o formato de corpo da requisição como JSON com o cabeçalho `Content-Type: application/json`.

#### Sintaxe

``` php
public function asJson(): self
```

### asFormParams

#### Descrição

Configura o formato de corpo da requisição como `application/x-www-form-urlencoded`.

#### Sintaxe

``` php
public function asFormParams(): self
```

### asMultipart

#### Descrição

Configura o formato de corpo da requisição como multipart/form-data.

#### Sintaxe

``` php
public function asMultipart(): self
```

### withHeaders

#### Descrição

Adiciona cabeçalhos padrão para todas as requisições.

#### Sintaxe

``` php
public function withHeaders(array $headers): self
```

#### Exemplo

``` php
$http = HttpClient::new()
    ->withHeaders(['Authorization' => 'Bearer SEU_TOKEN']);
```

### withBasicAuth

#### Descrição

Configura autenticação básica (usuário/senha).

#### Sintaxe

``` php
public function withBasicAuth(string $username, string $password): self
```

### timeout

#### Descrição

Define o limite de tempo de uma requisição.

#### Sintaxe

``` php
public function timeout(int $seconds): self
```

## Métodos HTTP

### get

#### Descrição

Envia uma requisição `GET` para o URI especificado.

#### Sintaxe

``` php
public function get(string $uri, array $params = []): HttpResponse
```

#### Exemplo

``` php
$response = $http->get('/endpoint', ['chave' => 'valor']);
```

### post

#### Descrição

Envia uma requisição `POST` com o corpo especificado.

#### Sintaxe

``` php
public function post(string $uri, array $params = []): HttpResponse
```

### put

#### Descrição

Envia uma requisição `PUT` com o corpo especificado.

#### Sintaxe

``` php
public function put(string $uri, array $params = []): HttpResponse
```

### delete

#### Descrição

Envia uma requisição `DELETE`.

#### Sintaxe

``` php
public function delete(string $uri, array $params = []): HttpResponse
```

## Tratamento de Exceções

A classe lança exceções personalizadas nas seguintes situações:

- **`D4SginUnauthorizedException`**: Quando a chave API está inválida ou expirada (401 Unauthorized).
- **`D4SignHttpClientException`**: Para erros de HTTP (como requisições malformadas ou falhas no Guzzle).

Essa documentação cobre os principais métodos da classe. Explore o restante da API para maiores personalizações e
automações!
