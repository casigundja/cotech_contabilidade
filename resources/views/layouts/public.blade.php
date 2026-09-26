@php($company = \App\Support\Company::all())
<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#190864">
<title>@yield('title', 'Cotech — O futuro em suas mãos')</title>
<meta name="description" content="@yield('description', 'Contabilidade, consultoria e soluções para o crescimento do seu negócio. Conheça a Cotech e solicite uma proposta.')">
<link rel="icon" href="/images/logo.jpeg"><link rel="stylesheet" href="/css/site.css"><link rel="stylesheet" href="/css/public.css?v=2"><script src="/js/site.js?v=2" defer></script>
</head>
<body class="public-site">
<a class="skip" href="#main">Ir para o conteúdo</a><div class="scroll-progress" aria-hidden="true"></div>
<div class="topbar"><div class="container"><span><i class="tiny-dot"></i> O futuro em suas mãos.</span><span>{{ $company['hours'] ?? 'Conhecimento. Proximidade. Novas possibilidades.' }}</span><a href="/login">Área da equipe ↗</a></div></div>
<header class="header"><div class="container header-inner"><a class="brand" href="/" aria-label="Cotech, início"><img src="/images/logo.jpeg" alt="Logotipo Cotech" width="56" height="56"><span>COTECH<small>O FUTURO EM SUAS MÃOS</small></span></a><button class="mobile-toggle" data-menu aria-controls="main-nav" aria-expanded="false">Menu <span aria-hidden="true">☰</span></button><nav id="main-nav" aria-label="Principal"><a class="{{ request()->is('/') ? 'current' : '' }}" href="/">Início</a><a class="{{ request()->is('servicos*') ? 'current' : '' }}" href="/servicos">Soluções</a><a href="/#sobre">A Cotech</a><a class="{{ request()->is('blog*') ? 'current' : '' }}" href="/blog">Conteúdos</a><a class="button" href="/orcamento">Vamos conversar <span>↗</span></a></nav></div></header>
<main id="main">@if(session('success') || $errors->any())<div class="container">@include('partials.feedback')</div>@endif @yield('content')</main>
<footer class="footer"><div class="container"><div class="footer-grid"><div class="footer-brand"><a href="/" class="footer-wordmark">COTECH<span>▪</span></a><p>{{ $company['footer'] ?? 'Conhecimento, proximidade e soluções para transformar o futuro do seu negócio.' }}</p><span class="footer-tagline">O FUTURO EM SUAS MÃOS.</span></div><div><h3>Explore</h3><a href="/">Início</a><a href="/servicos">Nossas soluções</a><a href="/#sobre">A Cotech</a><a href="/blog">Conteúdos e ideias</a></div><div><h3>Vamos nos conectar</h3>@if(!empty($company['email']))<a class="wrap" href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>@endif @if(!empty($company['phone']))<p>{{ $company['phone'] }}</p>@endif @if(!empty($company['address']))<p>{{ $company['address'] }}</p>@endif @if($wa = \App\Support\Company::whatsapp())<a href="{{ $wa }}" target="_blank" rel="noopener">Conversar pelo WhatsApp ↗</a>@else<a href="/orcamento">Solicitar uma proposta ↗</a>@endif<a href="/login">Área da equipe ↗</a></div></div><div class="footer-bottom"><span>© {{ date('Y') }} Cotech. Todos os direitos reservados.</span><a href="/pagina/privacidade">Privacidade e uso de dados</a><a href="#main" class="back-top">De volta ao topo ↑</a></div></div></footer>
@unless(request()->is('orcamento', 'login', 'forgot-password', 'reset-password*'))
<a class="contact-float" href="{{ \App\Support\Company::whatsapp() ?: '/orcamento' }}" aria-label="Fale com a Cotech"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5 9 9 0 0 1-4-.9L3 21l1.9-5.5a9 9 0 0 1-.9-4A8.5 8.5 0 0 1 12.5 3H13a8.5 8.5 0 0 1 8 8v.5Z"/><path d="M8 11h9M8 14h6"/></svg><span>Vamos conversar?</span></a>
@endunless
</body></html>
