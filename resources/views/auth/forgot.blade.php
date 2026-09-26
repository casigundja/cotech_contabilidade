@extends('layouts.public')
@section('title','Recuperar senha | Cotech')
@section('content')<div class="auth card"><span class="eyebrow">Acesso da equipe</span><h1>Recuperar senha.</h1><p class="muted">Informe seu e-mail para receber um link de recuperação.</p><form method="post" action="/forgot-password">@csrf<div class="field"><label for="email">E-mail</label><input type="email" id="email" name="email" value="{{ old('email') }}" required></div><button>Enviar link</button></form><p style="margin-top:22px"><a href="/login">Voltar para o acesso</a></p></div>@endsection
