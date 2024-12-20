<?php

declare(strict_types=1);

namespace D4Sign\Tests;

use D4Sign\D4Sign;
use D4Sign\Document\Contracts\DocumentServiceInterface;
use D4Sign\Safe\Contracts\SafeServiceInterface;
use PHPUnit\Framework\TestCase;

class D4SignTest extends TestCase
{
    public function testSafesServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $safeService1 = $sdk->safes();
        $safeService2 = $sdk->safes();

        $this->assertInstanceOf(SafeServiceInterface::class, $safeService1);
        $this->assertSame($safeService1, $safeService2);
    }

    public function testDocumentsServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $documentService1 = $sdk->documents();
        $documentService2 = $sdk->documents();

        $this->assertInstanceOf(DocumentServiceInterface::class, $documentService1);
        $this->assertSame($documentService1, $documentService2);
    }
}