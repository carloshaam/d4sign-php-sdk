<?php

declare(strict_types=1);

namespace Carloshaam\D4signApi;

use Carloshaam\D4signApi\Resources\ResourceFactory;
use Carloshaam\D4signApi\Resources\ResourceInterface;
use Carloshaam\D4signApi\Resources\v1\Documents;

/**
 * @method Documents documents()
 */
class D4SignApiClient
{
    private Config $config;
    private ResourceFactory $factory;
    private array $cachedEndpoints = [];

    public function __construct(Config $config)
    {
        $this->setConfig($config);
        $this->factory = new ResourceFactory();
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    public function __call(string $name, array $arguments): ResourceInterface
    {
        if (! isset($this->cachedEndpoints[$name])) {
            try {
                $this->cachedEndpoints[$name] = $this->factory->createResource(
                    $this->getConfig()->getApiVersion(),
                    $name,
                    $this->getConfig(),
                );
            } catch (\InvalidArgumentException $e) {
                throw new \InvalidArgumentException("Resource {$name} not found.", 0, $e);
            }
        }

        return $this->cachedEndpoints[$name];
    }
}
