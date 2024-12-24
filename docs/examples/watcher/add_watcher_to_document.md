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
        'email' => 'email@email.com'
    ];

    $watchers = $d4sign->watchers()->addWatcherToDocument('uuid-document', $fields);

    echo print_r($watchers->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`email`

E-mail do observador. (obrigatório)

`permission`

Definir nível de permissão padrão.

| Varlor | Descrição                                        |
|--------|--------------------------------------------------|
| 0      | Perfil básico (poode fazer download)             |
| 1      | Perfil de visualização (não pode fazer download) |
