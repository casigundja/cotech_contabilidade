@extends('layouts.public')
@section('title', ($item->seo_title ?: $item->title).' | Cotech')
@section('description', $item->meta_description ?: ($item->summary ?? ''))
@section('content')
<div class="page-head"><div class="container"><a class="eyebrow" href="{{ $item->type === 'service' ? '/servicos' : ($item->type === 'post' ? '/blog' : '/') }}">← {{ $item->type === 'service' ? 'NOSSAS SOLUÇÕES' : ($item->type === 'post' ? 'CONTEÚDOS E IDEIAS' : 'COTECH') }}</a><h1>{{ $item->title }}</h1><p class="muted">{{ $item->summary }}</p></div></div>
<section class="section"><div class="container detail-layout"><article>
@if($item->image && !in_array($item->image,['/images/contabilidade.jpeg','/images/planejamento.jpeg','/images/contadores.jpeg']))<img class="detail-image" src="{{ $item->image }}" alt="{{ $item->title }}">@endif
@if($item->type === 'post')<div class="article-byline"><span class="byline-symbol">C</span><div><strong>Equipe Cotech</strong><span>{{ ($item->published_at ?? $item->created_at)->format('d/m/Y') }} · {{ $item->category ?: 'Negócios e estratégia' }}</span></div></div>@endif
<div class="prose">{{ $item->body }}</div>
@if($item->type === 'service')<div class="actions"><a class="button" href="{{ url('/orcamento').'?service='.$item->id }}">Quero uma proposta <span>↗</span></a>@if($wa = \App\Support\Company::whatsapp($item->title))<a class="button secondary" href="{{ $wa }}" target="_blank" rel="noopener">Conversar no WhatsApp</a>@endif</div>@endif
</article><aside class="detail-aside"><span class="eyebrow">SEU PRÓXIMO PASSO</span><h3>Seu negócio merece uma boa conversa.</h3><p>Conte o que precisa. Vamos descobrir juntos como a Cotech pode ajudar.</p><a class="text-link" href="/orcamento">Fale com a nossa equipe ↗</a><div class="aside-monogram" aria-hidden="true">↗</div></aside></div></section>
@endsection
