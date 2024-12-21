Iremos dividir em 3 passos:

- Inserir grupos de signatários a um documento;
- Listar os grupos adicionados como signatários de um documento para descobrir o e-mail que foi criado para designar esse grupo;
- Inserir pins de rubrica da assinatura diretamente vinculados aos grupos inseridos no documento.

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
    // TODO: Falta montar o fluxo de exemplo
    $step1 = $d4sign->signatories()->createSignatoryList();
    $step2 = $d4sign->signatories()->listGroupsBySafe();
    $step2 = $d4sign->signatories()->listSignatories();
    $step3 = $d4sign->signatories()->addMainDocumentPin();

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
