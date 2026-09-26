{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach(['/', '/servicos', '/blog', '/orcamento'] as $path)<url><loc>{{ url($path) }}</loc></url>@endforeach
@foreach($items as $item)<url><loc>{{ url(($item->type === 'service' ? '/servicos/' : ($item->type === 'post' ? '/blog/' : '/pagina/')).$item->slug) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>@endforeach
</urlset>
