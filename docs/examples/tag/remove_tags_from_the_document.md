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
    $fields = ['tag' => 'hot'];

    $safes = $d4sign->tags()->removeTagToDocument('uuid-document', $fields);

    echo print_r($safes->json(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```