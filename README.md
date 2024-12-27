# D4Sign SDK PHP

[![Latest Stable Version](https://poser.pugx.org/carloshaam/d4sign-php-sdk/version)](https://packagist.org/packages/carloshaam/d4sign-php-sdk)
[![Total Downloads](https://poser.pugx.org/carloshaam/d4sign-php-sdk/downloads)](https://packagist.org/packages/carloshaam/d4sign-php-sdk)
[![PHP Version Require](https://poser.pugx.org/carloshaam/d4sign-php-sdk/require/php)](https://packagist.org/packages/carloshaam/d4sign-php-sdk)
[![License](https://poser.pugx.org/carloshaam/d4sign-php-sdk/license)](https://packagist.org/packages/carloshaam/d4sign-php-sdk)

Este repositório contém o SDK PHP de código aberto que permite que você acesse a plataforma da D4Sign a partir do seu aplicativo PHP.

## Instalação

Este SDK está disponível no [Packagist](https://packagist.org/packages/carloshaam/d4sign-php-sdk) e pode ser instalado via [Composer](https://getcomposer.org/). Execute este comando:

```shell
composer require carloshaam/d4sign-php-sdk
```

## Uso

Para utilizar o SDK, você precisa configurar suas credenciais da API D4Sign. Defina as variáveis de ambiente abaixo ou configure diretamente no código:

```dotenv
D4SIGN_API_URL=your_api_url
D4SIGN_API_KEY=your_api_key
D4SIGN_SECRET_KEY=your_secret_key
```

Simples Upload de Documento.

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Document\UploadDocumentFields;

$d4sign = new D4Sign('your_api_key', 'your_secret_key', 'your_api_url');

$filePath = '/path/to/filename.pdf';

try {
    $fields = new UploadDocumentFields($filePath);
    $fields->setUuidFolder('uuid-folder'); // opcional

    $document = $d4sign->documents()->uploadDocumentToSafe('uuid-safe', $fields);

    echo print_r($document->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Documentação completa, instruções de instalação e exemplos estão disponíveis [aqui](docs).

## Roadmap

- Implementar todos os métodos públicos da API da D4Sign ([Veja quais métodos estão pendentes](./docs))
- Implementar testes unitarios (Pendente)

## Tests

```shell
./vendor/bin/phpunit
```

ou

```shell
composer test
```

## Contribuição

Contribuições são bem-vindas!
Consulte [CONTRIBUTING](CONTRIBUTING.md) para obter detalhes.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## Vulnerabilidades de segurança

Se você encontrar um problema de segurança, entre em contato diretamente com os mantenedores em (canal pendente).

## Disclaimer

Esse projeto não tem vínculo algum com a empresa D4Sign, trata-se apenas de uma sdk para facilitar o consumo da api do mesmo.
