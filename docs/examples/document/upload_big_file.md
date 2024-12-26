```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Document\UploadDocumentFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

$filePath = '/path/to/contract.pdf';

try {
    $fields = new UploadDocumentFields($filePath);
    $fields->setUuidFolder('uuid-folder');

    $document = $d4sign->documents()->uploadLargeDocument('uuid-safe', $fields);

    echo print_r($document->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
