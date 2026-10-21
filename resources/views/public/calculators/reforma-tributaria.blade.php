@extends('layouts.public')
@section('title', 'Calculadora da Reforma Tributária | Simule Impacto do IBS e CBS | Cotech')
@section('description', 'Simule como a Reforma Tributária (IBS e CBS) impactará a carga de impostos da sua empresa. Entenda o que muda para o Simples Nacional e prestadores de serviços.')

@section('content')
<!-- BREADCRUMB -->
<div class="calc-breadcrumb-bar">
    <div class="container">
        <nav aria-label="Navegação estrutural">
            <a href="/">Início</a>
            <span class="sep">/</span>
            <a href="/calculadoras">Calculadoras</a>
            <span class="sep">/</span>
            <span class="current">Reforma Tributária</span>
        </nav>
    </div>
</div>

<!-- HERO DA PÁGINA -->
<div class="calc-page-hero">
    <div class="container" data-reveal>
        <span class="eyebrow">DIAGNÓSTICO TRIBUTÁRIO 2026/2027</span>
        <h1>Calculadora da Reforma Tributária<br><span class="ink-blue">simule o impacto do IVA Dual (IBS e CBS)</span></h1>
        <p class="muted">Com a promulgação da Reforma Tributária (EC nº 132/2023), o Brasil inicia a substituição do PIS, COFINS e ISS pela CBS federal e pelo IBS estadual/municipal. Simule como seu regime tributário e faturamento serão afetados.</p>
    </div>
</div>

<!-- SECTION CALCULADORA INTERATIVA -->
<section class="section calc-main-section">
    <div class="container">
        <div class="calc-card-grid">
            <!-- INPUTS DO SIMULADOR -->
            <div class="calc-inputs-card" data-reveal>
                <div class="calc-card-header">
                    <span class="calc-step-tag">PARÂMETROS EMPRESARIAIS</span>
                    <h3>Simule o cenário da sua empresa</h3>
                    <p class="calc-subtitle">Preencha os dados do seu modelo de negócios para obter o diagnóstico preliminar da transição fiscal.</p>
                </div>

                <div class="calc-form-group">
                    <label for="ref-faturamento">1. Faturamento Anual da Empresa (R$) *</label>
                    <input type="number" id="ref-faturamento" class="calc-input" value="360000" min="50000" step="20000">
                    <small class="calc-field-help">Receita bruta total prevista em 12 meses.</small>
                </div>

                <div class="calc-form-group">
                    <label for="ref-regime">2. Regime Tributário Atual *</label>
                    <select id="ref-regime" class="calc-input">
                        <option value="simples" selected>Simples Nacional (ME / EPP)</option>
                        <option value="presumido">Lucro Presumido</option>
                        <option value="real">Lucro Real</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="ref-setor">3. Setor Principal de Atuação *</label>
                    <select id="ref-setor" class="calc-input">
                        <option value="servicos-ti" selected>Serviços de Tecnologia / TI / Software / Dados</option>
                        <option value="servicos-consultoria">Consultoria / Profissões Regulamentadas / Saúde</option>
                        <option value="comercio">Comércio Varejista / E-commerce</option>
                        <option value="industria">Indústria e Transformação</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="ref-modelo">4. Perfil Predominante de Clientes *</label>
                    <select id="ref-modelo" class="calc-input">
                        <option value="b2b" selected>B2B — Vende para outras empresas (PJ com direito a crédito)</option>
                        <option value="b2c">B2C — Vende diretamente para o consumidor final (Pessoa Física)</option>
                        <option value="misto">Misto (50% B2B e 50% B2C)</option>
                    </select>
                </div>

                <div class="calc-form-group">
                    <label for="ref-compras">5. Volume de Compras / Despesas com Insumos (% da receita)</label>
                    <select id="ref-compras" class="calc-input">
                        <option value="15">Baixo (10% a 15% — típico de prestadores de serviços intelectuais)</option>
                        <option value="35">Médio (30% a 40%)</option>
                        <option value="60">Alto (50% a 70% — típico de comércio e revenda)</option>
                    </select>
                    <small class="calc-field-help">Determina o montante de créditos tributários que sua empresa poderá abater do IVA.</small>
                </div>

                <button type="button" class="button blue-button full-width" id="btn-calc-reforma">Gerar Diagnóstico da Reforma ↗</button>
            </div>

            <!-- RESULTADOS DO DIAGNÓSTICO -->
            <div class="calc-results-card" data-reveal>
                <span class="calc-badge-green">DIAGNÓSTICO E TRANSIÇÃO</span>

                <div class="calc-result-header">
                    <small>Cenário para o seu perfil empresarial:</small>
                    <div class="calc-big-value text-blue" id="res-ref-status">Vantagem Competitiva B2B</div>
                    <p class="calc-note" id="res-ref-summary">No Simples Nacional você mantém a apuração unificada e poderá optar por transferir créditos fiscais de IBS/CBS às empresas contratantes.</p>
                </div>

                <div class="calc-breakdown-list">
                    <div class="breakdown-item">
                        <span>Regime Estratégico Recomendado:</span>
                        <strong class="text-blue" id="res-ref-recomendado">Simples Nacional com Opção de Crédito</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Impacto na Carga Efetiva:</span>
                        <strong id="res-ref-carga">Estável / Protegida Constitucionalmente</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Competitividade com Clientes PJ:</span>
                        <strong class="text-green" id="res-ref-creditos">Totalmente Assegurada</strong>
                    </div>
                    <div class="breakdown-item">
                        <span>Próximo Marco Regulatório:</span>
                        <strong>Início da fase de testes em 2026 (CBS 0,9% e IBS 0,1%)</strong>
                    </div>
                </div>

                <!-- BANNER DE RECOMENDAÇÃO ESTRATÉGICA -->
                <div class="calc-winner-banner">
                    <span class="winner-icon">🛡️</span>
                    <div>
                        <strong>Planejamento Preventivo Cotech:</strong>
                        <p id="res-ref-advice">Avaliamos seus contratos comerciais e sistemas emissores de NF-e para que sua empresa aproveite todas as deduções permitidas pela nova legislação sem aumento de custos.</p>
                    </div>
                </div>

                <div class="calc-cta-box">
                    <a class="button blue-button full-width" href="/orcamento?servico=reforma-tributaria">Falar com Consultor Especialista em Reforma ↗</a>
                    <span class="calc-security-note">🔒 Consultoria contábil proativa para a transição 2026–2033.</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEÇÃO EDUCATIVA: O QUE MUDA NA REFORMA -->
<section class="section calc-info-section">
    <div class="container" data-reveal>
        <span class="eyebrow">PANORAMA COMPLETO</span>
        <h2>O que muda com o novo sistema tributário brasileiro?</h2>
        <p class="muted">Aprovada pela Emenda Constitucional 132/2023, a Reforma Tributária sobre o Consumo unifica cinco tributos históricos em um sistema moderno de Imposto sobre Valor Agregado (IVA Dual):</p>

        <div class="calc-info-grid">
            <div class="calc-info-card">
                <div class="calc-info-icon">🏛️</div>
                <h3>CBS (Contribuição sobre Bens e Serviços)</h3>
                <p>Tributo de competência federal que substitui o PIS e a COFINS. Será fiscalizado pela Receita Federal com alíquota uniforme em todo o território nacional e cobrança no destino da operação.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🗺️</div>
                <h3>IBS (Imposto sobre Bens e Serviços)</h3>
                <p>Tributo de competência compartilhada entre Estados e Municípios que substitui o ICMS estadual e o ISS municipal. É gerido por um Comitê Gestor unificado, eliminando a guerra fiscal entre cidades.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🔄</div>
                <h3>Não-Cumulatividade Plena</h3>
                <p>O princípio que muda as regras do jogo: todo o imposto pago na compra de insumos, equipamentos, softwares e serviços contratados pela empresa gera crédito fiscal imediato para abater do imposto a recolher.</p>
            </div>

            <div class="calc-info-card">
                <div class="calc-info-icon">🛡️</div>
                <h3>O Simples Nacional Continua!</h3>
                <p>O regime especial do Simples Nacional foi mantido integralmente na Constituição. Empresas do Simples mantêm o recolhimento unificado via DAS, com a liberdade adicional de escolher transferir créditos de CBS/IBS para clientes corporativos.</p>
            </div>
        </div>
    </div>
</section>

<!-- CRONOGRAMA DE TRANSIÇÃO -->
<section class="section calc-table-section">
    <div class="container" data-reveal>
        <span class="eyebrow">CRONOGRAMA OFICIAL</span>
        <h2>Linha do Tempo da Transição Tributária (2026–2033)</h2>
        <p class="muted">A transição será gradual para permitir a adaptação de empresas e governos sem choques operacionais:</p>

        <div class="table-wrap">
            <table class="calc-comparison-table">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>O que acontece na prática?</th>
                        <th>Impacto nas Empresas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>2026</strong></td>
                        <td>Fase de testes operacionais da CBS (0,9%) e do IBS (0,1%)</td>
                        <td>Alíquotas simbólicas compensadas com PIS/COFINS; adaptação dos sistemas emissores</td>
                    </tr>
                    <tr>
                        <td><strong>2027</strong></td>
                        <td>Extinção definitiva do PIS e da COFINS; CBS entra em vigor pleno</td>
                        <td>Início da não-cumulatividade federal e revisão de preços para prestadores de serviços</td>
                    </tr>
                    <tr>
                        <td><strong>2029 a 2032</strong></td>
                        <td>Redução gradual de ICMS e ISS (10% ao ano) e aumento proporcional do IBS</td>
                        <td>Transição suave das alíquotas estaduais e municipais para o novo IBS</td>
                    </tr>
                    <tr>
                        <td><strong>2033 em diante</strong></td>
                        <td>Extinção completa do antigo sistema tributário; IVA Dual 100% vigente</td>
                        <td>Modelo tributário plenamente consolidado e simplificado em todo o Brasil</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ ESPECÍFICO DE REFORMA -->
<section class="section calc-faq-section">
    <div class="container" data-reveal>
        <span class="eyebrow">PERGUNTAS E RESPOSTAS</span>
        <h2>Dúvidas frequentes sobre a Reforma Tributária</h2>

        <div class="faq-accordion-list">
            <details class="faq-item">
                <summary>Minha empresa é do Simples Nacional. Vou pagar mais impostos com a Reforma?</summary>
                <div class="faq-answer">
                    <p>Não obrigatoriamente. A Constituição garantiu a permanência integral do Simples Nacional. Sua empresa poderá continuar recolhendo seus impostos na guia única do DAS com as alíquotas reduzidas já vigentes.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Como funcionará o repasse de créditos fiscais para clientes B2B no Simples?</summary>
                <div class="faq-answer">
                    <p>A regulamentação prevê que optantes pelo Simples poderão optar por recolher a CBS e o IBS pelo regime geral ou permitir que seus clientes PJ aproveitem o crédito correspondente à parcela do imposto efetivamente recolhida no DAS. A Cotech orientará a melhor escolha para seus contratos.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>O que acontece com os prestadores de serviço no Lucro Presumido?</summary>
                <div class="faq-answer">
                    <p>Prestadores de serviços no Lucro Presumido que hoje pagam 0,65% de PIS e 3% de COFINS precisarão de uma análise criteriosa, pois a CBS terá alíquota superior, porém com direito a créditos. Para muitos, a migração para o Simples Nacional ou reorganização societária será a via mais vantajosa.</p>
                </div>
            </details>

            <details class="faq-item">
                <summary>Quando devo começar a adaptar minha contabilidade para a Reforma?</summary>
                <div class="faq-answer">
                    <p><strong>Imediatamente.</strong> As empresas que revisarem contratos de longo prazo, cadastro fiscal de serviços e parametrização de software com antecedência evitarão perdas financeiras e sairão na frente da concorrência na atração de clientes corporativos.</p>
                </div>
            </details>
        </div>
    </div>
</section>

<!-- CALL TO ACTION FINAL -->
<section class="section calc-final-cta">
    <div class="container" data-reveal>
        <div class="srv-callout-card">
            <div class="srv-callout-content">
                <span class="srv-callout-tag">PLANEJAMENTO TRIBUTÁRIO</span>
                <h2>Sua empresa preparada para a nova era fiscal brasileira</h2>
                <p>Nossa equipe estuda detalhadamente o perfil do seu faturamento para estruturar a estratégia ideal de transição tributária com segurança.</p>
                <div class="srv-callout-actions">
                    <a class="button blue-button" href="/orcamento?servico=reforma-tributaria">Solicitar Diagnóstico Estratégico <span>↗</span></a>
                    <a class="button srv-button-ghost" href="/calculadoras">Explorar Outras Calculadoras <span>↗</span></a>
                </div>
            </div>
            <div class="srv-callout-image">
                <img src="/images/specialist-tablet.jpg" alt="Consultores Cotech analisando Reforma Tributária" width="460" height="420" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- JAVASCRIPT DO SIMULADOR DA REFORMA -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selRegime = document.getElementById('ref-regime');
    const selSetor = document.getElementById('ref-setor');
    const selModelo = document.getElementById('ref-modelo');
    const selCompras = document.getElementById('ref-compras');
    const btnCalc = document.getElementById('btn-calc-reforma');

    function calcular() {
        const regime = selRegime.value;
        const setor = selSetor.value;
        const modelo = selModelo.value;
        const compras = parseFloat(selCompras.value);

        const statusEl = document.getElementById('res-ref-status');
        const summaryEl = document.getElementById('res-ref-summary');
        const recEl = document.getElementById('res-ref-recomendado');
        const cargaEl = document.getElementById('res-ref-carga');
        const creditosEl = document.getElementById('res-ref-creditos');
        const adviceEl = document.getElementById('res-ref-advice');

        if (regime === 'simples') {
            if (modelo === 'b2b') {
                statusEl.textContent = "Vantagem Competitiva B2B";
                summaryEl.textContent = "No Simples Nacional você mantém a apuração simplificada e poderá optar por transferir créditos fiscais de IBS/CBS às empresas contratantes sem burocracia.";
                recEl.textContent = "Simples Nacional com Opção de Crédito B2B";
                cargaEl.textContent = "Protegida (sem aumento de carga no DAS)";
                creditosEl.textContent = "Totalmente Assegurada para clientes PJ";
                adviceEl.textContent = "A Cotech configurará sua emissão fiscal para permitir que seus clientes PJ aproveitem os créditos tributários correspondentes, mantendo seu serviço altamente competitivo.";
            } else {
                statusEl.textContent = "Estabilidade e Proteção Total";
                summaryEl.textContent = "Para o consumidor final (B2C), o Simples Nacional continua sendo de longe o regime mais vantajoso e descomplicado do país.";
                recEl.textContent = "Simples Nacional Tradicional Otimizado";
                cargaEl.textContent = "Totalmente Estável (Tabela Simples mantida)";
                creditosEl.textContent = "Não se aplica a clientes Pessoa Física";
                adviceEl.textContent = "Sua empresa não sofrerá oscilação de impostos. Nosso foco é manter o benefício do Fator R ativo para pagar a partir de 6% no Anexo III.";
            }
        } else if (regime === 'presumido') {
            statusEl.textContent = "Necessidade de Revisão Estratégica";
            summaryEl.textContent = "No Lucro Presumido, a extinção do PIS (0,65%) e COFINS (3%) em favor da CBS exigirá planejamento minucioso para avaliar se a empresa deve migrar para o Simples ou Lucro Real.";
            recEl.textContent = "Planejamento de Migração p/ Simples Nacional";
            cargaEl.textContent = "Risco de Elevação se não houver créditos de insumos";
            creditosEl.textContent = "Exigirá comprovação de compras documentadas";
            adviceEl.textContent = "Recomendamos que nossos contadores realizem um estudo de viabilidade para simular se sua margem se mantém no Lucro Presumido ou se a migração societária é necessária.";
        } else {
            statusEl.textContent = "Crédito Amplo de Insumos";
            summaryEl.textContent = "No Lucro Real, o princípio da não-cumulatividade ampla permitirá abater créditos sobre todas as aquisições da empresa, exigindo escrituração digital rigorosa.";
            recEl.textContent = "Lucro Real com Gestão de Créditos Cotech";
            cargaEl.textContent = "Compensada pelo aproveitamento integral de créditos";
            creditosEl.textContent = "Geração plena de créditos bilaterais";
            adviceEl.textContent = "Nossa equipe audita cada nota fiscal de entrada para maximizar o crédito de IBS e CBS, reduzindo o valor líquido a recolher no final do mês.";
        }
    }

    btnCalc?.addEventListener('click', calcular);
    selRegime?.addEventListener('change', calcular);
    selSetor?.addEventListener('change', calcular);
    selModelo?.addEventListener('change', calcular);
    selCompras?.addEventListener('change', calcular);

    calcular();
});
</script>
@endsection
