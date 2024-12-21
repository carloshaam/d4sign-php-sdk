```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Safe\CreateFolderFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $fields = new CreateFolderFields('Lorem ipsum');
    $fields->setUuidFolder('uuid-folder');

    $safe = $d4sign->safes()->createFolder('uuid-safe', $fields);

    echo print_r($safe->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
