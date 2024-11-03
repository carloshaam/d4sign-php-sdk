<?php

declare(strict_types=1);

namespace D4Sign\Services;

use D4Sign\D4SignClient;

class BaseService
{
    protected D4SignClient $client;

    public function __construct(D4SignClient $client)
    {
        $this->client = $client;
    }

    protected function get($uri, $options = [])
    {
        return $this->client->get($uri, $options);
    }

    protected function post($uri, $options = [])
    {
        return $this->client->post($uri, $options);
    }

    protected function postAsync($uri, $options = [])
    {
        return $this->client->postAsync($uri, $options);
    }

    protected function put($uri, $options = [])
    {
        return $this->client->put($uri, $options);
    }

    protected function delete($uri, $options = [])
    {
        return $this->client->delete($uri, $options);
    }

    protected function options($uri, $options = [])
    {
        return $this->client->options($uri, $options);
    }
}
