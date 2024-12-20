# Documentação da Classe HttpResponse

A classe `HttpResponse` é usada para encapsular e gerenciar os dados retornados após uma requisição HTTP. Ela fornece
métodos para acessar o status, corpo e cabeçalhos de uma resposta, além de verificar o tipo de resposta (sucesso, erro
do cliente, ou erro do servidor).

## Índice

- [Visão Geral]()
- [Requisitos]()
- [Construtor]()
- [Métodos Públicos]()
    - [status]()
    - [body]()
    - [json]()
    - [headers]()
    - [getHeader]()
    - [hasHeader]()
    - [isSuccess]()
    - [isClientError]()
    - [isServerError]()

## Visão Geral

A `HttpResponse` é uma classe do namespace `D4Sign\Client` que implementa a interface `HttpResponseInterface`. Ela
encapsula os seguintes dados de uma resposta HTTP:

- **Status do código HTTP**: Determina o resultado da requisição.
- **Corpo (body)**: Contém os dados retornados pela API.
- **Cabeçalhos HTTP**: Informações adicionais transmitidas junto com a resposta.

## Requisitos

- **Versão do PHP**: 7.4+
- **Dependência**: A classe depende da interface `HttpResponseInterface` e da funcionalidade JSON nativa do PHP.

## Construtor

### Sintaxe

``` php
public function __construct(int $status, string $body, array $headers)
```

### Parâmetros

- **`status`** _(int)_: Código de status HTTP da resposta.
- **`body`** _(string)_: O conteúdo do corpo da resposta.
- **`headers`** _(array)_: Um array associativo representando os cabeçalhos da resposta.

### Comportamento

O construtor inicializa a classe com os dados da resposta HTTP. Cada dado pode ser acessado separadamente usando os
métodos disponíveis.

### Exemplo

``` php
use D4Sign\Client\HttpResponse;

$response = new HttpResponse(
    200,
    '{"success":true,"data":{}}',
    [
        'Content-Type' => 'application/json',
        'Date' => 'Sun, 05 Nov 2023 12:00:00 GMT',
    ]
);
```

## Métodos Públicos

### status

#### Descrição

Obtém o código de status HTTP retornado pela resposta.

#### Sintaxe

``` php
public function status(): int
```

#### Retorno

- **`int`**: O código de status da resposta (exemplo: `200`, `404`, `500`).

#### Exemplo

``` php
$code = $response->status(); // Retorna 200
```

### body

#### Descrição

Obtém o corpo da resposta como uma string.

#### Sintaxe

``` php
public function body(): string
```

#### Retorno

- **`string`**: O conteúdo do corpo da resposta.

#### Exemplo

``` php
$content = $response->body(); // Retorna '{"success":true,"data":{}}'
```

### json

#### Descrição

Decodifica o corpo da resposta para um array associativo, assumindo que o corpo esteja formatado como JSON.

#### Sintaxe

``` php
public function json(): array
```

#### Retorno

- **`array`**: O corpo da resposta decodificado como JSON.

#### Exceções

- Lança uma `RuntimeException` caso o corpo da resposta não seja um JSON válido.

#### Exemplo

``` php
$data = $response->json(); // Retorna ['success' => true, 'data' => []]
```

### headers

#### Descrição

Obtém todos os cabeçalhos da resposta HTTP.

#### Sintaxe

``` php
public function headers(): array
```

#### Retorno

- **`array`**: Um array associativo contendo todos os cabeçalhos da resposta.

#### Exemplo

``` php
$headers = $response->headers(); 
// Retorna ['Content-Type' => 'application/json', 'Date' => 'Sun, 05 Nov 2023 12:00:00 GMT']
```

### getHeader

#### Descrição

Recupera um cabeçalho específico da resposta de forma case-insensitive.

#### Sintaxe

``` php
public function getHeader(string $name): ?string
```

#### Parâmetros

- **`name`** _(string)_: O nome do cabeçalho.

#### Retorno

- **`string`**: Valor do cabeçalho, ou `null` se o cabeçalho não existe.

#### Exemplo

``` php
$contentType = $response->getHeader('Content-Type'); // Retorna 'application/json'
```

### hasHeader

#### Descrição

Verifica se um determinado cabeçalho está presente na resposta.

#### Sintaxe

``` php
public function hasHeader(string $name): bool
```

#### Parâmetros

- **`name`** _(string)_: O nome do cabeçalho a ser verificado.

#### Retorno

- **`bool`**: `true` se o cabeçalho existe, `false` caso contrário.

#### Exemplo

``` php
$exists = $response->hasHeader('Content-Type'); // Retorna true
```

### isSuccess

#### Descrição

Verifica se a resposta foi bem-sucedida (código de status entre 200 e 299).

#### Sintaxe

``` php
public function isSuccess(): bool
```

#### Retorno

- **`bool`**: `true` se a resposta for um sucesso, `false` caso contrário.

#### Exemplo

``` php
$isSuccess = $response->isSuccess(); // Retorna true
```

### isClientError

#### Descrição

Verifica se a resposta indica um erro do cliente (código de status entre 400 e 499).

#### Sintaxe

``` php
public function isClientError(): bool
```

#### Retorno

- **`bool`**: `true` se há erro do cliente, `false` caso contrário.

#### Exemplo

``` php
$isClientError = $response->isClientError(); // Retorna false
```

### isServerError

#### Descrição

Verifica se a resposta indica um erro do servidor (código de status >= 500).

#### Sintaxe

``` php
public function isServerError(): bool
```

#### Retorno

- **`bool`**: `true` se há erro do servidor, `false` caso contrário.

#### Exemplo

``` php
$isServerError = $response->isServerError(); // Retorna false
```

## Observações

Os métodos oferecidos pela `HttpResponse` facilitam a manipulação e análise das respostas HTTP, com foco especial em
APIs RESTful. É possível validar status, extrair cabeçalhos, formatar o corpo da resposta, ou realizar verificações
úteis para o fluxo da aplicação.
Esta documentação foi criada para a classe `HttpResponse`. Caso tenha dúvidas ou sugestões, entre em contato ou colabore
por meio do repositório oficial!
