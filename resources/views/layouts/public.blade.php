@php($company = \App\Support\Company::all())
<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#190864">
<title>@yield('title', 'Cotech — O futuro em suas mãos')</title>
<meta name="description" content="@yield('description', 'Contabilidade, consultoria e soluções para o crescimento do seu negócio. Conheça a Cotech e solicite uma proposta.')">
<link rel="icon" type="image/svg+xml" href="/favicon.svg?v=16"><link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=16"><link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=16"><link rel="shortcut icon" href="/favicon.ico?v=16"><link rel="stylesheet" href="/css/site.css"><link rel="stylesheet" href="/css/public.css?v=16"><script src="/js/site.js?v=16" defer></script>
</head>
<body class="public-site">
<a class="skip" href="#main">Ir para o conteúdo</a><div class="scroll-progress" aria-hidden="true"></div>
<div class="topbar"><div class="container"><span><i class="tiny-dot"></i> O futuro em suas mãos.</span><span>{{ $company['hours'] ?? 'Conhecimento. Proximidade. Novas possibilidades.' }}</span><a href="/login">Área da equipe ↗</a></div></div>
<header class="header"><div class="container header-inner"><a class="brand" href="/" aria-label="Cotech, início"><img src="/images/logo.jpeg" alt="Logotipo Cotech" width="42" height="42"><span class="brand-text"><span class="brand-name">Cotech<span class="cyan-dot">.</span></span><small>O FUTURO EM SUAS MÃOS</small></span></a><button class="mobile-toggle" data-menu aria-controls="main-nav" aria-expanded="false">Menu <span aria-hidden="true">☰</span></button><nav id="main-nav" aria-label="Principal"><div class="nav-center-links"><a class="{{ request()->is('/') ? 'current' : '' }}" href="/">Home</a><a href="/servicos#facilidade">Planos</a><div class="nav-item-dropdown"><a class="dropdown-trigger {{ request()->is('calculador*') || request()->is('servicos*') ? 'current' : '' }}" href="/servicos">Conteúdos <span class="nav-caret"></span></a><div class="header-mega-menu wide-menu"><div class="mega-menu-inner"><div class="mega-group"><span class="mega-group-title">Serviços</span><a href="/servicos/abertura-e-regularizacao-de-empresas">🏢 Abertura e regularização de empresas</a><a href="/servicos/abertura-de-cnpj">Abertura de CNPJ</a><a href="/servicos/consultoria-tributaria-e-financeira">💰 Consultoria tributária e financeira</a><a href="/servicos/departamento-pessoal-rh">👥 Departamento pessoal / RH</a><a href="/servicos/servicos-para-pessoa-fisica">👤 Serviços para pessoa física</a><a href="/servicos/servicos-para-mei">🧾 Serviços para MEI</a></div><div class="mega-group"><span class="mega-group-title">Calculadoras & Ferramentas</span><a href="/calculadora-de-custo-para-tirar-cnpj">Calculadora de Custo para abrir CNPJ</a><a href="/calculadora-clt-pj">Calculadora PJ x CLT</a><a href="/calculadora-fator-r">Calculadora de Fator R</a><a href="/calculadora-rpa-autonomo">Calculadora de RPA online</a><a href="/calculadora-reforma-tributaria">Calculadora de Reforma Tributária</a></div></div></div></div><a class="{{ request()->is('servicos') ? 'current' : '' }}" href="/servicos">Como funciona</a><a href="/servicos#faq">Dúvidas?</a></div><div class="nav-right-actions"><a class="header-btn-cyan" href="/calculadora-de-custo-para-tirar-cnpj">Abra sua empresa</a></div></nav></div></header>
<main id="main">@if(session('success') || (isset($errors) && $errors->any()))<div class="container">@include('partials.feedback')</div>@endif @yield('content')</main>
<footer class="cotech-footer">
    <div class="container">
        <!-- Top Columns -->
        <div class="cotech-footer-grid">
            <!-- Brand & Social Column -->
            <div class="cotech-footer-brand-col">
                <div class="cotech-brand-hero">
                    <div class="brand-text-block">
                        <span class="cotech-wordmark">Cotech<span class="cyan-dot">.</span></span>
                        <span class="cotech-since">DESDE 2012</span>
                    </div>
                    <p class="cotech-brand-slogan">
                        <span class="cyan-word">Simplificando</span> a vida de<br>
                        quem empreende no<br>
                        <span class="cyan-word">Brasil e potencializando</span><br>
                        histórias de sucesso.
                    </p>
                </div>

                <div class="footer-col1-divider" aria-hidden="true"></div>

                <div class="footer-social-row" aria-label="Redes Sociais">
                    <a href="https://youtube.com" target="_blank" rel="noopener" class="social-circle" aria-label="YouTube">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#00266e"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://linkedin.com" target="_blank" rel="noopener" class="social-circle" aria-label="LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#00266e"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                    </a>
                    <a href="https://facebook.com" target="_blank" rel="noopener" class="social-circle" aria-label="Facebook">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="#00266e"><path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"/></svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noopener" class="social-circle" aria-label="Instagram">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="#00266e"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>

                <div class="footer-simple-links">
                    <a href="{{ \App\Support\Company::whatsapp() ?: '/orcamento' }}" target="_blank" rel="noopener">Fale Conosco</a>
                    <a href="/orcamento">Canal de Ética</a>
                </div>
            </div>

            <!-- Column 2: A EMPRESA -->
            <div class="cotech-footer-nav-col">
                <h3 class="footer-col-title">A EMPRESA</h3>
                <ul class="footer-links-list">
                    <li><a href="/#sobre">Sobre nós</a></li>
                    <li><a href="/servicos">Contador Online</a></li>
                    <li><a href="/#sobre">Depoimentos de clientes</a></li>
                    <li><a href="/orcamento">Trabalhe na Cotech</a></li>
                    <li><a href="/#sobre">Imprensa</a></li>
                    <li><a href="/sitemap.xml">Mapa do site</a></li>
                    <li><a href="/orcamento">Seja nosso parceiro</a></li>
                </ul>
            </div>

            <!-- Column 3: CONTABILIDADE -->
            <div class="cotech-footer-nav-col">
                <h3 class="footer-col-title">CONTABILIDADE</h3>
                <ul class="footer-links-list">
                    <li><a href="/calculadora-de-custo-para-tirar-cnpj">Abrir empresa online</a></li>
                    <li><a href="/orcamento">Trocar de contador</a></li>
                    <li><a href="/servicos">Como funciona?</a></li>
                    <li><a href="/orcamento">Quanto custa?</a></li>
                    <li><a href="/servicos/abertura-e-regularizacao-de-empresas">Cidades atendidas</a></li>
                    <li><a href="/calculadora-fator-r">Consultor de CNAE</a></li>
                    <li><a href="/servicos#faq">Cotech Responde</a></li>
                </ul>
            </div>

            <!-- Column 4: SEGURANÇA -->
            <div class="cotech-footer-nav-col">
                <h3 class="footer-col-title">SEGURANÇA</h3>
                <ul class="footer-links-list">
                    <li><a href="#crc">Registro no CRC</a></li>
                    <li><a href="/pagina/privacidade">Política de privacidade</a></li>
                    <li><a href="/servicos#faq">Perguntas frequentes</a></li>
                    <li><a href="/pagina/privacidade">DPN-Certificado Digital</a></li>
                </ul>

                <!-- Selos Exatos do Print -->
                <div class="footer-seals-column">
                    <!-- Selo RA1000 -->
                    <div class="ra1000-seal">
                        <svg class="ra1000-ribbon" width="38" height="46" viewBox="0 0 38 46" fill="none">
                            <path d="M12 28L8 44L15 39L20 45L22 30" fill="#15803d"/>
                            <path d="M21 30L23 45L28 39L35 44L30 28" fill="#eab308"/>
                            <circle cx="19" cy="18" r="15" fill="#16a34a" stroke="#22c55e" stroke-width="2"/>
                            <path d="M12 18L17 23L26 13" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="ra1000-text-block">
                            <span class="ra1000-cert">CERTIFICADO</span>
                            <strong class="ra1000-badge">RA1000</strong>
                            <span class="ra1000-reclame">Reclame<span class="ra1000-aqui">AQUI</span></span>
                        </div>
                    </div>

                    <!-- Selo Cultura Ética / Ouvidor Digital -->
                    <div class="etica-seal-card">
                        <div class="etica-shield-outer">
                            <div class="etica-shield-inner">
                                <span class="etica-line-1">Somos uma empresa</span>
                                <span class="etica-line-2">comprometida com a</span>
                                <div class="etica-tag">Cultura Ética</div>
                                <span class="etica-line-3">Selo Ouvidor Digital</span>
                                <div class="etica-check-icon">✓</div>
                            </div>
                        </div>
                        <span class="etica-caption">Desenvolvido por:<br><strong>Ouvidor Digital</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-h-divider" aria-hidden="true"></div>

        <!-- Bottom Institutional Data -->
        <div class="cotech-footer-info">
            <p class="footer-summary-text">
                A Cotech é o maior escritório de contabilidade digital, que oferece mais praticidade, transparência e economia para empreendedores. Unimos a paixão dos nossos contadores com a tecnologia para democratizar o serviço de contabilidade online para micro e pequenas empresas.
            </p>

            <h4 class="footer-company-name">Cotech Escritório de Contabilidade</h4>

            <div class="footer-addresses-grid">
                <div class="footer-address-block">
                    <strong>SÃO PAULO:</strong>
                    <span>Atendimento corporativo e digital em todo o estado de São Paulo e território nacional.</span>
                </div>
                <div class="footer-address-block">
                    <strong>CAMPINAS & INTERIOR:</strong>
                    <span>{{ $company['phone'] ?? '(19) 98153-0690' }} | {{ $company['email'] ?? 'comercial@cotechcontabilidade.com.br' }}</span>
                </div>
            </div>

            <div class="footer-crc-info">
                <span>- Conselho Regional de Contabilidade: CRC Ativo & Regularizado</span>
                <span>- Responsável Técnico: Contabilidade habilitada conforme normas do CFC / CRC</span>
            </div>
        </div>
    </div>
</footer>
@unless(request()->is('orcamento', 'login', 'forgot-password', 'reset-password*'))
<a class="contact-float" href="{{ \App\Support\Company::whatsapp() ?: '/orcamento' }}" aria-label="Fale com a Cotech"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5 9 9 0 0 1-4-.9L3 21l1.9-5.5a9 9 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3H13a8.5 8.5 0 0 1 8 8v.5Z"/><path d="M8 11h9M8 14h6"/></svg><span>Vamos conversar?</span></a>
@endunless
</body></html>
