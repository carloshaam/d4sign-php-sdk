<?php

declare(strict_types=1);

namespace D4Sign\Tests\Unit;

use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignInvalidJsonException;
use PHPUnit\Framework\TestCase;

class HttpResponseTest extends TestCase
{
    public function testBasicResponseProperties()
    {
        $status = 200;
        $body = '{"message":"success"}';
        $headers = ['Content-Type' => 'application/json'];

        $response = new HttpResponse($status, $body, $headers);

        $this->assertSame($status, $response->status());
        $this->assertSame($body, $response->getBody());
        $this->assertSame($headers, $response->getHeaders());
    }

    public function testJsonDecoding()
    {
        $body = '{"key":"value","number":123}';
        $response = new HttpResponse(200, $body, []);

        $this->assertSame(['key' => 'value', 'number' => 123], $response->getJson());
    }

    public function testJsonDecodingThrowsExceptionOnInvalidJson()
    {
        $this->expectException(D4SignInvalidJsonException::class);
        $this->expectExceptionMessage('Invalid JSON body:');

        $body = '{"invalid_json":}';
        $response = new HttpResponse(200, $body, []);

        $response->getJson();
    }

    public function testHeaderMethods()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Set-Cookie' => 'sessionId=abc123',
        ];

        $response = new HttpResponse(200, '', $headers);

        $this->assertTrue($response->hasHeader('Content-Type'));
        $this->assertFalse($response->hasHeader('Authorization'));

        $this->assertSame(['application/json'], $response->getHeader('Content-Type'));
        $this->assertSame(['sessionId=abc123'], $response->getHeader('Set-Cookie'));
        $this->assertNull($response->getHeader('Authorization'));

        $this->assertSame('application/json', $response->getContentType());
        $this->assertSame(['sessionId=abc123'], $response->getCookies());
    }

    public function testHttpStatusChecks()
    {
        $response = new HttpResponse(200, '', []);
        $this->assertTrue($response->isSuccess());
        $this->assertFalse($response->isClientError());
        $this->assertFalse($response->isServerError());

        $clientErrorResponse = new HttpResponse(404, '', []);
        $this->assertFalse($clientErrorResponse->isSuccess());
        $this->assertTrue($clientErrorResponse->isClientError());
        $this->assertFalse($clientErrorResponse->isServerError());

        $serverErrorResponse = new HttpResponse(500, '', []);
        $this->assertFalse($serverErrorResponse->isSuccess());
        $this->assertFalse($serverErrorResponse->isClientError());
        $this->assertTrue($serverErrorResponse->isServerError());
    }

    public function testRawResponse()
    {
        $status = 201;
        $body = '{"created":true}';
        $headers = ['Content-Type' => 'application/json'];

        $response = new HttpResponse($status, $body, $headers);

        $expectedRawResponse = [
            'status' => $status,
            'body' => $body,
            'headers' => $headers,
        ];

        $this->assertSame($expectedRawResponse, $response->rawResponse());
    }
}
