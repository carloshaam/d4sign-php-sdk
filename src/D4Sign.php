<?php

declare(strict_types=1);

namespace D4Sign;

use D4Sign\Contracts\CertificateServiceInterface;
use D4Sign\Contracts\DocumentServiceInterface;
use D4Sign\Contracts\SafeServiceInterface;
use D4Sign\Contracts\SignatoryServiceInterface;
use D4Sign\Contracts\TagServiceInterface;
use D4Sign\Contracts\UserServiceInterface;
use D4Sign\Contracts\WatcherServiceInterface;
use D4Sign\Contracts\WebhookServiceInterface;
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
    private D4SignClient $client;
    private ?SafeServiceInterface $safes = null;
    private ?DocumentServiceInterface $documents = null;
    private ?SignatoryServiceInterface $signatories = null;
    private ?UserServiceInterface $users = null;
    private ?TagServiceInterface $tags = null;
    private ?CertificateServiceInterface $certificates = null;
    private ?WatcherServiceInterface $watchers = null;
    private ?WebhookServiceInterface $webhooks = null;

    public function __construct(
        string $tokenAPI,
        string $cryptKey,
        string $baseUrl = 'https://sandbox.d4sign.com.br/api/v1'
    ) {
        $this->client = new D4SignClient($tokenAPI, $cryptKey, $baseUrl);
    }

    public function __get($name)
    {
        $method = $name;
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new \RuntimeException("Property {$name} does not exist");
    }

    public function safes(): SafeServiceInterface
    {
        if ($this->safes === null) {
            $this->safes = new SafeService($this->client);
        }

        return $this->safes;
    }

    public function documents(): DocumentServiceInterface
    {
        if ($this->documents === null) {
            $this->documents = new DocumentService($this->client);
        }

        return $this->documents;
    }

    public function signatories(): SignatoryServiceInterface
    {
        if ($this->signatories === null) {
            $this->signatories = new SignatoryService($this->client);
        }

        return $this->signatories;
    }

    public function users(): UserServiceInterface
    {
        if ($this->users === null) {
            $this->users = new UserService($this->client);
        }

        return $this->users;
    }

    public function tags(): TagServiceInterface
    {
        if ($this->tags === null) {
            $this->tags = new TagService($this->client);
        }

        return $this->tags;
    }

    public function certificates(): CertificateServiceInterface
    {
        if ($this->certificates === null) {
            $this->certificates = new CertificateService($this->client);
        }

        return $this->certificates;
    }

    public function watchers(): WatcherServiceInterface
    {
        if ($this->watchers === null) {
            $this->watchers = new WatcherService($this->client);
        }

        return $this->watchers;
    }

    public function webhooks(): WebhookServiceInterface
    {
        if ($this->webhooks === null) {
            $this->webhooks = new WebhookService($this->client);
        }

        return $this->webhooks;
    }
}
