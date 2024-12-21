```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use D4Sign\D4Sign;
use D4Sign\Signatory\CreateSignatoryFields;
use D4Sign\Signatory\SignatoriesCollection;
use D4Sign\Signatory\ListSignatoriesFields;

$d4sign = new D4Sign(
    'live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'live_crypt_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'https://sandbox.d4sign.com.br/api/v1',
);

try {
    $signer1 = new CreateSignatoryFields('signer1@email.com', 1);
    $signer1->setExtraAuthPix('Signer1', 'Número do CPF');
    $signer1->setUploadDocument('Documento teste');

    $signer2 = new CreateSignatoryFields('signer2@email.com', 2);
    $signer2->setVideoselfie(1);
    $signer2->setD4signScoreDenatran('Signer2', 'Número do CPF', 85);

    $signerCollection = new SignatoriesCollection();
    $signerCollection->addSigner($signer1);
    $signerCollection->addSigner($signer2);

    $listSignatoriesFields = new ListSignatoriesFields($signerCollection);

    $signatory = $d4sign->signatories()->createSignatoryList('uuid-document', $listSignatoriesFields);

    echo print_r($signatory->getJson(), true);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```
