# Cotech — Plataforma institucional e comercial

Aplicação Laravel 12 com site público responsivo, solicitação de propostas e painel de gestão. Interface em português, identidade visual Cotech e imagens fornecidas no projeto. CSS e JavaScript são servidos diretamente de `public`; não é necessário compilar assets para executar esta versão.

## Acesso local

- Site: http://127.0.0.1:8000
- Painel: http://127.0.0.1:8000/login
- Credenciais criadas nesta instalação: `storage/app/private/local-access.txt` (arquivo privado, ignorado no versionamento).
- Iniciar no Windows: execute `./Start-Cotech.ps1` na pasta do projeto. Mantenha o terminal aberto; Ctrl+C encerra o servidor.
- Alternativa: `php -d upload_max_filesize=6M -d post_max_size=30M artisan serve --host=127.0.0.1 --port=8000`.

## Funcionalidades

- Página inicial, serviços, artigos, equipe, perguntas frequentes e página de privacidade.
- Conteúdos editáveis, imagens, rascunhos, agendamento, expiração, metadados e sitemap.
- Orçamentos com consentimento, até cinco anexos privados de 5 MB, identificação da origem da visita e limite de envios.
- Painel com indicadores por período, filtros, funil comercial, atribuição de responsável e histórico de contatos.
- Conversão de lead em cliente com solicitação de serviço, sem duplicar conversões repetidas.
- Clientes, atualização do andamento de solicitações, configurações da empresa, usuários e etapas do funil.
- Perfis: administrador (acesso completo), atendimento (comercial) e editor (conteúdo).
- Login, recuperação de senha, sessões, proteção CSRF e registro de auditoria.
- Notificações de orçamento por fila. No ambiente local, e-mails são gravados no log; não são enviados externamente.

## Instalação em outro ambiente

Requisitos: PHP 8.2 ou superior, Composer e extensões PDO SQLite, mbstring, fileinfo, OpenSSL, DOM e XML.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File -ErrorAction SilentlyContinue
php artisan migrate --seed
php artisan storage:link
php artisan cotech:admin
```

O comando de administrador solicita e-mail e senha sem exibi-la. Para uma instalação exclusivamente local, `php artisan cotech:admin admin@cotech.local --generate` cria uma senha aleatória no arquivo privado de acesso. O comando não sobrescreve usuários existentes. O seeder pode ser repetido e preserva conteúdos e configurações já editados.

## Operação

No painel, configure os contatos reais, WhatsApp com código do país, endereço e horário. Os textos iniciais são editáveis; não foram inventados telefones, certificações ou depoimentos. Categorias e tags podem ser cadastradas como conteúdo, e o campo categoria dos serviços e artigos é textual.

Para processar notificações:

```powershell
php artisan queue:work --tries=3
```

Para receber e-mails reais, configure `MAIL_MAILER=smtp`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS` e demais opções do provedor em `.env`. Configure também o e-mail de atendimento no painel. A recuperação de senha depende do transporte de e-mail configurado. Credenciais de SMTP, hospedagem e domínio não estão incluídas neste repositório.

## Testes

```powershell
php artisan test
php artisan view:cache
```

Os testes usam SQLite em memória e não alteram os dados locais. Cobrem páginas públicas e administrativas, permissões, login e redefinição de senha, publicação e agendamento, escaping de conteúdo, uploads privados e públicos, exclusão, conversão, configurações e limite de envios.

`scripts/browser-check.cjs` verifica desktop e celular no Microsoft Edge usando Playwright. Instale `@playwright/test` para executá-lo. `PLAYWRIGHT_MODULE` permite usar uma instalação existente; `APP_TEST_URL` altera a URL. Forneça `COTECH_TEST_EMAIL` e `COTECH_TEST_PASSWORD` via ambiente para incluir as páginas autenticadas. Capturas ficam em `storage/app/checks`.

## Publicação

A instalação atual funciona localmente. Para publicar, use uma hospedagem PHP com a raiz web apontando somente para `public`, HTTPS e `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` correspondente ao domínio e `SESSION_SECURE_COOKIE=true`. Ajuste `APP_TIMEZONE` conforme a operação. Configure uploads com `upload_max_filesize` de pelo menos 5 MB e `post_max_size` de pelo menos 30 MB.

Instale dependências com `composer install --no-dev --optimize-autoloader`, execute `php artisan migrate --force`, `php artisan storage:link` e `php artisan optimize`. Mantenha o worker da fila supervisionado. Preserve a chave `APP_KEY`, o banco e os arquivos enviados; faça backups do SQLite com a ferramenta de backup do banco e inclua `storage/app/private` e `storage/app/public` na rotina. Não publique `.env` nem o arquivo privado de acesso local.
