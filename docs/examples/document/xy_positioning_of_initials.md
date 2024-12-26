```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = [
        'name_document' => 'Lorem ipsum dolor',
        'templates' => [
            '{uuid_template}' => [
                'nome_completo' => 'email1@email.com',
                'endereco_residencial' => 'email2@email.com',
                'bairro' => 'email3@email.com',
                'cidade' => 'email4@email.com',
                'CEP' => 'email5@email.com',
                'CPF' => 'email6@email.com',
                'CNPJ' => 'email7@email.com',
            ]
        ]
    ];

    $documents = $d4sign->documents()->setXYPositionOfHeadingsInDocument('uuid-safe', $fields);

    echo print_r($documents->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`name_document`

Nome que deseja dar ao documento no cofre.

`templates`

Lista de templates, podendo ser mais de um.

`uuid_template`

UUID do modelo e seus respectivos tokens.
