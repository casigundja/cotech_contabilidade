@extends('layouts.public')
@php($company = \App\Support\Company::all())
@section('content')
<section class="cotech-solucoes-hero">
    <!-- Bottom left corner emblem -->
    <svg class="solucoes-corner-emblem" viewBox="0 0 36 36" fill="none" aria-hidden="true">
        <path d="M0 0 H24 L14 14 H0 V0 Z" fill="white"/>
        <path d="M14 14 L24 0 V24 H14 V14 Z" fill="#38bdf8"/>
    </svg>

    <div class="cotech-solucoes-container">
        <div class="solucoes-content">
            <div class="solucoes-header-row">
                <h1 class="solucoes-title">
                    Soluções em<br>
                    <span class="highlight-cyan">Contabilidade</span>
                </h1>
                <!-- Geometric emblem -->
                <svg class="solucoes-emblem" viewBox="0 0 36 36" fill="none" aria-hidden="true">
                    <path d="M0 0 H24 L14 14 H0 V0 Z" fill="white"/>
                    <path d="M14 14 L24 0 V24 H14 V14 Z" fill="#38bdf8"/>
                </svg>
            </div>

            <p class="solucoes-desc">
                Mais organização para o seu negócio, com segurança, planejamento e suporte em todas as etapas.
            </p>

            <div class="solucoes-actions">
                <a class="btn-solucoes-cyan" href="/orcamento">
                    Fale com um especialista <span>/</span>
                </a>
                <a class="btn-solucoes-outline" href="/servicos">
                    Conheça nossos serviços
                </a>
            </div>

            <div class="solucoes-pillars">
                <div class="solucoes-pillar-item">
                    <!-- 3 bars icon -->
                    <svg class="solucoes-pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="12" width="4" height="9" rx="1"/>
                        <rect x="10" y="7" width="4" height="14" rx="1"/>
                        <rect x="17" y="3" width="4" height="18" rx="1"/>
                    </svg>
                    <span class="solucoes-pillar-text">Gestão<br>financeira</span>
                </div>

                <div class="solucoes-pillar-divider" aria-hidden="true"></div>

                <div class="solucoes-pillar-item">
                    <!-- Document icon -->
                    <svg class="solucoes-pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="8" y1="13" x2="16" y2="13"/>
                        <line x1="8" y1="17" x2="16" y2="17"/>
                    </svg>
                    <span class="solucoes-pillar-text">Conformidade<br>fiscal</span>
                </div>

                <div class="solucoes-pillar-divider" aria-hidden="true"></div>

                <div class="solucoes-pillar-item">
                    <!-- Team / Growth icon -->
                    <svg class="solucoes-pillar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span class="solucoes-pillar-text">Apoio ao<br>crescimento</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cotech-hero" id="facilidade">
    <div class="container cotech-hero-grid">
        <div class="cotech-hero-copy">
            <h2 class="cotech-hero-title">
                Cuidar de <span class="highlight-blue">notas fiscais</span> e <span class="highlight-blue">impostos</span> nunca foi tão fácil.
            </h2>
            <p class="cotech-hero-subtitle">
                Abertura de CNPJ grátis e plataforma disponível 24h, com planos a partir de R$ 195/mês.
            </p>
            <div class="cotech-hero-actions">
                <a class="cotech-btn-cyan" href="/calculadora-de-custo-para-tirar-cnpj">Abrir CNPJ grátis</a>
                <a class="cotech-btn-outline-blue" href="{{ \App\Support\Company::whatsapp() ?: '/orcamento' }}" target="_blank" rel="noopener">Tirar dúvidas com contador</a>
            </div>
            <div class="cotech-hero-stats">
                <div class="cotech-stat-item first">
                    <strong class="stat-number">+100 mil</strong>
                    <span class="stat-desc">clientes em todo o Brasil</span>
                </div>
                <div class="cotech-stat-item">
                    <strong class="stat-number">Campeã</strong>
                    <span class="stat-desc">do prêmio Reclame Aqui 2025</span>
                </div>
                <div class="cotech-stat-item">
                    <strong class="stat-number">Nº 1</strong>
                    <span class="stat-desc">em abertura de empresas no país</span>
                </div>
                <div class="cotech-stat-item">
                    <strong class="stat-number">+12 anos</strong>
                    <span class="stat-desc">de experiência em contabilidade</span>
                </div>
            </div>
        </div>
        <div class="cotech-hero-visual" data-reveal>
            <div class="cotech-photo-container">
                <img src="/images/hero-cotech-team.png" alt="Sócios Fundadores da Cotech — Fernando Kiosa e Francisco Calombe" width="577" height="490" class="cotech-hero-img" loading="lazy">
            </div>
        </div>
    </div>
</section>
<section class="section solutions-section" id="solucoes"><div class="container">
    <div class="section-head" data-reveal><div><span class="eyebrow">01 / SOLUÇÕES QUE MOVEM</span><h2>Você cuida da visão.<br><span class="ink-blue">Nós ajudamos no caminho.</span></h2></div><div class="section-aside"><p>O apoio certo para cada momento do seu negócio. Conheça o que podemos construir juntos.</p><a class="text-link" href="/servicos">Explorar todos os serviços <span>↗</span></a></div></div>
    <div class="solution-grid">@forelse($services as $service)<a class="solution-card" href="/servicos/{{ $service->slug }}" data-reveal><div class="solution-top"><span class="solution-icon" aria-hidden="true">@if($loop->index % 3 === 0)▥@elseif($loop->index % 3 === 1)↗@else◎@endif</span><span class="solution-number">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span></div><h3>{{ $service->title }}</h3><p>{{ $service->summary }}</p><div class="solution-link">Descubra as possibilidades <span>↗</span></div></a>@empty<div class="empty">Conte o que precisa. Nossa equipe ajuda a encontrar a solução.</div>@endforelse</div>
</div></section>
<section class="section about-section" id="sobre"><div class="container about-grid">
    <div class="about-visual" data-reveal>
        <div class="cbr-consultant-frame about-consultant-frame">
            <div class="cbr-avatar-bg-circle" aria-hidden="true"></div>
            <div class="cbr-avatar-mask">
                <img src="/images/cotech-socios.png" alt="Francisco Calombe - Contador Consultor Cotech" loading="lazy" width="360" height="360">
            </div>
            <div class="cbr-consultant-badges">
                <div class="cbr-badge-pill-name">Francisco Calombe</div>
                <div class="cbr-badge-pill-role">
                    <span class="role-title">Contador Consultor</span>
                    <span class="role-crc">CRC/SP 305427/O-2</span>
                </div>
            </div>
        </div>
    </div>
    <div class="about-copy" data-reveal><span class="eyebrow">02 / PROXIMIDADE QUE FAZ A DIFERENÇA</span><h2>Mais que uma empresa.<br><span class="ink-blue">Uma parceria de verdade.</span></h2><p>Acreditamos que por trás de cada número existe uma história, uma decisão e um futuro para construir.</p><p class="muted">Por isso, unimos conhecimento e proximidade para entender o seu momento, organizar suas prioridades e transformar planos em próximos passos.</p><div class="about-values"><div class="value-line"><span>01</span><div><h3>Escuta antes da solução.</h3><p>Seu contexto é o nosso ponto de partida.</p></div></div><div class="value-line"><span>02</span><div><h3>Clareza em cada decisão.</h3><p>Informações que ajudam você a seguir em frente.</p></div></div></div><a class="button blue-button" href="/orcamento">Conheça a sua próxima parceria <span>↗</span></a></div>
</div></section>
<section class="section process-section"><div class="container"><div class="section-head" data-reveal><div><span class="eyebrow">03 / DO PRIMEIRO OLÁ AO PRÓXIMO PASSO</span><h2>Avançar pode ser<br>mais simples.</h2></div><p class="section-aside">Uma conversa abre o caminho.<br>Uma parceria ajuda a percorrê-lo.</p></div>
<div class="process-layout" data-reveal><div class="process-tabs" role="tablist" aria-label="Como trabalhamos" aria-orientation="vertical">@foreach(['Uma conversa que importa','Um plano para sua realidade','Uma parceria para avançar'] as $label)<button class="process-tab {{ $loop->first ? 'selected' : '' }}" id="step-tab-{{ $loop->index }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}" aria-controls="step-panel-{{ $loop->index }}" tabindex="{{ $loop->first ? 0 : -1 }}" data-step="{{ $loop->index }}"><span>0{{ $loop->iteration }}</span>{{ $label }}<b>↗</b></button>@endforeach</div>
<div class="process-panels">@foreach([['Tudo começa com você.','Conte seus desafios, suas ideias e o que espera para o seu negócio. Ouvimos com atenção para entender onde podemos fazer a diferença.','Vamos conversar','/orcamento'],['O seu momento define o caminho.','Organizamos as necessidades e propomos um escopo de trabalho com prioridades claras e soluções adequadas à sua realidade.','Conheça nossas soluções','/servicos'],['Seguimos juntos no próximo passo.','Acompanhamos o trabalho com comunicação próxima e informações claras para apoiar suas decisões ao longo do caminho.','Comece essa parceria','/orcamento']] as [$title,$body,$label,$url])<div class="process-panel" id="step-panel-{{ $loop->index }}" role="tabpanel" aria-labelledby="step-tab-{{ $loop->index }}" tabindex="0" @if(!$loop->first) hidden @endif><span class="process-big-number" aria-hidden="true">0{{ $loop->iteration }}</span><span class="eyebrow">NOSSO JEITO DE TRABALHAR</span><h3>{{ $title }}</h3><p>{{ $body }}</p><a class="text-link" href="{{ $url }}">{{ $label }} ↗</a></div>@endforeach</div></div>
</div></section>
@if($posts->isNotEmpty())<section class="section insights-section"><div class="container"><div class="section-head" data-reveal><div><span class="eyebrow">04 / IDEIAS QUE ABREM CAMINHOS</span><h2>Seu próximo insight<br>pode começar aqui.</h2></div><a class="text-link" href="/blog">Explore os conteúdos <span>↗</span></a></div><div class="insight-grid">@foreach($posts as $post)<article class="insight-card" data-reveal><a class="insight-cover cover-{{ $loop->index % 3 }}" href="/blog/{{ $post->slug }}" tabindex="-1" aria-hidden="true">@if($post->image && !in_array($post->image,['/images/contabilidade.jpeg','/images/planejamento.jpeg','/images/contadores.jpeg']))<img class="editorial-photo" src="{{ $post->image }}" alt="">@else<span>COTECH / EM PERSPECTIVA</span><div class="editorial-shape shape-{{ $loop->index % 3 }}"></div><b>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</b><span class="cover-arrow">↗</span>@endif</a><div class="insight-meta"><span>{{ $post->category ?: 'NEGÓCIOS & ESTRATÉGIA' }}</span><span>{{ ($post->published_at ?? $post->created_at)->format('d.m.Y') }}</span></div><h3><a href="/blog/{{ $post->slug }}">{{ $post->title }}</a></h3><p>{{ $post->summary }}</p><a class="text-link" href="/blog/{{ $post->slug }}">Ler conteúdo ↗</a></article>@endforeach</div></div></section>@endif
@if($testimonials->isNotEmpty())<section class="section"><div class="container"><span class="eyebrow">CONFIANÇA QUE SE CONSTRÓI</span><h2>Quem caminha com a gente.</h2><div class="grid">@foreach($testimonials as $item)<blockquote class="card quote-card" data-reveal><span class="quote-mark">“</span><p>{{ $item->body }}</p><strong>{{ $item->title }}</strong><div class="muted">{{ $item->summary }}</div></blockquote>@endforeach</div></div></section>@endif
@if($certifications->isNotEmpty())<section class="section"><div class="container"><h2>Certificações</h2><div class="grid">@foreach($certifications as $item)<div class="card" data-reveal><h3>{{ $item->title }}</h3><p>{{ $item->summary }}</p></div>@endforeach</div></div></section>@endif
@if($banners->isNotEmpty())<section class="section"><div class="container grid">@foreach($banners as $item)<article class="card image-card" data-reveal>@if($item->image)<img loading="lazy" src="{{ $item->image }}" alt="{{ $item->title }}">@endif<div class="card-body"><h3>{{ $item->title }}</h3><p>{{ $item->summary }}</p><a class="text-link" href="/orcamento">Saiba mais ↗</a></div></article>@endforeach</div></section>@endif
@if($faqs->isNotEmpty())<section class="section faq-section"><div class="container faq-grid"><div data-reveal><span class="eyebrow">VAMOS ESCLARECER?</span><h2>Boas perguntas.<br><span class="ink-blue">Caminhos mais claros.</span></h2><p class="muted">Ainda tem alguma dúvida?<br>A nossa equipe está aqui para conversar.</p><a class="text-link" href="/orcamento">Fale com a Cotech ↗</a></div><div class="faq-list" data-reveal>@foreach($faqs as $faq)<details name="cotech-faq"><summary><span class="faq-number">0{{ $loop->iteration }}</span>{{ $faq->title }}<span class="faq-toggle" aria-hidden="true">+</span></summary><p>{{ $faq->body }}</p></details>@endforeach</div></div></section>@endif
@endsection
