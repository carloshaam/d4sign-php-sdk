<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi\Resources\v1;

use Carloshaam\D4signApi\Config;
use Carloshaam\D4signApi\Resources\AbstractResource;

class Documents extends AbstractResource
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    public function getAll(): array
    {
        return $this->request('GET', 'documents');
    }

    public function getByUuid(string $documentId): array
    {
        return $this->request('GET', "documents/{$documentId}");
    }
}
