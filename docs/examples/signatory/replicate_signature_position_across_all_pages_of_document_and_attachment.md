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
            'email' => 'email@email.com',
            'page_height' => '1097px',
            'page_width' => '790px',
            'position_x' => 360,
            'position_y' => 150,
            'type' => 1,
            'document_slaves' => [
                [
                    'uuid' => '{uuid-slave}'
                ],
                [
                    'uuid' => '{uuid-slave}'
                ]
            ]
        ]
    ];

    $signatory = $d4sign->signatories()->replicateSignaturePosition(
        'uuid-document',
        $fields
    );

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
