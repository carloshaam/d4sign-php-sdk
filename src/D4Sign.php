<?php

declare(strict_types=1);

namespace D4Sign;

use D4Sign\Services\CertificateService;
use D4Sign\Services\DocumentService;
use D4Sign\Services\SafeService;
use D4Sign\Services\SignatoryService;
use D4Sign\Services\TagService;
use D4Sign\Services\UserService;
use D4Sign\Services\WatcherService;
use D4Sign\Services\WebhookService;

class D4Sign
{
    public SafeService $safes;
    public DocumentService $documents;
    public SignatoryService $signatories;
    public UserService $users;
    public TagService $tags;
    public CertificateService $certificates;
    public WatcherService $watchers;
    public WebhookService $webhooks;

    public function __construct(
        string $tokenAPI,
        string $cryptKey,
        string $baseUrl = 'https://sandbox.d4sign.com.br/api/v1'
    ) {
        $client = new D4SignClient($tokenAPI, $cryptKey, $baseUrl);

        $this->safes = new SafeService($client);
        $this->documents = new DocumentService($client);
        $this->signatories = new SignatoryService($client);
        $this->users = new UserService($client);
        $this->tags = new TagService($client);
        $this->certificates = new CertificateService($client);
        $this->watchers = new WatcherService($client);
        $this->webhooks = new WebhookService($client);
    }
}
