<?php

declare(strict_types=1);

namespace D4Sign\Tests\Unit;

use D4Sign\Certificate\Contracts\CertificateServiceInterface;
use D4Sign\D4Sign;
use D4Sign\Document\Contracts\DocumentServiceInterface;
use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Safe\Contracts\SafeServiceInterface;
use D4Sign\Signatory\Contracts\SignatoryServiceInterface;
use D4Sign\Tag\Contracts\TagServiceInterface;
use D4Sign\User\Contracts\UserServiceInterface;
use D4Sign\Watcher\Contracts\WatcherServiceInterface;
use D4Sign\Webhook\Contracts\WebhookServiceInterface;
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

    public function testCertificatesServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $certificateService1 = $sdk->certificates();
        $certificateService2 = $sdk->certificates();

        $this->assertInstanceOf(CertificateServiceInterface::class, $certificateService1);
        $this->assertSame($certificateService1, $certificateService2);
    }

    public function testSignatoriesServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $signatoryService1 = $sdk->signatories();
        $signatoryService2 = $sdk->signatories();

        $this->assertInstanceOf(SignatoryServiceInterface::class, $signatoryService1);
        $this->assertSame($signatoryService1, $signatoryService2);
    }

    public function testTagsServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $tagService1 = $sdk->tags();
        $tagService2 = $sdk->tags();

        $this->assertInstanceOf(TagServiceInterface::class, $tagService1);
        $this->assertSame($tagService1, $tagService2);
    }

    public function testUsersServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $userService1 = $sdk->users();
        $userService2 = $sdk->users();

        $this->assertInstanceOf(UserServiceInterface::class, $userService1);
        $this->assertSame($userService1, $userService2);
    }

    public function testWatchersServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $watcherService1 = $sdk->watchers();
        $watcherService2 = $sdk->watchers();

        $this->assertInstanceOf(WatcherServiceInterface::class, $watcherService1);
        $this->assertSame($watcherService1, $watcherService2);
    }

    public function testWebhooksServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $webhookService1 = $sdk->webhooks();
        $webhookService2 = $sdk->webhooks();

        $this->assertInstanceOf(WebhookServiceInterface::class, $webhookService1);
        $this->assertSame($webhookService1, $webhookService2);
    }

    public function testCustomBaseUrlIsUsed()
    {
        $customBaseUrl = 'https://api.custom-url.com';
        $sdk = new D4Sign('tokenAPI', 'cryptKey', $customBaseUrl);

        $reflection = new \ReflectionClass($sdk);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $client = $property->getValue($sdk);

        $httpClient = $client->getHttpClient();

        $httpClientReflection = new \ReflectionClass($httpClient);
        $defaultOptionsProperty = $httpClientReflection->getProperty('defaultOptions');
        $defaultOptionsProperty->setAccessible(true);
        $defaultOptions = $defaultOptionsProperty->getValue($httpClient);

        $this->assertSame($customBaseUrl . '/', $defaultOptions['base_uri']);
    }

    public function testServiceCache()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $sdk->safes();

        $reflection = new \ReflectionClass($sdk);
        $property = $reflection->getProperty('services');
        $property->setAccessible(true);

        $services = $property->getValue($sdk);

        $this->assertArrayHasKey('safes', $services);
        $this->assertInstanceOf(SafeServiceInterface::class, $services['safes']);
    }

    public function testD4SignClientConfiguration()
    {
        $tokenAPI = 'myToken';
        $cryptKey = 'myCryptKey';

        $sdk = new D4Sign($tokenAPI, $cryptKey);

        $reflection = new \ReflectionClass($sdk);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $client = $property->getValue($sdk);

        $httpClient = $client->getHttpClient();

        $httpClientReflection = new \ReflectionClass($httpClient);
        $defaultOptionsProperty = $httpClientReflection->getProperty('defaultOptions');
        $defaultOptionsProperty->setAccessible(true);
        $defaultOptions = $defaultOptionsProperty->getValue($httpClient);

        $this->assertSame($tokenAPI, $defaultOptions['headers']['tokenAPI']);
        $this->assertSame($cryptKey, $defaultOptions['headers']['cryptKey']);
    }

    public function testGetServiceThrowsExceptionForNonExistentClass()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');

        $this->expectException(D4SignInvalidArgumentException::class);
        $this->expectExceptionMessage('Class NonExistentClass does not exist.');

        $reflection = new \ReflectionClass($sdk);
        $method = $reflection->getMethod('getService');
        $method->setAccessible(true);

        $method->invokeArgs($sdk, ['nonExistentService', 'NonExistentClass']);
    }
}
