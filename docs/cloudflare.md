# Cotech no Cloudflare Workers

O site, os orçamentos e o painel são atendidos pelo backend JavaScript em `worker/index.js`, com Hono, Postgres.js e Hyperdrive. O Laravel permanece disponível para uso local e como referência da implementação original. O Worker não executa PHP.

## Publicação

- Worker: `cotech-contabilidade`
- URL: `https://cotech-contabilidade.casimirogundja.workers.dev`
- Banco: PostgreSQL Supabase, schema `cotech`.
- Conexão: Hyperdrive `cotech-db`, sem cache de consultas, com usuário restrito ao schema Cotech.
- Assets: apenas CSS, JavaScript e imagens públicas, copiados para `build/cloudflare`.

```powershell
npm ci
npm run deploy:worker
```

O Wrangler executa o build dos assets automaticamente. As credenciais ficam no Hyperdrive, nunca no JavaScript, no arquivo Wrangler ou no Git. O `.env` do Laravel não é publicado.

## Funcionalidades convertidas

Páginas públicas dinâmicas, sitemap, login/logout, sessões de duas horas, proteção CSRF e validação de origem, perfis administrador/atendimento/editor, painel por período, leads e funil, histórico, responsáveis e prioridades, conversão transacional em cliente, solicitações de serviço, conteúdo com rascunhos/agendamento/expiração, SEO, imagens, configurações, criação de usuários, redefinição administrativa de senha e auditoria.

Os orçamentos preservam consentimento, origem de campanhas e até cinco anexos de 5 MB. Os formatos são validados por assinatura. Anexos privados e imagens ficam em `cotech.worker_files` no PostgreSQL: não dependem de disco local, Containers ou R2. Anexos só podem ser baixados por administrador/atendimento. Excluir o lead remove seus anexos por chave estrangeira. Os blobs consomem a cota do Supabase; para volumes maiores, migrar para armazenamento de objetos.

Senhas online usam PBKDF2-SHA256 com salt aleatório e 100.000 iterações via Web Crypto. Tokens de sessão e recuperação são armazenados como hashes. O primeiro administrador usa as credenciais de `storage/app/private/local-access.txt`, ignorado pelo Git. Alterações posteriores de senha online não alteram o Laravel local.

## E-mails

O recebimento de orçamentos funciona independentemente do e-mail. Notificações ficam em `worker_mail`. Para envio, configurar um binding Cloudflare Email Service chamado `MAILER` e a variável `MAIL_FROM` com remetente autorizado. Sem essa configuração, o painel informa o estado pendente; a recuperação por e-mail informa a indisponibilidade. Um administrador pode redefinir senhas nas configurações.

O cron a cada dez minutos limpa sessões/tokens/limites expirados e, quando o binding está configurado, tenta enviar as notificações pendentes, até cinco tentativas.

## Desenvolvimento e testes

`scripts/provision-worker.php` aplica `worker/schema.sql`, cria a conexão restrita e inicializa o primeiro administrador quando ainda não existe. Usa os arquivos privados de `storage/app/private/deploy` e nunca imprime senhas. As migrations Laravel e os conteúdos iniciais devem existir antes desse passo.

```powershell
npm run dev:worker
npm run test:worker
```

O servidor local usa a conexão privada de `storage/app/private/deploy/worker-db.json`. Os testes de integração recusam URLs públicas e usam registros temporários identificados por prefixo, removidos ao terminar. Cobrem autorização, CSRF, validação, conteúdo, anexos, limites de envio, conversão concorrente e recuperação de senha. Não editar os módulos durante os testes: o reload do runtime interrompe conexões em andamento.

O template da página inicial preserva o layout Laravel com regiões dinâmicas. Para reconverter alterações estruturais no Blade, executar `php scripts/capture-home.php` e `node scripts/convert-home.mjs`. Conteúdo editado no painel não exige novo deploy.

## Reversão e backup

Versão convertida publicada e verificada: `77dfd0bb-afee-494c-a70f-50ae8dd9946f`.

Validações concluídas: integração local completa (`tests/worker-check.mjs`), navegador em desktop/celular e login na prévia (`tests/worker-browser.mjs`), cinco anexos simultâneos de 5 MB persistidos e removidos na prévia (`tests/worker-upload-preview.mjs`) e verificação do site, login/logout e painel no endereço final (`tests/worker-live-smoke.mjs`). O envio de e-mails ainda exige configurar `MAILER` e `MAIL_FROM`.

A versão estática anterior era `d293ba32-aec6-49c8-af2d-78e824d4ffa0`. As versões ficam no histórico da Cloudflare. Reverter o código não apaga os dados. Fazer backup do PostgreSQL incluindo o schema `cotech` e os blobs em `worker_files`.
