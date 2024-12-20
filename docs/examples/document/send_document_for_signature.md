```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Document\SendToSignersFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = new SendToSignersFields(1, 0);
    $fields->setMessage('Lorem ipsum is simply dummy text.');

    $document = $d4sign->documents()->sendDocumentToSigners('uuid-document', $fields);

    echo print_r($document->json(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
