@extends('layouts.public')
@section('title', 'Cotech Mais | Cursos e Capacitação para Profissionais PJ e Empresas')
@section('description', 'Aprenda a gerenciar as finanças da sua empresa, emitir notas fiscais, calcular impostos e precificar seus serviços com as trilhas práticas da Cotech Mais.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <span class="current">Cursos Cotech Mais</span>
        </nav>
    </div>
</div>

<!-- HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">PROGRAMA DE CAPACITAÇÃO COTECH</span>
        <h1>Cotech Mais<br><span class="ink-blue">o conhecimento que faz sua empresa crescer</span></h1>
        <p class="muted">Trilhas práticas criadas por contadores e gestores de negócios para você dominar a emissão de notas, finanças corporativas, separação de contas PF e PJ e planejamento tributário sem complicação.</p>
    </div>
</div>

<!-- SECTION TRILHAS DE APRENDIZADO -->
<section class="section" style="background: #f8fafc; padding: 60px 0 90px;">
    <div class="container">
        <div class="text-center-wrapper" data-reveal>
            <span class="eyebrow">CONTEÚDO PRÁTICO E APLICADO</span>
            <h2>Trilhas de Formação Cotech Mais</h2>
            <p class="muted">Acesso 100% gratuito para todos os clientes ativos dos nossos planos de contabilidade.</p>
        </div>

        <div class="calc-info-grid" data-reveal>
            <div class="calc-info-card" style="display: flex; flex-direction: column;">
                <span class="calc-step-tag">TRILHA 01 • INICIANTE</span>
                <div class="calc-info-icon">🚀</div>
                <h3>Jornada do Novo PJ</h3>
                <p>O guia definitivo do primeiro mês de CNPJ. Aprenda o passo a passo para emitir sua primeira Nota Fiscal de Serviços (NFS-e), cadastrar o certificado digital e receber pagamentos na conta PJ.</p>
                <div style="margin-top: auto; padding-top: 18px; border-top: 1px solid #e2e8f0;">
                    <span style="font-size: 12px; font-weight: 700; color: #10b981;">✓ 4 Módulos • 100% Gratuito</span>
                </div>
            </div>

            <div class="calc-info-card" style="display: flex; flex-direction: column;">
                <span class="calc-step-tag">TRILHA 02 • FINANÇAS</span>
                <div class="calc-info-icon">💳</div>
                <h3>Adeus Confusão Patrimonial</h3>
                <p>Como separar rigorosamente as contas bancárias da Pessoa Física e da Pessoa Jurídica. Descubra como estruturar sua retirada de pró-labore e distribuição de lucros isenta de Imposto de Renda.</p>
                <div style="margin-top: auto; padding-top: 18px; border-top: 1px solid #e2e8f0;">
                    <span style="font-size: 12px; font-weight: 700; color: #10b981;">✓ 5 Módulos • 100% Gratuito</span>
                </div>
            </div>

            <div class="calc-info-card" style="display: flex; flex-direction: column;">
                <span class="calc-step-tag">TRILHA 03 • TRIBUTOS</span>
                <div class="calc-info-icon">📊</div>
                <h3>Simples Nacional sem Segredos</h3>
                <p>Entenda o que são Anexo III e Anexo V, como funciona a regra do Fator R na prática e como a sua empresa garante pagar apenas 6% de alíquota inicial com conformidade fiscal absoluta.</p>
                <div style="margin-top: auto; padding-top: 18px; border-top: 1px solid #e2e8f0;">
                    <span style="font-size: 12px; font-weight: 700; color: #10b981;">✓ 6 Módulos • 100% Gratuito</span>
                </div>
            </div>

            <div class="calc-info-card" style="display: flex; flex-direction: column;">
                <span class="calc-step-tag">TRILHA 04 • CRESCIMENTO</span>
                <div class="calc-info-icon">🎯</div>
                <h3>Precificação Estratégica para PJ</h3>
                <p>Calcule exatamente quanto cobrar pela sua hora técnica ou projeto consultivo, considerando custos fixos, margem de segurança, reserva de descanso e impostos.</p>
                <div style="margin-top: auto; padding-top: 18px; border-top: 1px solid #e2e8f0;">
                    <span style="font-size: 12px; font-weight: 700; color: #10b981;">✓ 4 Módulos • 100% Gratuito</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENEFÍCIOS DO COTECH MAIS -->
<section class="section" style="background: #ffffff;">
    <div class="container" data-reveal>
        <div class="srv-callout-card">
            <div class="srv-callout-content">
                <span class="srv-callout-tag">VANTAGEM EXCLUSIVA</span>
                <h2>Muito mais do que contabilidade: um ecossistema para seu crescimento</h2>
                <p>Na Cotech você tem contador dedicado para cuidar das suas obrigações e acesso ilimitado à plataforma de cursos Cotech Mais para se capacitar como líder do seu negócio.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento">Conhecer Nossos Planos <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/login">Área do Aluno Cotech <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Profissional assistindo curso Cotech Mais" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>
@endsection
