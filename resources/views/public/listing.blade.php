@extends('layouts.public')
@section('title', ($type === 'service' ? 'Serviços' : 'Conteúdos').' | Cotech')
@section('content')
<div class="page-head"><div class="container"><span class="eyebrow">COTECH / {{ $type === 'service' ? 'NOSSAS SOLUÇÕES' : 'EM PERSPECTIVA' }}</span><h1>{{ $type === 'service' ? 'Seu desafio. Nossa próxima missão.' : 'Ideias que abrem caminhos.' }}</h1><p class="muted">{{ $type === 'service' ? 'Conhecimento e proximidade para transformar o próximo passo do seu negócio.' : 'Novas perspectivas sobre contabilidade, gestão e o futuro dos negócios.' }}</p></div></div>
<section class="section"><div class="container">
@if($type === 'service')
<div class="solution-grid">@forelse($items as $item)<a class="solution-card" href="/servicos/{{ $item->slug }}"><div class="solution-top"><span class="solution-icon" aria-hidden="true">{{ ['▥','↗','◎'][$loop->index % 3] }}</span><span class="solution-number">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span></div><h3>{{ $item->title }}</h3><p>{{ $item->summary }}</p><div class="solution-link">Vamos explorar esta solução <span>↗</span></div></a>@empty<p class="empty">Estamos preparando novos conteúdos. Converse com nossa equipe.</p>@endforelse</div>
@else
<div class="insight-grid">@forelse($items as $item)<article class="insight-card"><a class="insight-cover cover-{{ $loop->index % 3 }}" href="/blog/{{ $item->slug }}" tabindex="-1" aria-hidden="true">@if($item->image && !in_array($item->image,['/images/contabilidade.jpeg','/images/planejamento.jpeg','/images/contadores.jpeg']))<img class="editorial-photo" src="{{ $item->image }}" alt="">@else<span>COTECH / EM PERSPECTIVA</span><div class="editorial-shape shape-{{ $loop->index % 3 }}"></div><b>{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</b><span class="cover-arrow">↗</span>@endif</a><div class="insight-meta"><span>{{ $item->category ?: 'NEGÓCIOS & ESTRATÉGIA' }}</span><span>{{ ($item->published_at ?? $item->created_at)->format('d.m.Y') }}</span></div><h3><a href="/blog/{{ $item->slug }}">{{ $item->title }}</a></h3><p>{{ $item->summary }}</p><a class="text-link" href="/blog/{{ $item->slug }}">Ler conteúdo ↗</a></article>@empty<p class="empty">Ainda não há conteúdos publicados.</p>@endforelse</div>
@endif
<div class="pagination">{{ $items->links() }}</div>
</div></section>
<section class="listing-cta"><div class="container"><div><span class="eyebrow">UMA CONVERSA ABRE POSSIBILIDADES</span><h2>Como podemos ajudar você?</h2></div><a class="button" href="/orcamento">Converse com a equipe ↗</a></div></section>
@endsection
