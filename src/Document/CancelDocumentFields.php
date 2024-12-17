<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Document\Contracts\CancelDocumentFieldsInterface;

class CancelDocumentFields implements CancelDocumentFieldsInterface
{
    private string $comment;

    /**
     * Construtor principal.
     *
     * @param string $comment Comentário explicando o cancelamento.
     */
    public function __construct(string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Retorna os dados formatados para a API.
     *
     * @return array Dados no formato correto.
     */
    public function toArray(): array
    {
        return [
            'comment' => $this->comment,
        ];
    }
}
