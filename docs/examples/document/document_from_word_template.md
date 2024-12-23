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
        'name_document' => 'Nome do documento', // opcional
        'uuid_folder' => '{uuid-folder}', // opcional
        'templates' => [
            'id_template_1' => [
                'variavel_1' => 'valor 1',
                'variavel_2' => 'valor 2'
            ],
        ]
    ];

    $document = $d4sign->documents()->createDocumentFromWordTemplate('uuid-document', $fields);

    echo print_r($document->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`uuid-folder`

UUID da pasta ou subpasta que será renomeada.
