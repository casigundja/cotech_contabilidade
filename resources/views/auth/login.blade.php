<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#190864">
    <meta name="robots" content="noindex, nofollow">
    <title>Acesso da equipe | Cotech</title>
    <link rel="icon" href="/images/logo.jpeg">
    <link rel="stylesheet" href="/css/site.css">
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-brand-panel" aria-labelledby="brand-title">
            <a class="auth-brand" href="/" aria-label="Cotech, página inicial">
                <img src="/images/logo.jpeg" alt="" width="54" height="54">
                <span>COTECH<small>O FUTURO EM SUAS MÃOS</small></span>
            </a>

            <div class="auth-brand-copy">
                <span class="auth-kicker"><i aria-hidden="true"></i> CONTABILIDADE E CONSULTORIA</span>
                <h1 id="brand-title">Mais clareza para cuidar do que você está construindo.</h1>
                <p>Conte com a Cotech para simplificar a rotina contábil e apoiar as próximas decisões do seu negócio.</p>
                <div class="auth-highlights" aria-label="Soluções Cotech">
                    <div><span class="highlight-icon" aria-hidden="true">01</span><span><strong>Contabilidade próxima</strong><small>Suporte para a rotina da sua empresa.</small></span></div>
                    <div><span class="highlight-icon" aria-hidden="true">02</span><span><strong>Decisões com confiança</strong><small>Orientação tributária e financeira.</small></span></div>
                    <div><span class="highlight-icon" aria-hidden="true">03</span><span><strong>Seu negócio em movimento</strong><small>Mais tempo para focar no crescimento.</small></span></div>
                </div>
            </div>

            <div class="auth-brand-footer"><span>Conhecimento. Proximidade. Novas possibilidades.</span><a href="/">Conheça a Cotech <span aria-hidden="true">↗</span></a></div>
            <div class="auth-orb auth-orb-one" aria-hidden="true"></div>
            <div class="auth-orb auth-orb-two" aria-hidden="true"></div>
        </section>

        <section class="auth-form-panel" aria-labelledby="login-title">
            <div class="auth-form-top"><span>ÁREA DA EQUIPE</span><a href="/">Voltar ao site <span aria-hidden="true">↗</span></a></div>
            <div class="auth-form-wrap">
                <div class="auth-mobile-brand"><img src="/images/logo.jpeg" alt="" width="46" height="46"><strong>COTECH</strong></div>
                <div class="auth-heading-mark" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM5 21a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></div>
                <span class="auth-form-eyebrow">BEM-VINDO DE VOLTA</span>
                <h2 id="login-title">Acesse sua conta</h2>
                <p class="auth-form-intro">Entre com seus dados para continuar no painel da Cotech.</p>

                @if(session('success'))
                    <div class="auth-message auth-message-success" role="status">{{ session('success') }}</div>
                @endif
                @if(isset($errors) && $errors->any())
                    <div class="auth-message auth-message-error" role="alert">{{ $errors->first() }}</div>
                @endif

                <form method="post" action="/login" class="auth-login-form">
                    @csrf
                    <div class="auth-field">
                        <label for="email">E-mail</label>
                        <div class="auth-input-wrap"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg><input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nome@empresa.com.br" autocomplete="username" required autofocus></div>
                    </div>
                    <div class="auth-field">
                        <div class="auth-label-row"><label for="password">Senha</label><a href="/forgot-password">Esqueceu a senha?</a></div>
                        <div class="auth-input-wrap"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10V7a4 4 0 1 1 8 0v3M12 14v3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg><input type="password" id="password" name="password" placeholder="Digite sua senha" autocomplete="current-password" required></div>
                    </div>
                    <label class="auth-remember"><input type="checkbox" name="remember" value="1"><span class="auth-checkbox" aria-hidden="true"></span><span>Manter conectado</span></label>
                    <button class="auth-submit" type="submit">Entrar no painel <span aria-hidden="true">→</span></button>
                </form>

                <div class="auth-secure-note"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg> Acesso seguro e exclusivo para a equipe Cotech</div>
            </div>
            <footer class="auth-form-footer"><span>© {{ date('Y') }} Cotech Contabilidade</span><a href="{{ \App\Support\Company::whatsapp() ?: '/orcamento' }}" target="_blank" rel="noopener">Precisa de ajuda?</a></footer>
        </section>
    </main>
</body>
</html>
