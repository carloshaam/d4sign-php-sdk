```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Signatory\UpdateSignatorySmsNumberFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = new UpdateSignatorySmsNumberFields(
        'email@email.com',
        '+553300000000',
        '{key-signer}'
    );

    $signatory = $d4sign->signatories()->updateSignatorySMSNumber('uuid-document', $fields);

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`key-signer`

Código é encontrado listando os signatários de um documento.
