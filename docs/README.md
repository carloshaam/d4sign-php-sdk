# D4Sign SDK PHP

Este SDK fornece uma integração completa com a API da D4Sign, facilitando o uso das funcionalidades da plataforma em aplicações PHP.
Com este pacote, você pode gerenciar Cofres, Documentos, Signatários, Usuários, Tags, Certificados e Observadores de maneira intuitiva e eficiente.

Para obter instruções de instalação e implementação, consulte o guia [Introdução ao SDK da D4sign para PHP](./getting_started.md) e confira alguns dos exemplos abaixo.

---

## Exemplos

Os exemplos a seguir demonstram como você realizaria tarefas comuns com o SDK da D4Sign para PHP.

- Cofres
  - [Listar todos os cofres](./examples/safe/list_all_safes.md)
  - [Listar todos os documentos de um cofre ou pasta](./examples/safe/list_all_documents_in_a_safe_or_folder.md)
  - [Listar pastas do cofre](./examples/safe/list_safe_folders.md)
  - [Criar pasta ou subpasta no cofre](./examples/safe/create_folder_or_subfolder_in_safe.md)
  - [Renomear pasta ou subpasta do cofre](./examples/safe/rename_safe_folder_or_subfolder.md)
  - [Criar lote](./examples/safe/create_batch.md)
  - [Exibir saldo da conta](./examples/safe/show_account_balance.md)
- Documentos
  - [Listar todos os documentos](./examples/document/list_all_documents.md)
  - [Listar um documento específico](./examples/document/list_a_specific_document.md)
  - [Verificar as dimensões de um documento](./examples/document/check_document_dimensions.md)
  - [Listar todos os documentos de uma fase](./examples/document/list_all_documents_in_a_phase.md)
  - [UPLOAD de um documento principal](./examples/document/upload_a_main_document.md)
  - [UPLOAD de um documento anexo ao principal](./examples/document/upload_a_document_attached_to_main.md)
  - [UPLOAD de um documento principal (Binário)](./examples/document/upload_a_main_document_binary.md)
  - [UPLOAD de um documento anexo ao principal (Binário)](./examples/document/upload_a_document_attached_to_main_binary.md)
  - [UPLOAD de um hash de documento (HASH)](./examples/document/upload_a_document_hash.md)
  - [Destacar cláusulas](./examples/document/highlight_clauses.md)
  - [Enviar documento para assinatura](./examples/document/send_document_for_signature.md)
  - [Cancelar um documento](./examples/document/cancel_a_document.md)
  - [DOWNLOAD de um documento](./examples/document/download_a_document.md)
  - [Reenviar link de assinatura](./examples/document/resend_signature_link.md)
  - [Listar templates](./examples/document/list_templates.md)
  - [Documento a partir do template HTML](./examples/document/document_from_html_template.md)
  - [Documento a partir do template WORD](./examples/document/document_from_word_template.md)
  - [Download em formato PDF/A](./examples/document/download_in_pdf_format_a.md)
  - [Download de Documentos e Certificados de Assinaturas Desmembrados](./examples/document/download_documents_and_separated_signature_certificates.md)
  - [Posicionamento XY de Rubricas](./examples/document/xy_positioning_of_initials.md)
  - [Download Documentos Base 64](./examples/document/download_documents_base_64.md)
  - [UPLOAD de Big File - Documento principal acima de 20MB](./examples/document/upload_big_file.md)
  - [Documento a partir do template WORD com mais de 1 preenchedor](./examples/document/document_from_word_template_with_more_than_one_filler.md)
  - [Agendamento de envio de documentos para assinatura](./examples/document/schedule_sending_documents_for_signature.md)
- Signatários
  - [Listar signatários de um documento](./examples/signatory/list_document_signers.md)
  - [Listar Grupos de Assinaturas](./examples/signatory/list_signature_groups.md)
  - [Cadastrar signatários](./examples/signatory/register_signers.md)
  - [Alterar signatário](./examples/signatory/update_signer.md)
  - [Alterar número do SMS](./examples/signatory/update_sms_number.md)
  - [Alterar código de acesso do signatário](./examples/signatory/update_signer_access_code.md)
  - [Remover signatário](./examples/signatory/remove_signer.md)
  - [Adicionar assinatura posicionada no documento principal ou anexo com pins de rubrica](./examples/signatory/add_positioned_signature_to_main_document_or_attachment_with_initial_pins.md)
  - [Remover assinatura posicionada ao documento](./examples/signatory/remove_positioned_signature_from_document.md)
  - [Listar assinaturas posicionadas ao documento](./examples/signatory/list_positioned_signatures_on_document.md)
  - [Cadastrar informações do signatário](./examples/signatory/register_signer_information.md)
  - [Criação de Nomenclatura em Assinar Como](./examples/signatory/create_nomenclature_in_sign_as.md)
  - [Listar detalhes de Grupo de assinatura](./examples/signatory/list_signature_group_details.md)
  - [Copiar Link de Assinatura](./examples/signatory/copy_signature_link.md)
  - [Inserir pin de rubrica do grupo de assinatura no documento.](./examples/signatory/insert_signature_group_initial_pin_into_document.md)
  - [Replicar posição de assinatura em todas as páginas de um documento e anexo](./examples/signatory/replicate_signature_position_across_all_pages_of_document_and_attachment.md)
  - [Remover posições de assinatura replicadas no documento e anexo](./examples/signatory/remove_replicated_signature_positions_from_document_and_attachment.md)
- Usuários
  - [Listar todos os usuários](./examples/user/list_all_users.md)
  - [Verificar Usuário](./examples/user/check_user.md)
  - [Bloquear usuário](./examples/user/block_user.md)
  - [Desbloquear usuário](./examples/user/unblock_user.md)
- Tags
  - [Listar as TAGs do documento](./examples/tag/list_the_documents_tags.md)
  - [Adicionar TAGs no documento](./examples/tag/add_tags_to_the_document.md)
  - [Remover TAGs do documento](./examples/tag/remove_tags_from_the_document.md)
  - [Remover TODAS as TAGs do documento](./examples/tag/remove_all_tags_from_the_document.md)
  - [Adicionar TAG URGENTE ao documento](./examples/tag/add_urgent_tag_to_the_document.md)
  - [Remover TAG URGENTE do documento](./examples/tag/remove_urgent_tag_from_the_document.md)
- Certificados
  - [Listar certificado definido](./examples/certificate/list_defined_certificate.md)
  - [Definir certificado](./examples/certificate/define_certificate.md)
- Observadores
  - [Listar observadores do documento](./examples/watcher/list_document_watchers.md)
  - [Adicionar observador no documento](./examples/watcher/add_watcher_to_document.md)
  - [Remover observador do documento](./examples/watcher/remove_watcher_from_document.md)
  - [Remover TODOS os observadores do documento](./examples/watcher/remove_all_watchers_from_document.md)
- Webhooks
  - [Listar Webhook de um documento](./examples/webhook/list_webhook_of_a_document.md)
  - [Cadastrar Webhook em um documento](./examples/webhook/register_webhook_in_a_document.md)

## API Reference

Para uma lista completa de classes, consulte a página de [referência da API](./reference.md).