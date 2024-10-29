# Biblioteca D4Sign (Em desenvolvimento)

Uma biblioteca para interagir com a API D4Sign.

**Documentação Completa:** Consulte a [documentação oficial](https://docapi.d4sign.com.br/docs) para exemplos detalhados, funções avançadas e casos de uso.

## Instalação

Use o Composer para instalar a biblioteca: (Ainda não foi lançada)

```bash
composer require carloshaam/d4sign-api
```

#### Requisitos

- **PHP 7.4 ou superior:** Garantimos compatibilidade com as versões mais recentes do PHP para aproveitar os recursos modernos da linguagem.
- **Extensões PHP:** Dependências comuns como `curl` para realizar requisições HTTP.

## Uso

```php
<?php

require 'vendor/autoload.php';

use Carloshaam\D4signApi\Config;
use Carloshaam\D4signApi\D4SignApiClient;

$config = new Config('https://sandbox.d4sign.com.br/api', 'YOUR_TOKEN_API', 'YOUR_CRYPT_KEY');
$client = new D4SignApiClient($config);

$documents = $client->documents()->getByUuid('uuid');
print_r($documents);
```

## Testes

Execute os testes com o PHPUnit:

```bash
composer test
```