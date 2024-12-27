<?php

declare(strict_types=1);

namespace D4Sign\Tests;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\HttpResponse;
use D4Sign\Document\Contracts\CancelDocumentFieldsInterface;
use D4Sign\Document\Contracts\DownloadDocumentFieldsInterface;
use D4Sign\Document\Contracts\HighlightFieldsInterface;
use D4Sign\Document\Contracts\SendToSignersFieldsInterface;
use D4Sign\Document\Contracts\UploadDocumentFieldsInterface;
use D4Sign\Document\DocumentService;
use D4Sign\Exceptions\D4SignConnectException;
use PHPUnit\Framework\TestCase;

class DocumentServiceTest extends TestCase
{
    public function testListDocumentsSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willReturn(new HttpResponse(200, '{"data": "success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->listDocuments(1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "success"}', $response->getBody());
    }

    public function testListDocumentsInvalidParameters(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents');

        $documentService->listDocuments(-1);
    }

    public function testListDocumentsDefaultPage(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willReturn(new HttpResponse(200, '{"data": "default_page_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->listDocuments();

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "default_page_success"}', $response->getBody());
    }

    public function testListDocumentsUnauthorized(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willThrowException(new \Exception('Unauthorized', 401));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents: Unauthorized');

        $documentService->listDocuments(1);
    }

    public function testListDocumentsNotFound(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willThrowException(new \Exception('Not found', 404));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents: Not found');

        $documentService->listDocuments(1);
    }

    public function testListDocumentsServerError(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willThrowException(new \Exception('Internal Server Error', 500));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents: Internal Server Error');

        $documentService->listDocuments(1);
    }

    public function testListDocumentsThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents', ['pg' => 1])
            ->willThrowException(new \Exception('Network error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents: Network error');

        $documentService->listDocuments(1);
    }

    public function testGetDocumentDetailsSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/12345')
            ->willReturn(new HttpResponse(200, '{"data": "details"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->getDocumentDetails('12345');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "details"}', $response->getBody());
    }

    public function testGetDocumentDetailsThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/12345')
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error getting details for document 12345: Server error');

        $documentService->getDocumentDetails('12345');
    }

    public function testGetDocumentDimensionsSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/12345/dimensions')
            ->willReturn(new HttpResponse(200, '{"data": "dimensions"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->getDocumentDimensions('12345');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "dimensions"}', $response->getBody());
    }

    public function testGetDocumentDimensionsThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/12345/dimensions')
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error getting dimensions of document 12345: Server error');

        $documentService->getDocumentDimensions('12345');
    }

    public function testListDocumentsByPhaseSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/7/status', ['pg' => 2])
            ->willReturn(new HttpResponse(200, '{"data": "phase_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->listDocumentsByPhase(7, 2);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "phase_success"}', $response->getBody());
    }

    public function testListDocumentsByPhaseThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/7/status', ['pg' => 2])
            ->willThrowException(new \Exception('Phase error occurred'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing documents with phase 7: Phase error occurred');

        $documentService->listDocumentsByPhase(7, 2);
    }

    public function testUploadDocumentToSafeSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/upload', ['key' => 'value'])
            ->willReturn(new HttpResponse(201, '{"data": "upload_success"}', []));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->uploadDocumentToSafe('safe123', $fieldsMock);

        $this->assertEquals(201, $response->status());
        $this->assertEquals('{"data": "upload_success"}', $response->getBody());
    }

    public function testUploadDocumentToSafeThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/upload', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error sending document to safe safe123: Server error');

        $documentService->uploadDocumentToSafe('safe123', $fieldsMock);
    }

    public function testUploadRelatedDocumentSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/document123/uploadslave', ['key' => 'value'])
            ->willReturn(new HttpResponse(201, '{"data": "uploadrelated_success"}', []));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->uploadRelatedDocument('document123', $fieldsMock);

        $this->assertEquals(201, $response->status());
        $this->assertEquals('{"data": "uploadrelated_success"}', $response->getBody());
    }

    public function testUploadRelatedDocumentThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/document123/uploadslave', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error sending document related to document document123: Server error');

        $documentService->uploadRelatedDocument('document123', $fieldsMock);
    }

    public function testAddDocumentHighlightSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/addhighlight', ['key' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data": "highlight_added"}', []));

        $fieldsMock = $this->createMock(HighlightFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->addDocumentHighlight('doc123', $fieldsMock);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "highlight_added"}', $response->getBody());
    }

    public function testAddDocumentHighlightThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/addhighlight', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(HighlightFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error adding highlight to document doc123: Server error');

        $documentService->addDocumentHighlight('doc123', $fieldsMock);
    }

    public function testSendDocumentToSignersSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/sendtosigner', ['key' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data": "success"}', []));

        $fieldsMock = $this->createMock(SendToSignersFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->sendDocumentToSigners('doc123', $fieldsMock);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "success"}', $response->getBody());
    }

    public function testSendDocumentToSignersThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/sendtosigner', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(SendToSignersFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error sending document doc123 to signers: Server error');

        $documentService->sendDocumentToSigners('doc123', $fieldsMock);
    }

    public function testCancelDocumentSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/cancel', ['comment' => 'Cancellation reason'])
            ->willReturn(new HttpResponse(200, '{"data": "canceled_successfully"}', []));

        $fieldsMock = $this->createMock(CancelDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['comment' => 'Cancellation reason']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->cancelDocument('doc123', $fieldsMock);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "canceled_successfully"}', $response->getBody());
    }

    public function testCancelDocumentThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/cancel', ['comment' => 'Cancellation reason'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(CancelDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['comment' => 'Cancellation reason']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error canceling document doc123: Server error');

        $documentService->cancelDocument('doc123', $fieldsMock);
    }

    public function testDownloadDocumentSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/download', [])
            ->willReturn(new HttpResponse(200, '{"data": "download_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->downloadDocument('doc123');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "download_success"}', $response->getBody());
    }

    public function testDownloadDocumentWithFieldsSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/download', ['type' => 'pdf', 'encoding' => true])
            ->willReturn(new HttpResponse(200, '{"data": "download_success_with_fields"}', []));

        $fieldsMock = $this->createMock(DownloadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['type' => 'pdf', 'encoding' => true]);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->downloadDocument('doc123', $fieldsMock);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "download_success_with_fields"}', $response->getBody());
    }

    public function testDownloadDocumentWithNullFields(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->expects($this->once())
            ->method('post')
            ->with('documents/doc123/download', [])
            ->willReturn(new HttpResponse(200, '{"data": "download_with_null"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->downloadDocument('doc123');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "download_with_null"}', $response->getBody());
    }

    public function testDownloadDocumentThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/download')
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error downloading document doc123: Server error');

        $documentService->downloadDocument('doc123');
    }

    public function testResendDocumentToSignersSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/resend', ['email' => 'signer@example.com'])
            ->willReturn(new HttpResponse(200, '{"data": "resend_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->resendDocumentToSigners('doc123', ['email' => 'signer@example.com']);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "resend_success"}', $response->getBody());
    }

    public function testResendDocumentToSignersThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/resend', ['email' => 'signer@example.com'])
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error resending document doc123 to signers: Server error');

        $documentService->resendDocumentToSigners('doc123', ['email' => 'signer@example.com']);
    }

    public function testListTemplatesSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('templates')
            ->willReturn(new HttpResponse(200, '{"data": "template_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->listTemplates();

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "template_success"}', $response->getBody());
    }

    public function testListTemplatesThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('templates')
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error listing document templates: Server error');

        $documentService->listTemplates();
    }

    public function testCreateDocumentFromHtmlTemplateSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/makedocumentbytemplate', ['key' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data": "html_template_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->createDocumentFromHtmlTemplate('doc123', ['key' => 'value']);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "html_template_success"}', $response->getBody());
    }

    public function testCreateDocumentFromHtmlTemplateThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/makedocumentbytemplate', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error creating document from HTML template doc123: Server error');

        $documentService->createDocumentFromHtmlTemplate('doc123', ['key' => 'value']);
    }

    public function testCreateDocumentFromWordTemplateSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/makedocumentbytemplateword', ['key' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data": "word_template_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->createDocumentFromWordTemplate('doc123', ['key' => 'value']);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "word_template_success"}', $response->getBody());
    }

    public function testCreateDocumentFromWordTemplateThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/makedocumentbytemplateword', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage('Error creating document from Word template doc123: Server error');

        $documentService->createDocumentFromWordTemplate('doc123', ['key' => 'value']);
    }

    public function testDownloadListDocumentWithFieldsSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc456/downloadlist', ['key' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data": "download_with_fields_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->downloadDocumentWithFields('doc456', ['key' => 'value']);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "download_with_fields_success"}', $response->getBody());
    }

    public function testDownloadListDocumentWithFieldsThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc789/downloadlist', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            "Failed to generate the document with fields for document ID 'doc789'. Fields: {\"key\":\"value\"}. Error: Server error",
        );

        $documentService->downloadDocumentWithFields('doc789', ['key' => 'value']);
    }

    public function testSetXYPositionOfHeadingsInDocumentSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/createrubricintemplateword', ['field' => 'value'])
            ->willReturn(new HttpResponse(200, '{"data":"success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->setXYPositionOfHeadingsInDocument('safe123', ['field' => 'value']);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data":"success"}', $response->getBody());
    }

    public function testSetXYPositionOfHeadingsInDocumentThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/createrubricintemplateword', ['field' => 'value'])
            ->willThrowException(new \Exception('Error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            "Failed to set the X-Y positions of headings in the document for Safe ID 'safe123'. Fields: {\"field\":\"value\"}. Error: Error",
        );

        $documentService->setXYPositionOfHeadingsInDocument('safe123', ['field' => 'value']);
    }

    public function testGenerateDocumentDownloadLinkSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/download', ['type' => 'pdf', 'document' => true])
            ->willReturn(new HttpResponse(200, '{"data": "download_link_success"}', []));

        $fieldsMock = $this->createMock(DownloadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['type' => 'pdf', 'document' => true]);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->generateDocumentDownloadLink('doc123', $fieldsMock);

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "download_link_success"}', $response->getBody());
    }

    public function testGenerateDocumentDownloadLinkThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/download', ['type' => 'pdf', 'document' => true])
            ->willThrowException(new \Exception('Error generating the download link'));

        $fieldsMock = $this->createMock(DownloadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['type' => 'pdf', 'document' => true]);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            'Error generating download link for document doc123: Error generating the download link',
        );

        $documentService->generateDocumentDownloadLink('doc123', $fieldsMock);
    }

    public function testListSplitDocumentsAndCertificatesSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/doc123/listslaves')
            ->willReturn(new HttpResponse(200, '{"data": "split_documents_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->listSplitDocumentsAndCertificates('doc123');

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "split_documents_success"}', $response->getBody());
    }

    public function testListSplitDocumentsAndCertificatesThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('get')
            ->with('documents/doc123/listslaves')
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            "Failed to retrieve the list of split documents and certificates for document ID 'doc123'. Error: Server error",
        );

        $documentService->listSplitDocumentsAndCertificates('doc123');
    }

    public function testUploadLargeDocumentSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/uploadbigfile', ['key' => 'value'])
            ->willReturn(new HttpResponse(201, '{"data": "large_upload_success"}', []));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->uploadLargeDocument('safe123', $fieldsMock);

        $this->assertEquals(201, $response->status());
        $this->assertEquals('{"data": "large_upload_success"}', $response->getBody());
    }

    public function testUploadLargeDocumentThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('asMultipart')
            ->willReturnSelf();
        $httpClientMock
            ->method('post')
            ->with('documents/safe123/uploadbigfile', ['key' => 'value'])
            ->willThrowException(new \Exception('Server error'));

        $fieldsMock = $this->createMock(UploadDocumentFieldsInterface::class);
        $fieldsMock
            ->method('toArray')
            ->willReturn(['key' => 'value']);

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            "Failed to upload a large document to the safe identified by 'safe123'. An unexpected error occurred during the process. Fields sent: {\"key\":\"value\"}. Error details: Server error",
        );

        $documentService->uploadLargeDocument('safe123', $fieldsMock);
    }

    public function testScheduleDocumentForSignatureSuccess(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/scheduling', ['scheduled_date' => '2023-11-01T10:00:00Z'])
            ->willReturn(new HttpResponse(200, '{"data": "schedule_success"}', []));

        $documentService = new DocumentService($httpClientMock);
        $response = $documentService->scheduleDocumentForSignature(
            'doc123',
            ['scheduled_date' => '2023-11-01T10:00:00Z'],
        );

        $this->assertEquals(200, $response->status());
        $this->assertEquals('{"data": "schedule_success"}', $response->getBody());
    }

    public function testScheduleDocumentForSignatureThrowsException(): void
    {
        $httpClientMock = $this->createMock(HttpClientInterface::class);
        $httpClientMock
            ->method('post')
            ->with('documents/doc123/scheduling', ['scheduled_date' => 'invalid_date'])
            ->willThrowException(new \Exception('Server error'));

        $documentService = new DocumentService($httpClientMock);

        $this->expectException(D4SignConnectException::class);
        $this->expectExceptionMessage(
            "Failed to schedule the document for signature. Document ID: 'doc123'. The provided fields could not be processed: {
    \"scheduled_date\": \"invalid_date\"
}. Error details: Server error.",
        );

        $documentService->scheduleDocumentForSignature('doc123', ['scheduled_date' => 'invalid_date']);
    }
}
