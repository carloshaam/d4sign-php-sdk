# Documentação da Classe D4SignClient

A classe `D4SignClient` é responsável por gerenciar a configuração e a comunicação HTTP com a API da D4Sign. Ela
encapsula as configurações básicas de autenticação e fornece uma interface para acessar o cliente HTTP configurado.

## Índice

- [Visão Geral]()
- [Requisitos]()
- [Construtor]()
- [Métodos]()
    - [getHttpClient]()

## Visão Geral

A classe `D4SignClient` é parte do namespace `D4Sign\Client` e centraliza a criação e configuração do cliente HTTP
necessário para se comunicar com a API da D4Sign. Essa classe define os cabeçalhos de autenticação (`tokenAPI` e
`cryptKey`) e o URL base usado nas requisições.

## Requisitos

- **Versão do PHP:** 7.4+
- **Dependência:** Um cliente HTTP configurável (por exemplo, `HttpClient` utilizado no código).

## Construtor

### Sintaxe

``` php
public function __construct(
    string $tokenAPI,
    string $cryptKey,
    string $baseUrl = 'https://secure.d4sign.com.br/api/v1'
)
```

### Parâmetros

- **`tokenAPI`** _(string)_: O token da API fornecido pela D4Sign para autenticação.
- **`cryptKey`** _(string)_: A chave criptográfica usada para proteger as requisições.
- **`baseUrl`** _(string, opcional)_: A URL base da API. O valor padrão é `https://secure.d4sign.com.br/api/v1`.

### Comportamento

- O cliente HTTP (`HttpClient`) é criado e configurado com a URL base e os cabeçalhos necessários para autenticação.

### Exemplo de Uso

``` php
use D4Sign\Client\D4SignClient;

$client = new D4SignClient(
    'seu-token-da-api',
    'sua-chave-criptografica'
);
```

## Métodos

### getHttpClient

#### Descrição

Retorna a instância do cliente HTTP configurado, permitindo a execução de requisições HTTP para a API da D4Sign.

#### Sintaxe

``` php
public function getHttpClient(): HttpClient
```

#### Retorno

- **`HttpClient`**: Uma instância do cliente HTTP configurado com os cabeçalhos de autenticação e a URL base.

#### Comportamento

- Esse método é útil para obter a instância do cliente HTTP e utilizá-la diretamente para executar requisições
  customizadas ou adicionais à API.

#### Exemplo de Uso

``` php
use D4Sign\Client\D4SignClient;

$client = new D4SignClient('seu-token-da-api', 'sua-chave-criptografica');
$httpClient = $client->getHttpClient();

// Realizando uma requisição HTTP customizada
$response = $httpClient->get('/meu-endpoint');
```

## Observações

A classe não possui lógica complexa além da configuração inicial do cliente HTTP. Portanto, ela funciona apenas como um
ponto de integração entre o código do usuário e a API da D4Sign.

## Contribuição

Caso você queira contribuir ou relatar um problema na implementação da classe, abra um
novo [issue no repositório oficial]() ou envie um Pull Request.
Esta documentação foi gerada para a classe `D4SignClient`. Caso você tenha sugestões ou dúvidas, envie-as usando o
repositório!
