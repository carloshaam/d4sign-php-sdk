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
    // Primeiro, precisamos listar os anexos vinculados a um documento principal através do seguinte endpoint:
    $documents = $d4sign->documents()->listSplitDocumentsAndCertificates('uuid-document');

    // Em seguida, você precisará efetuar o download de documentos anexos vinculados a um documento
    // principal e suas hashes (certificados de assinatura), utilizando os parâmetros abaixo:
    $fields = [
        'language' => 'pt',
        'type' => 'pdfa',
        'documents' => [
            'uuid-document1' => '1/0',
            'uuid-document2' => '1/0',
        ]
    ];

    $documentDownload = $d4sign->documents()->downloadDocumentWithFields('uuid-document', $fields);

    echo print_r($documentDownload->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Opções dos campos

`language`

Para realizar o download do arquivo em inglês, escolha en nesse atributo. Para realizar o download do arquivo em português, escolha pt nesse atributo. ()

`type`

Para fazer em download em pdf, exclua o atributo, mas para baixar em no formato pdf-a, escolha "pdfa" nesse atributo.

`documents`

Pode-se colocar mais UUID de documentos, caso necessário.

Onde o uuid-document1 é o UUID do documento que se quer baixar (doc principal ou anexo) e o 1-(true)/0-(false) é se quer ou não a hash daquele documento.
