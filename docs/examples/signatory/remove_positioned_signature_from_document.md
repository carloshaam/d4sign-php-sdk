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
        'pins' => [
            [
                'email' => 'email@email.com',
                'page' => 1,
                'position_x' => 30,
                'position_y' => 30
            ]
        ]
    ];

    $signatory = $d4sign->signatories()->removeMainDocumentPin(
        'uuid-document',
        $fields
    );

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
