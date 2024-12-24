<?php

declare(strict_types=1);

namespace D4Sign\User;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\Contracts\HttpResponseInterface;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\User\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listUsers(int $page = 1): HttpResponseInterface
    {
        try {
            return $this->httpClient->get('users/list', ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to list users on page %d. Error: %s',
                    $page,
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function checkUser(array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post('users/check', $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to check user with fields: %s. Error: %s',
                    json_encode($fields),
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function blockUser(array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post('users/block', $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to block user with fields: %s. Error: %s',
                    json_encode($fields),
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unblockUser(array $fields): HttpResponseInterface
    {
        try {
            return $this->httpClient->post('users/unblock', $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                sprintf(
                    'Failed to unblock user with fields: %s. Error: %s',
                    json_encode($fields),
                    $e->getMessage()
                ),
                $e->getCode(),
                $e,
            );
        }
    }
}
