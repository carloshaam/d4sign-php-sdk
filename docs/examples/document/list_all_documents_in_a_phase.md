```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Utils\D4SignDocumentPhase;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $document = $d4sign->documents()->listDocumentsByPhase(
        D4SignDocumentPhase::PHASE_WAITING_FOR_SIGNATURES
    );

    echo print_r($document->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
