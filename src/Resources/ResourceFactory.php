<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi\Resources;

use Carloshaam\D4signApi\Config;

class ResourceFactory
{
    protected array $endpoints = [
        'v1' => [
            'documents' => \Carloshaam\D4signApi\Resources\v1\Documents::class,
        ],
    ];

    public function createResource(string $version, string $name, Config $config): ResourceInterface
    {
        if (! isset($this->endpoints[$version][$name])) {
            throw new \InvalidArgumentException("Resource {$name} for version {$version} not found.");
        }

        $endpointClass = $this->endpoints[$version][$name];
        $reflectionClass = new \ReflectionClass($endpointClass);

        if (! $reflectionClass->implementsInterface(ResourceInterface::class)) {
            throw new \InvalidArgumentException(
                "Class {$endpointClass} does not implement the EndpointInterface interface.",
            );
        }

        return $reflectionClass->newInstanceArgs([$config]);
    }
}
