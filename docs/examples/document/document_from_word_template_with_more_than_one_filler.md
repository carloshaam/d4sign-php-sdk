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

$filePath = '/path/to/contract.pdf';

try {
    // Para encontrar o "id_template" basta fazer uma requisição para:
    $templates = $d4sign->documents()->listTemplates();

    $fields = [
        'name_document' => 'Nome do documento', // opcional
        'uuid_folder' => '{uuid-folder}', // opcional
        'templates' => [
            'id_template' => [
                'persona_1' => [
                    'variavel_1' => 'valor 1',
                    'variavel_2' => 'valor 2'
                ],
                'persona_2' => [
                    'variavel_1' => 'valor 1',
                    'variavel_2' => 'valor 2'
                ],
                'tokens_gerais' => [
                    'variavel_1' => 'valor 1',
                    'variavel_2' => 'valor 2'
                ],
            ],
        ]
    ];

    $documentFromWord = $d4sign->documents()->createDocumentFromWordTemplate('uuid-document', $fields);

    echo print_r($document->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

# Opções dos campos

`name_document`

Define o nome do documento. Se não for preenchido, o documento terá o nome "Documento".

`uuid_folder`

Para que o documento fique armazenado dentro da pasta, informe o UUID dela. Se não for preenchido, o documento será
salvo no cofre informado na requisição.

`id_template`

Array contendo o ID do template na CHAVE e as variáveis no VALUE. (obrigatório)

`persona`

Se o modelo tiver mais de um preenchedor esse campo é obrigatório. Você poderá adicionar quantos preenchedores quiser.
Caso dois preenchedores possam preencher o mesmo campo, deverá ser adicionado em "tokens_gerais", desta forma iremos
salvar o primeiro valor preenchido.
