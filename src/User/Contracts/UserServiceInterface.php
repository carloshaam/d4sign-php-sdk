<?php

declare(strict_types=1);

namespace D4Sign\User\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

/**
 * Interface responsável por definir os contratos de ações relacionadas aos usuários no sistema.
 */
interface UserServiceInterface
{
    /**
     * Lista os usuários disponíveis, com suporte à paginação.
     *
     * @param int $page O número da página a ser listado. Valor padrão: 1.
     *
     * @return HttpResponseInterface Uma instância contendo a resposta da API para a listagem de usuários.
     */
    public function listUsers(int $page = 1): HttpResponseInterface;

    /**
     * Verifica a existência ou o status de um usuário com base nas informações fornecidas.
     *
     * @param array $fields Os dados necessários para identificar o usuário.
     *                      Exemplo esperado: ['email_user' => 'usuario@exemplo.com'].
     *
     * @return HttpResponseInterface Uma instância contendo a resposta da API referente à verificação do usuário.
     */
    public function checkUser(array $fields): HttpResponseInterface;

    /**
     * Bloqueia um usuário específico com base nas informações fornecidas.
     *
     * @param array $fields Os dados necessários para identificar ou configurar o bloqueio do usuário.
     *                      Exemplo esperado: ['email_user' => 'usuario@exemplo.com'].
     *
     * @return HttpResponseInterface Uma instância contendo a resposta da API referente ao bloqueio do usuário.
     */
    public function blockUser(array $fields): HttpResponseInterface;

    /**
     * Desbloqueia um usuário específico com base nas informações fornecidas.
     *
     * @param array $fields Os dados necessários para identificar ou configurar o desbloqueio do usuário.
     *                      Exemplo esperado: ['email_user' => 'usuario@exemplo.com'].
     *
     * @return HttpResponseInterface Uma instância contendo a resposta da API referente ao desbloqueio do usuário.
     */
    public function unblockUser(array $fields): HttpResponseInterface;
}
