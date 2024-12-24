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
        'key_signer' => '{key_signer}',
        'document_type' => 2,
        'pades' => 0,
        'document_number' => '00100200309',
    ];

    $user = $d4sign->certificates()->addCertificateToDocument('uuid-document', $fields);

    echo print_r($user->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`key_signer`

Código é encontrado listando os signatários de um documento. (obrigatório)

`document_type`

Definir uma modalidade de assinatura com certificado digital. (obrigatório)

| Valor | Descrição            |
|-------|----------------------|
| 1     | Qualquer certificado |
| 2     | e-CPF                |
| 3     | e-CNPJ               |

`pades`

Definir se será realizada assinatura no padrão.

| Varlor | Descrição |
|--------|-----------|
| 0      | PAdES     |
| 1      | CAdES     |

`document_number`

Entre com o CPF ou CNPJ do signatário.
Deixe em branco para aceitar qualquer certificado e-CPF ou e-CNPJ.
