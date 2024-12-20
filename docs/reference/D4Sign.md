# Documentação da Classe D4Sign

A classe `D4Sign` é uma biblioteca cliente em PHP projetada para interagir com a API da D4Sign. Ela permite aos
desenvolvedores gerenciar cofres, documentos, signatários, certificados, usuários, tags, watchers e webhooks de maneira
simples.

## Índice

- [Visão Geral]()
- [Requisitos]()
- [Construtor]()
- [Métodos]()
    - [safes]()
    - [documents]()
    - [signatories]()
    - [users]()
    - [tags]()
    - [certificates]()
    - [watchers]()
    - [webhooks]()

- [Tratamento de Exceções]()

## Visão Geral

A classe `D4Sign` oferece uma forma centralizada de acessar diferentes serviços fornecidos pela API da D4Sign, como
cofres, documentos, signatários, e mais. Ela gerencia internamente as instâncias de serviços e facilita o acesso a cada
funcionalidade da API.

## Requisitos

- **Versão do PHP:** 7.4+
- **Dependências:**
    - `D4SignClient`: Gerencia a comunicação HTTP com a API da D4Sign.
    - `D4SignInvalidArgumentException`: Exceção customizada para argumentos inválidos.

## Construtor

### Sintaxe

``` php
public function __construct(
    string $tokenAPI,
    string $cryptKey,
    string $baseUrl = self::DEFAULT_BASE_URL
)
```

### Parâmetros

- **`tokenAPI`** _(string)_: O token da API fornecido pela D4Sign.
- **`cryptKey`** _(string)_: A chave criptográfica para comunicação segura.
- **`baseUrl`** _(string, opcional)_: Define a URL base para a API. O valor padrão é
  `https://sandbox.d4sign.com.br/api/v1`.

### Exemplo

``` php
$d4Sign = new D4Sign('seu-token-da-api', 'sua-chave-criptografica');
```

## Métodos

### safes

#### Descrição

Fornece acesso à API de Cofres (Safes), que inclui métodos para gerenciamento de cofres na D4Sign.

#### Sintaxe

``` php
public function safes(): SafeServiceInterface
```

#### Retorno

Instância da interface `SafeServiceInterface`.

#### Exemplo

``` php
$safesService = $d4Sign->safes();
```

### documents

#### Descrição

Fornece acesso à API de Documentos (Documents), permitindo o gerenciamento de documentos dentro dos cofres.

#### Sintaxe

``` php
public function documents(): DocumentServiceInterface
```

#### Retorno

Instância da interface `DocumentServiceInterface`.

#### Exemplo

``` php
$documentsService = $d4Sign->documents();
```

### signatories

#### Descrição

Fornece acesso à API de Signatários (Signatories), permitindo o gerenciamento de assinantes dos documentos.

#### Sintaxe

``` php
public function signatories(): SignatoryServiceInterface
```

#### Retorno

Instância da interface `SignatoryServiceInterface`.

#### Exemplo

``` php
$signatoriesService = $d4Sign->signatories();
```

### users

#### Descrição

Fornece acesso à API de Usuários (Users), que permite o gerenciamento de informações de usuários.

#### Sintaxe

``` php
public function users(): UserServiceInterface
```

#### Retorno

Instância da interface `UserServiceInterface`.

#### Exemplo

``` php
$usersService = $d4Sign->users();
```

### tags

#### Descrição

Fornece acesso à API de Tags, permitindo o gerenciamento de tags vinculadas aos documentos.

#### Sintaxe

``` php
public function tags(): TagServiceInterface
```

#### Retorno

Instância da interface `TagServiceInterface`.

#### Exemplo

``` php
$tagsService = $d4Sign->tags();
```

### certificates

#### Descrição

Fornece acesso à API de Certificados, permitindo o gerenciamento de certificados utilizados na assinatura de documentos.

#### Sintaxe

``` php
public function certificates(): CertificateServiceInterface
```

#### Retorno

Instância da interface `CertificateServiceInterface`.

#### Exemplo

``` php
$certificatesService = $d4Sign->certificates();
```

### watchers

#### Descrição

Fornece acesso à API de Watchers, permitindo o gerenciamento de observadores (watchers) de eventos nos documentos.

#### Sintaxe

``` php
public function watchers(): WatcherServiceInterface
```

#### Retorno

Instância da interface `WatcherServiceInterface`.

#### Exemplo

``` php
$watchersService = $d4Sign->watchers();
```

### webhooks

#### Descrição

Fornece acesso à API de Webhooks, permitindo o gerenciamento de webhooks e configurações de callback.

#### Sintaxe

``` php
public function webhooks(): WebhookServiceInterface
```

#### Retorno

Instância da interface `WebhookServiceInterface`.

#### Exemplo

``` php
$webhooksService = $d4Sign->webhooks();
```

## Tratamento de Exceções

A classe `D4Sign` lança exceções personalizadas para casos de operações inválidas:

- **`D4SignInvalidArgumentException`**: Lançada quando uma classe fornecida como argumento não é válida ou não existe.

### Exemplo

``` php
try {
    $invalidService = $d4Sign->getService('serviceInvalido', ClasseInvalida::class);
} catch (D4SignInvalidArgumentException $e) {
    echo $e->getMessage(); // "Class ClasseInvalida does not exist."
}
```

## Contribuição

Se você deseja contribuir ou relatar um problema, abra um [Novo Issue no GitHub]() ou envie um Pull Request.
Esta documentação foi gerada automaticamente para a classe `D4Sign`. Caso você tenha dúvidas ou sugestões, fique à
vontade para participar da discussão no repositório!
