```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Signatory\UpdateSignatoryAccessCodeFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = new UpdateSignatoryAccessCodeFields('email@email.com');

    $signatory = $d4sign->signatories()->updateSignatoryAccessCode(
        'uuid-document',
        $fields
    );

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`password-code`

Código para acessar o documento. Deixe em branco para remover o código atual. (opcional)

```php
$fields->setPasswordCode('Código');
```

`key_signer`

Chave do signatário. (opcional)

```php
$fields->setKeySigner('{key_signer}');
```

Código é encontrado listando os signatários de um documento.
