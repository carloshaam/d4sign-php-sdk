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
        'message' => 'Lorem ipsum dolor',
        'workflow' => 1,
        'scheduling_date' => '2026/09/10',
        'scheduling_time' => '21:00',
        'urgent_document' => 0,
    ];

    $documents = $d4sign->documents()->scheduleDocumentForSignature('uuid-document', $fields);

    echo print_r($documents->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`message`

Mensagem que será enviada para os signatários no envio.

`workflow`

| Valor | Descrição                              |
|-------|----------------------------------------|
| 1     | Para não seguir a ordem de assinaturas |
| 2     | Para seguir a ordem de assinaturas     |

`scheduling_date`

Data de agendamento. Deve ser igual ou superior à data atual e no formato americano aaaa/mm/dd. (obrigatório)

`scheduling_time`

Horário de agendamento, sempre entre 6:00 e 22:00 e a cada 1 hora, ou seja, 11:00 / 12:00 / 13:00 / etc. Caso a data de
agendamento seja o dia atual, o horário de agendamento tem que ser superior ao horário atual. (obrigatório)

`urgent_document`

| Valor | Descrição                  |
|-------|----------------------------|
| 0     | Não é um documento urgente |
| 1     | É um documento urgente     |
