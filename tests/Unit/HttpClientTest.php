<?php

declare(strict_types=1);

namespace D4Sign\Tests\Unit;

use D4Sign\Client\HttpClient;
use D4Sign\Exceptions\D4SignUnauthorizedException;
use D4Sign\Exceptions\D4SignHttpClientException;
use D4Sign\Exceptions\D4SignRuntimeException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testDefaultConfiguration()
    {
        $config = [
            'base_uri' => 'https://example.com',
            'headers' => [
                'tokenAPI' => 'myToken',
                'cryptKey' => 'myCryptKey',
            ],
        ];

        $httpClient = new HttpClient($config);

        $reflection = new \ReflectionClass($httpClient);
        $defaultOptions = $reflection->getProperty('defaultOptions');
        $defaultOptions->setAccessible(true);

        $options = $defaultOptions->getValue($httpClient);

        $this->assertSame('https://example.com', $options['base_uri']);
        $this->assertSame('myToken', $options['headers']['tokenAPI']);
        $this->assertSame('myCryptKey', $options['headers']['cryptKey']);
    }

    public function testBaseUrlMethod()
    {
        $httpClient = new HttpClient();
        $httpClient->baseUrl('https://custom-url.com');

        $reflection = new \ReflectionClass($httpClient);
        $defaultOptions = $reflection->getProperty('defaultOptions');
        $defaultOptions->setAccessible(true);

        $options = $defaultOptions->getValue($httpClient);

        $this->assertSame('https://custom-url.com/', $options['base_uri']);
    }

    public function testWithBasicAuth()
    {
        $httpClient = new HttpClient();
        $httpClient->withBasicAuth('user', 'password');

        $reflection = new \ReflectionClass($httpClient);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        $auth = $options->getValue($httpClient)['auth'];

        $this->assertSame(['user', 'password'], $auth);
    }

    public function testWithoutRedirecting()
    {
        $httpClient = new HttpClient();
        $httpClient->withoutRedirecting();

        $reflection = new \ReflectionClass($httpClient);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        $redirects = $options->getValue($httpClient)['allow_redirects'];

        $this->assertFalse($redirects);
    }

    public function testSendGetRequest()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], '{"message":"success"}'),
        ]);

        $guzzleClient = new GuzzleClient([
            'handler' => $mock,
            'base_uri' => 'https://example.com',
        ]);

        $httpClient = new HttpClient();
        $reflection = new \ReflectionClass($httpClient);
        $clientReflection = $reflection->getProperty('client');
        $clientReflection->setAccessible(true);
        $clientReflection->setValue($httpClient, $guzzleClient);

        $response = $httpClient->get('/test');

        $this->assertSame(200, $response->status());
        $this->assertSame('{"message":"success"}', $response->getBody());
        $this->assertSame(['Content-Type' => ['application/json']], $response->getHeaders());
    }

    public function testUnauthorizedException()
    {
        $this->expectException(D4SignUnauthorizedException::class);
        $this->expectExceptionMessage('Invalid or expired API key.');

        $mock = new MockHandler([
            new Response(401),
        ]);

        $guzzleClient = new GuzzleClient([
            'handler' => $mock,
            'base_uri' => 'https://example.com',
        ]);

        $httpClient = new HttpClient();
        $reflection = new \ReflectionClass($httpClient);
        $clientReflection = $reflection->getProperty('client');
        $clientReflection->setAccessible(true);
        $clientReflection->setValue($httpClient, $guzzleClient);

        $httpClient->get('/unauthorized');
    }

    public function testHttpClientException()
    {
        $this->expectException(D4SignHttpClientException::class);

        $mock = new MockHandler([
            new Response(500),
        ]);

        $client = new GuzzleClient(['handler' => $mock]);
        $httpClient = new HttpClient(['client' => $client]);

        $httpClient->get('/error');
    }

    public function testDownloadFile()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/octet-stream'], 'mock-file-contents'),
        ]);

        $guzzleClient = new GuzzleClient([
            'handler' => $mock,
            'base_uri' => 'https://example.com',
        ]);

        $httpClient = new HttpClient();
        $reflection = new \ReflectionClass($httpClient);
        $clientReflection = $reflection->getProperty('client');
        $clientReflection->setAccessible(true);
        $clientReflection->setValue($httpClient, $guzzleClient);

        $response = $httpClient->get('/file');

        $this->assertSame(200, $response->status());
        $this->assertSame('mock-file-contents', $response->getBody());
        $this->assertSame(['Content-Type' => ['application/octet-stream']], $response->getHeaders());
    }

    public function testDownloadToInvalidPath()
    {
        $this->expectException(D4SignRuntimeException::class);
        $this->expectExceptionMessage('Directory is not writable:');

        $mock = new MockHandler([
            new Response(200, [], 'file content'),
        ]);

        $client = new GuzzleClient(['handler' => $mock]);
        $httpClient = new HttpClient(['client' => $client]);

        $destination = '/invalid_path/test_file.txt';

        $httpClient->download('/file', $destination);
    }
}
