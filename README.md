# Biblioteca D4Sign (Em desenvolvimento)

Uma biblioteca para interagir com a API D4Sign.

## Instalação

Use o Composer para instalar a biblioteca: (Ainda não foi lançada)

```bash
composer require carloshaam/d4sign-api
```

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